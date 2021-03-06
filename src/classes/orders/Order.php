<?php

namespace classes\orders;

use classes\recipes\ComposedRecipe;
use classes\ressources\ComposedPizza;
use Data\Db;
use DateTime;

class Order
{
    public $status, $date, $orderID, $chef;
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
        echo "Order has been canceled!! \n";
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
    public function generateNewProduct($selectedIngredients)
    {
        $product = new ComposedRecipe(count($this->products));

        $hasBaseingredient = false;
        foreach ($selectedIngredients as $ingredient) {
            if ($ingredient->base === true) {
                $hasBaseingredient = true;
            }
            $product->addIngerdiant($ingredient);
            $product->price += $ingredient->price;
        }

        if ($hasBaseingredient) {
            array_push($this->products, $product);
            echo "generated new product succefully !! \n";
            return $product;
        } else {
            echo "product must have at least one base ingridient";
            return null;
        }
    }

    /**
     * Function: AddExistingPizza
     * Description:
     *      - Add a pizza that exist in DB to the order 
     */
    public function AddExistingPizza(&$pizza, &$pizzaSize)
    {
        foreach (Db::$recipees as $recipee) {
            if ($recipee->name === $pizza->name) {
                $pizza->assignSize($pizzaSize);
                array_push($this->products, $pizza);
                echo "Product added to your order\n";
                return;
            }
        }
        echo "Product cant be added to your order\n";
    }

    /**
     * Function: generateNewPizza
     * Description:
     *      - Generate new Pizza to compose And adding to it base ingredients
     */
    public function generateNewPizza($selectedIngredients, &$pizzaSize)
    {
        $pizza = new ComposedPizza(count($this->products));

        $hasBaseingredient = false;
        foreach ($selectedIngredients as $ingredient) {
            if ($ingredient->base === true) {
                $hasBaseingredient = true;
            }
            $pizza->addIngerdiant($ingredient);
            $pizza->price += $ingredient->price;
        }

        if ($hasBaseingredient) {
            $pizza->assignSize($pizzaSize);
            array_push($this->products, $pizza);
            echo "generated new pizza succefully !! \n";
            return $pizza;
        } else {
            echo "Pizza must have at least one base ingridient \n";
            return null;
        }
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
    public function AddIngredientToProduct(&$product, &$ingredient)
    {
        if (in_array($product, $this->products) && in_array($ingredient, Db::$ingredients)) {
            $indexProduct = array_search($product, $this->products);
            $indexIngredient = array_search($ingredient, Db::$ingredients);

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
    public function RemoveIngredientFromProduct($product, $ingredient)
    {
        if (in_array($product, $this->products)) {
            $productKey = array_search($product, $this->products);

            $countBaseingredient = 0;
            foreach ($this->products[$productKey]->ingredients as $ing) {
                if ($ing->base === true) {
                    $countBaseingredient++;
                }
            }

            if ($countBaseingredient > 1) {
                if (in_array($ingredient, $this->products[$productKey]->ingredients)) {
                    $ingredientKey = array_search($ingredient, $this->products[$productKey]->ingredients);

                    if (isset($this->products[$productKey]->reference)) {
                        $this->products[$productKey]->price -= $this->products[$productKey]->ingredients[$ingredientKey]->price;
                    }

                    unset($this->products[$productKey]->ingredients[$ingredientKey]);
                    echo "Removed ingredient from product!\n";
                } else {
                    echo "Ingridient dosent exist in product!\n";
                }
            } else {
                echo "cannot delete all base ingredients!\n";
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
            if (!isset($recipee->pizzaSize)) {
                if (!isset($recipee->reference))
                    echo "Key : $key ---> name : " . $recipee->name . ", category : " . $recipee->category . ", price : " . $recipee->price . "\n";
                else
                    echo "Key : $key ---> price : " . $recipee->price . "\n";


                $total += $recipee->price;
            } else {
                if (!isset($recipee->reference))
                    echo "Key : $key ---> name : " . $recipee->name . ", category : " . $recipee->category . ", price : " . $recipee->price . ", Size : " . $recipee->pizzaSize->size . " --> +" . $recipee->pizzaSize->price . "??? \n";
                else
                    echo "Key : $key ---> price : " . $recipee->price . ", Size : " . $recipee->pizzaSize->size . " --> +" . $recipee->pizzaSize->price . "??? \n";


                $total += $recipee->price + $recipee->pizzaSize->price;
            }

            echo "\tIngredients:\n";
            foreach ($recipee->ingredients as $key => $ingredient) {
                echo "\t\tKey : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . "\n";
            }
            echo "----------------------------------------------------------\n";
        }
        echo "Order value : $total ??? \n";
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
            if (!isset($recipee->pizzaSize)) {
                $total += $recipee->price;
            } else {
                $total += $recipee->price + $recipee->pizzaSize->price;
            }
        }
        if ($payement->valid && $payement->amount > $total) {
            if ($payement->amount > $total) {
                $payement->amount -= $total;
                $this->status = "placed";
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
            if (!isset($recipee->pizzaSize)) {
                $total += $recipee->price;
            } else {
                $total += $recipee->price + $recipee->pizzaSize->price;
            }
        }
        if ($payement->valid && $payement->amount > $total && $code === $payement->code) {
            $payement->amount -= $total;
            $this->status = "placed";
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
        foreach ($this->products as $product) {
            if (!isset($product->pizzaSize)) {
                $total += $product->price;
            } else {
                $total += $product->price + $product->pizzaSize->price;
            }
        }
        if ($payement->amount >= $total) {
            $payement->amount -= $total;
            $this->status = "placed";
            $this->date = new DateTime();
            array_push(Db::$orders, $this);
            echo "Payement Done thank you for making your order\n";
        } else {
            echo "you still need to add " . ($total - $payement->amount) . " ???\n";
        }
    }
}
