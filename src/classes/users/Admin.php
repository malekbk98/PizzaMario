<?php
namespace classes\users;
use Data\Db;

class Admin extends Person
{
    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday)
    {
        parent::__construct($fname,$lname,$email,$password,$birthday);
    }

    /**
     * Function: addIngredient
     * Description:
     *      - Add ingredients to DB classe
     */
    public function addIngredient($ingredient)
    {
        array_push(Db::$ingredients, $ingredient);
        echo "Ingredient added to database! <br>";
    }

    /**
     * Function: seeIngredients
     * Description:
     *      - Display all ingredients
     */
    public function seeIngredients()
    {
        foreach (Db::$ingredients as $key => $ingredient) {
            echo "Key : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price .", base ingredient : " . $ingredient->base . "<br>";
        }
    }

}

?>