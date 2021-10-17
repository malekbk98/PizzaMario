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
