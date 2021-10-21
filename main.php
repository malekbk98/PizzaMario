<?php

use classes\users\Admin;
use classes\users\Chef;
use classes\ressources\Ingredient;
use classes\recipes\ReadyRecipe;
require_once 'src/utils/AbstractClassLoader.php';
require_once 'src/utils/ClassLoader.php';

//Class Loader ***********************************************************
$loader = new \mf\utils\ClassLoader('src');
$loader->register();

//Create a new admin
$admin = new Admin("Malek", "Ben Khalifa", "admin@admin.com", "password", "19-02-2015");
$admin->createAccount();
//$admin->logout();
//$admin->login("admin@admin.com", "password");
//$admin->changeData("Malek", "BenKhalifa", "admin@admin.com", "password", "19-02-1998");
//$admin->changePassword("password", "newpassword"); 
//$admin->forgetPassword("admin@admin.com", "12345","hello"); 
//print_r($admin);

//Create a new chef
$chef = new Chef("Mario", "Italia", "chef@chef.com", "password", "05-10-1988", "10-01-2021");
$chef->createAccount();
//$chef->logout();
//$chef->login("chef@chef.com", "password");

//Add Incredients (base incredients)
$dough = new Ingredient("Dough", "dough", 0, true);
$sauce = new Ingredient("Sauce", "Sauce", 0, true);

//Add Incredients (normal incredients)
$mozzarella = new Ingredient("Mozzarella", "cheese", 1, false);
$parmesan = new Ingredient("Parmesan", "cheese", 1, false);
$olive = new Ingredient("Olive", "vegetables", 0.5, false);
$mushroom = new Ingredient("Mushroom", "vegetables", 0.75, false);
$pepperoni = new Ingredient("Pepperoni", "meat", 1.5, false);
$beaf = new Ingredient("Beaf", "meat", 1.5, false);

//Add Incredients to DB classe
$admin->addIngredient($dough);
$admin->addIngredient($sauce);
$admin->addIngredient($mozzarella);
$admin->addIngredient($parmesan);
$admin->addIngredient($olive);
$admin->addIngredient($mushroom);
$admin->addIngredient($pepperoni);
$admin->addIngredient($beaf);

//Get all ingredients from DB classe
$admin->seeIngredients();

//Add Recepie
$recepie_1 = new ReadyRecipe([$dough, $sauce, $mozzarella], 6, "Pizza margarita", "pizza");
$recepie_2 = new ReadyRecipe([$dough, $sauce, $mozzarella, $pepperoni], 8, "Pizza pepperoni", "pizza");

?>
