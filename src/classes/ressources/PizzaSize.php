<?php

namespace classes\ressources;

class PizzaSize
{
    public $size, $price;
    public function __construct(string $size, float $price)
    {
        $this->size = $size;
        $this->price = $price;
    }
}

?>
