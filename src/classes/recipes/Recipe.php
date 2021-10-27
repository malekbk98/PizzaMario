<?php

namespace classes\recipes;

abstract class Recipe
{
    public $price;
    public $ingredients = [];


    public function __construct(float $price)
    {
        $this->price = $price;
    }


    /**
     * Function: addIngerdiant
     * Description:
     *      - Add ingredient to recipe ingredients
     */
    public function addIngerdiant($ingredient)
    {
        array_push($this->ingredients, $ingredient);
        echo "Ingredient added to product!<br>";
    }

    /**
     * Function: removeIngredient
     * Description:
     *      - Remove ingredient to recipee ingredients
     */
    public function removeIngredient(&$ingredient)
    {
        $index=array_search($ingredient, $this->ingredients);
        if ($index) {
            if ($this->ingredients[$index]->base) {
                echo "Cannot delete base ingredient!<br>";
            } else {
                echo "Ingredient deleted!<br>";
                unset($this->ingredients[$index]);
                $ingredient=null;
            }
        }else{
            echo "Ops! ingredients not found!<br>";
        }
    }
}
