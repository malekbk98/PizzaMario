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
    public function __toString()
    {
        return json_encode($this);
    }

    public function __set(string $name, $value)
    {
        $this->$name = $value;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }
}

?>
