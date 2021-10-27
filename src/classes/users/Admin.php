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

    /**
     * Function: deleteIngredient
     * Description:
     *      - Delete an ingredient
     */
    public function deleteIngredient(&$ingredient)
    {
        $index=array_search($ingredient, Db::$ingredients);
        if ($index) {
            unset(Db::$ingredients[$index]);
            $ingredient=null;
            echo "Ingredient deleted!<br>";
        } else {
            echo "Ingredient not found!<br>";
        }            
    }

    /**
     * Function: addRecipe
     * Description:
     *      - Add recipes to DB classe
     *      - Check if recipe have at least 1 base ingredient
     */
    public function addRecipe($recipe)
    {
        $findBase=false;
        foreach ($recipe->ingredients as $ingredient) {
            if ($ingredient->base == true) {
                $findBase=true;
                break;
            }
        }
        if($findBase==true){
            array_push(Db::$recipees, $recipe);
            echo "Recipe added to database!<br>";
        }else{
            echo "This recipe dosn't have a base ingredient, please add one!<br>";
        }
    }

    /**
     * Function: deleteRecipe
     * Description:
     *      - Delete a recipe from DB classe
     */
    public function deleteRecipe(&$recipe)
    {
        $index=array_search($recipe, Db::$recipees);
        if ($index) {
            unset(Db::$recipees[$index]); //Remove from DB classe
            $recipe=null; //unset passed instance
            echo "Recipe deleted!<br>";
        } else {
            echo "Ops! recipe not found!<br>";
        }
    }

    /**
     * Function: seeRecipes
     * Description:
     *      - Display all recipes
     */
    public function seeRecipes()
    {
        foreach (Db::$recipees as $key => $recipe) {
            echo "----------------------------------------------------------<br>";
            echo "Key : $key ---> name : " . $recipe->name . ", category : " . $recipe->category . ", price : " . $recipe->price . "<br>";
            echo "\tIngredients:<br>";
            foreach ($recipe->ingredients as $key => $ingredient) {
                echo "\t\t Incredient : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price . "<br>";
            }
            echo "----------------------------------------------------------<br>";
        }
    }

}

?>