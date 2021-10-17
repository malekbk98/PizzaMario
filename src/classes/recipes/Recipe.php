<?php
namespace classes\recipes; 

abstract class Recipe
{
    public $price;
    public $ingredients=[];

    public function __construct(array $ingredients, float $price)
    {
        $this->ingredients = $ingredients;
        $this->price = $price;
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