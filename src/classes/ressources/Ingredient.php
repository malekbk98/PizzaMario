<?php
namespace classes\ressources;

class Ingredient
{
    public $price, $name, $category;

    public function __construct(string $name, string $category, double $price, boolean $base)
    {
        $this->name = $name;
        $this->category = $category;
        $this->base = $base; //Is this ingredient is a base for a recipe? 0/1
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
