<?php

namespace classes\ressources;

class Pizza extends Product
{
    public $pizzaSize;
    public function __construct(Recipe $recipe, string $category, string $name, PizzaSize $size)
    {
        $this->pizzaSize = $size;
        parent::__construct($recipe, $category, $name);
    }
}

?>
