<?php

namespace classes\orders;

use classes\recipes\ComposedRecipe;
use Data\Db;

class Order
{
    public $status, $date, $orderID;
    public $product = [];

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
    public function AddExistingProduct($productKey)
    {
        array_push($this->products, Db::$recipees[$productKey]);
        echo "Product added to your order\n";
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
}
