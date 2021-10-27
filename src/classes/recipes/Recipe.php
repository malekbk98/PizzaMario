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
     *      - Add ingredient to recipee ingredients
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
    public function removeIngredient($ingredientKey)
    {
        if (isset($this->ingredients[$ingredientKey])) {
            if ($this->ingredients[$ingredientKey]->base) {
                echo "cannot delete base ingredient!<br>";
            } else {
                unset($this->ingredients[$ingredientKey]);
            }
        } else {
            echo "error deleting Ingredient from product!<br>";
        }
    }
}
