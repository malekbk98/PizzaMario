<?php
namespace classes\ressources;

class Ingredient
{
    public $price, $name, $category;

    public function __construct(string $name,string $category, double $price)
    {
        $this->name = $name;
        $this->category = $category;
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