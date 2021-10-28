<?php

namespace classes\ressources;

use classes\recipes\ComposedRecipe;

class ComposedPizza extends ComposedRecipe
{
    public $pizzaSize;

    public function __construct($reference)
    {
        parent::__construct($reference);
    }

    public function assignSize(PizzaSize $size)
    {
        $this->pizzaSize = $size;
    }
}
