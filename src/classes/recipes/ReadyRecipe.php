<?php

namespace classes\recipes;

class ReadyRecipe extends Recipe
{
    public $name;
    public $category;

    public function __construct(mixed $ingredients, double $price, string $name, string $category)
    {
        parent::__construct($ingredients,$price);
        $this->category= $category;
        $this->name= $name;
    }
}

?>