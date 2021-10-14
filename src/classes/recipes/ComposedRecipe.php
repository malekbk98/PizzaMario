<?php

namespace classes\recipes;

class ComposedRecipe extends Recipe
{
    public $reference;
    public function __construct(mixed $ingredients, double $price)
    {
        parent::__construct($ingredients,$price);
    }
}

?>