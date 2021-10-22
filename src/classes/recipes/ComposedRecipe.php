<?php

namespace classes\recipes;

class ComposedRecipe extends Recipe
{
    public $reference;

    public function __construct($reference)
    {
        $this->reference = $reference;
    }
}
