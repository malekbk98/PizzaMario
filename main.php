<?php

use classes\orders\Order;
use classes\users\Admin;
use classes\users\Chef;
use classes\ressources\Ingredient;
use classes\ressources\Pizza;

require_once 'src/utils/AbstractClassLoader.php';
require_once 'src/utils/ClassLoader.php';

//Class Loader ***********************************************************
$loader = new \mf\utils\ClassLoader('src');
$loader->register();
session_start();

echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";
echo "------------------------ ADMIN ----------------------\n";
echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";

/**
 * Create a new admin
 */
$admin = new Admin("Malek", "Ben Khalifa", "admin@admin.com", "password", "19-02-2015", 200);
$admin->createAccount();

/**
 * Admin Authentification
 */
//$admin->logout();
//$admin->login("admin@admin.com", "password");

/**
 * Update profile
 */
//$admin->changeData("Malek", "BenKhalifa", "admin@admin.com", "password", "19-02-1998");
//$admin->changePassword("password", "newpassword");

/**
 * Forget password
 */
//$admin->forgetPassword("admin@admin.com", "12345","hello");
//print_r($admin);

/**
 * 
 * INCREDIENTS CRUDs
 * 
 */
/**
 * Add Incredients (base incredients)
 */
$dough = new Ingredient("Dough", "dough", 1.5, true);
$sauce = new Ingredient("Sauce", "Sauce", 1.5, true);

/**
 * Add Incredients (normal incredients)
 */
$mozzarella = new Ingredient("Mozzarella", "cheese", 2, false);
$parmesan = new Ingredient("Parmesan", "cheese", 2, false);
$olive = new Ingredient("Olive", "vegetables", 1, false);
$mushroom = new Ingredient("Mushroom", "vegetables", 2, false);
$pepperoni = new Ingredient("Pepperoni", "meat", 3, false);
$beaf = new Ingredient("Beaf", "meat", 3, false);

/**
 * Add Incredients to DB classe
 */
$admin->addIngredient($dough);
$admin->addIngredient($sauce);
$admin->addIngredient($mozzarella);
$admin->addIngredient($parmesan);
$admin->addIngredient($olive);
$admin->addIngredient($mushroom);
$admin->addIngredient($pepperoni);
$admin->addIngredient($beaf);

/**
 * Get all ingredients from DB classe
 */
$admin->seeIngredients();

/**
 * Remove an ingredient
 */
$admin->deleteIngredient($parmesan);


/**
 * 
 * PRODUCTS CRUDs
 * 
 */
/**
 * Add Product
 */
$pizzaMarguerita = new Pizza("Pizza marguerita", 6);
//Base ingredients => if one of those are not included, admin can't add a new recipe
$pizzaMarguerita->addIngerdiant($dough);
$pizzaMarguerita->addIngerdiant($sauce);
$pizzaMarguerita->addIngerdiant($mozzarella);

$pizzaPepperoni = new Pizza("Pizza pepperoni", 8);
$pizzaPepperoni->addIngerdiant($dough);
$pizzaPepperoni->addIngerdiant($sauce);
$pizzaPepperoni->addIngerdiant($mozzarella);
$pizzaPepperoni->addIngerdiant($pepperoni);
$pizzaPepperoni->addIngerdiant($mushroom);

/**
 * Remove ingredient from product
 */
$pizzaPepperoni->removeIngredient($sauce);
$pizzaPepperoni->removeIngredient($mozzarella);

/**
 * 
 * RECIPE CRUDs
 * 
 */

/**
 * Add Recipe
 */
$admin->addRecipe($pizzaMarguerita);
$admin->addRecipe($pizzaPepperoni);

/**
 * Delete Recipe
 */
//$admin->deleteRecipe($pizzaPepperoni);

/**
 * See all recipes
 */
$admin->seeRecipes();



echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";
echo "------------------------ CLIENT -------------------------\n";
echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";

/**
 * Client make new order
 */

$order1 = new Order();

//$order1->seeAvailableProducts();

$order1->AddExistingProduct($pizzaPepperoni);

$order1->seeOrderDetails();

$order1->seeAvailableIngredients();

$order1->AddIngredientToProduct($pizzaPepperoni, $olive);

$composedProduct = $order1->generateNewProduct([$mozzarella, $olive, $beaf]);
$composedProduct = $order1->generateNewProduct([$mozzarella, $olive, $beaf, $dough]);

$order1->AddIngredientToProduct($composedProduct, $mushroom);
$order1->AddIngredientToProduct($composedProduct, $sauce);

$order1->seeOrderDetails();


echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";
echo "------------------------ CHEF -------------------------\n";
echo "----------------------------------------------------------\n";
echo "----------------------------------------------------------\n";

/**
 * Create new chef
 */
$chef = new Chef("Mario", "Italia", "chef@chef.com", "password", "05-10-1988", "10-01-2021", 100);
$chef->createAccount();

/**
 * Chef Authentification
 */
//$chef->logout();
//$chef->login("chef@chef.com", "password");
