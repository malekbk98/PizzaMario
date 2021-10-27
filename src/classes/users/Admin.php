<?php
namespace classes\users;
use Data\Db;

class Admin extends Person
{
    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday, string $access)
    {
        parent::__construct($fname, $lname, $email, $password, $birthday,$access);
    }

    /**
     * Function: addIngredient
     * Description:
     *      - Add ingredients to DB classe
     */
    public function addIngredient($ingredient)
    {
        if (isset($_SESSION['user'])) {
            array_push(Db::$ingredients, $ingredient);
            echo "Ingredient added to database! \n";
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: seeIngredients
     * Description:
     *      - Display all ingredients
     */
    public function seeIngredients()
    {
        if (isset($_SESSION['user'])) {
            foreach (Db::$ingredients as $key => $ingredient) {
                echo "Key : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price . ", base ingredient : " . $ingredient->base . "\n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: deleteIngredient
     * Description:
     *      - Delete an ingredient
     */
    public function deleteIngredient(&$ingredient)
    {
        if (isset($_SESSION['user'])) {
            $index = array_search($ingredient, Db::$ingredients);
            if ($index) {
                unset(Db::$ingredients[$index]);
                $ingredient = null;
                echo "Ingredient deleted!\n";
            } else {
                echo "Ingredient not found!\n";
            }
        } else {
            echo "Ops! please login\n";
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
        if (isset($_SESSION['user'])) {
            $findBase = false;
            foreach ($recipe->ingredients as $ingredient) {
                if ($ingredient->base == true) {
                    $findBase = true;
                    break;
                }
            }
            if ($findBase == true) {
                array_push(Db::$recipees, $recipe);
                echo "Recipe added to database!\n";
            } else {
                echo "This recipe dosn't have a base ingredient, please add one!\n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: deleteRecipe
     * Description:
     *      - Delete a recipe from DB classe
     */
    public function deleteRecipe(&$recipe)
    {
        if (isset($_SESSION['user'])) {
            $index = array_search($recipe, Db::$recipees);
            if ($index) {
                unset(Db::$recipees[$index]); //Remove from DB classe
                $recipe = null; //unset passed instance
                echo "Recipe deleted!\n";
            } else {
                echo "Ops! recipe not found!\n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: seeRecipes
     * Description:
     *      - Display all recipes
     */
    public function seeRecipes()
    {
        if (isset($_SESSION['user'])) {
            foreach (Db::$recipees as $key => $recipe) {
                echo "----------------------------------------------------------\n";
                echo "Key : $key ---> name : " . $recipe->name . ", category : " . $recipe->category . ", price : " . $recipe->price . "\n";
                echo "\tIngredients:\n";
                foreach ($recipe->ingredients as $key => $ingredient) {
                    echo "\t\t Incredient : $key ---> name : " . $ingredient->name . ", category : " . $ingredient->category . ", price : " . $ingredient->price . "\n";
                }
                echo "----------------------------------------------------------\n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }
}

?>
