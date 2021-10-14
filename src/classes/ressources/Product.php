<?php
namespace classes\ressources;

abstract class Products
{
    public $recipe, $category, $name;

    public function __construct(Recipe $recipe, string $category, string $name)
    {
        $this->recipe = $recipe;
        $this->category = $category;
        $this->name = $name;
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
