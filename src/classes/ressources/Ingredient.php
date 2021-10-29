<?php
namespace classes\ressources;

class Ingredient
{
    public $price, $name, $category, $base;

    public function __construct(string $name, string $category, float $price, bool $base)
    {
        $this->name = $name;
        $this->category = $category;
        $this->base = $base; //Is this ingredient is a base for a recipe? 0/1
        $this->price = $price;
    }
}

?>
