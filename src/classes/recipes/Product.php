<?php

namespace classes\recipes;

class Product extends Recipe
{
    public $name;
    public $category;

    public function __construct(string $name, string $category, float $price)
    {
        $this->category = $category;
        $this->name = $name;
        parent::__construct($price);
    }
}
