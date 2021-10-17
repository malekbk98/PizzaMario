<?php

namespace classes\recipes;

class ComposedRecipe extends Recipe
{
    public $reference;
    public function __construct(array $ingredients, float $price)
    {
        parent::__construct($ingredients,$price);
    }
}

?>