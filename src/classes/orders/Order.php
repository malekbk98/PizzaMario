<?php

namespace classes\orders;

use classes\recipes\ComposedRecipe;
use Data\Db;
use DateTime;

class Order
{
    public $status, $date, $orderID;
    public $products = [];

    public function __construct()
    {
        $this->orderID = "ORD-" . count(Db::$orders);
        echo "Order Number : " . $this->orderID . "\n";
    }

    /**
     * Function: cancelOrder
     * Description:
     *      - set products to an empty array  
     */
    public function cancelOrder()
    {
        $this->products = [];
    }

    /**
     * Function: seeAvailableProducts
     * Description:
     *      - show available products in the database to the costumer  
     */
    public function seeAvailableProducts()
    {
        foreach (Db::$recipees as $key => $recipee) {
            echo "----------------------------------------------------------\n";
            echo "Key : $key ---> name : " . $recipee->name . ", category : " . $recipee->category . ", price : " . $recipee->price . "\n";
            echo "\tIngredients:\n";
            foreach ($recipee->ingredients as $key => $ingredient) {
                echo "\t\tKey : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price . "\n";
            }
            echo "----------------------------------------------------------\n";
        }
    }

    /**
     * Function: AddExistingProduct
     * Description:
     *      - Add a product that exist in DB to the order 
     */
    public function AddExistingProduct($product)
    {
        foreach (Db::$recipees as $recipee) {
            if ($recipee->name === $product->name) {
                array_push($this->products, $recipee);
                echo "Product added to your order\n";
                return;
            }
        }
        echo "Product cant be added to your order\n";
    }

    /**
     * Function: generateNewProduct
     * Description:
     *      - Generate new Product to compose And adding to it base ingredients
     */
    public function generateNewProduct()
    {
        $product = new ComposedRecipe(count($this->products));

        //Adding base ingredients to Product
        foreach (Db::$ingredients as $ingredient) {
            if ($ingredient->base === true) {
                $product->addIngerdiant($ingredient);
                $product->price += $ingredient->price;
            }
        }
        array_push($this->products, $product);

        echo "generated new product succefully its key is " . ($product->reference) . " Add to it somme ingredients \n";
    }

    /**
     * Function: deleteProduct
     * Description:
     *      - Delete the product from the order
     */
    public function deleteProduct($productIndex)
    {
        unset($this->products[$productIndex]);
    }

    /**
     * Function: seeAvailableIngredients
     * Description:
     *      - show available ingredients with there price
     */
    public function seeAvailableIngredients()
    {
        foreach (Db::$ingredients as $key => $ingredient) {
            if (!$ingredient->base)
                echo "Key : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price . "\n";
        }
    }

    /**
     * Function: AddIngredientToProduct
     * Description:
     *      - Adding ingredient to product + Adding its price to product price
     */
    public function AddIngredientToProduct($product, $ingredient)
    {
        $indexProduct = array_search($product, $this->products);
        $indexIngredient = array_search($ingredient, Db::$ingredients);

        if ($indexProduct >= 0 && $indexIngredient >= 0) {
            array_push($this->products[$indexProduct]->ingredients, $ingredient);
            $this->products[$indexProduct]->price += Db::$ingredients[$indexIngredient]->price;
            echo "added ingredient to product!\n";
            return;
        } else {
            echo "couldnt add ingredient to product!\n";
        }
    }

    /**
     * Function: RemoveIngredientFromProduct
     * Description:
     *      - Remove ingredient from Product 
     */
    public function RemoveIngredientFromProduct($productKey, $ingredientKey)
    {
        if (isset($this->products[$productKey])) {
            if (isset($this->products[$productKey]->ingredients[$ingredientKey])) {
                if (isset($this->products[$productKey]->reference)) {
                    $this->products[$productKey]->price -= $this->products[$productKey]->ingredients[$ingredientKey]->price;
                }
                unset($this->products[$productKey]->ingredients[$ingredientKey]);
                echo "Removed ingredient from product!\n";
            }
        } else {
            echo "Product dosent exist in order!\n";
        }
    }

    /**
     * Function: seeOrderDetails
     * Description:
     *      - Shows all the order details
     */
    public function seeOrderDetails()
    {
        $total = 0;
        echo "Order Number : " . $this->orderID . "\n";
        foreach ($this->products as $key => $recipee) {
            echo "----------------------------------------------------------\n";
            if (!isset($recipee->reference))
                echo "Key : $key ---> name : " . $recipee->name . ", category : " . $recipee->category . ", price : " . $recipee->price . "\n";
            else
                echo "Key : $key ---> price : " . $recipee->price . "\n";

            $total += $recipee->price;
            echo "\tIngredients:\n";
            foreach ($recipee->ingredients as $key => $ingredient) {
                echo "\t\tKey : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . "\n";
            }
            echo "----------------------------------------------------------\n";
        }
        echo "Order value : $total € \n";
    }

    /**
     * Function: contactlessPayment
     * Description:
     *      - One of the payements methods finish the order and put it in DB
     */
    public function contactlessPayment($payement)
    {
        $total = 0;
        foreach ($this->products as $recipee) {
            $total += $recipee->price;
        }
        if ($payement->valid && $payement->amount > $total) {
            if ($payement->amount > $total) {
                $payement->amount -= $total;
                $this->status = false;
                $this->date = new DateTime();
                array_push(Db::$orders, $this);
                echo "Payement Done thank you for making your order\n";
            }
        } else {
            echo "Payement invalid\n";
        }
    }

    /**
     * Function: cardPayement
     * Description:
     *      - One of the payements methods finish the order and put it in DB
     */
    public function cardPayement($payement, $code)
    {
        $total = 0;
        foreach ($this->products as $recipee) {
            $total += $recipee->price;
        }
        if ($payement->valid && $payement->amount > $total && $code === $payement->code) {
            $payement->amount -= $total;
            $this->status = false;
            $this->date = new DateTime();
            array_push(Db::$orders, $this);
            echo "Payement Done thank you for making your order\n";
        } else {
            echo "Payement invalid\n";
        }
    }

    /**
     * Function: cashPayement
     * Description:
     *      - One of the payements methods finish the order and put it in DB
     */
    public function cashPayement($payement)
    {
        $total = 0;
        foreach ($this->products as $recipee) {
            $total += $recipee->price;
        }
        if ($payement->amount > $total) {
            $payement->amount -= $total;
            $this->status = false;
            $this->date = new DateTime();
            array_push(Db::$orders, $this);
            echo "Payement Done thank you for making your order\n";
        } else {
            echo "you still need to add " . $total - $payement->amount . " €\n";
        }
    }
}
