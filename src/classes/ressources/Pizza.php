<?php

namespace classes\ressources;

use classes\recipes\Product;

class Pizza extends Product
{
    public $pizzaSize;

    public function __construct(string $name, float $price)
    {
        parent::__construct($name, "Pizza", $price);
    }

    public function assignSize(PizzaSize $size)
    {
        $this->pizzaSize = $size;
    }
}
