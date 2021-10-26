<?php

use classes\users\Admin;
use classes\users\Chef;
use classes\ressources\Ingredient;
use classes\ressources\Pizza;

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

//Remove an ingredient
$admin->deleteIngredient(3);

//Add Recepie
$pizzaMarguerita = new Pizza("Pizza marguerita", 6);

$pizzaMarguerita->addIngerdiant($dough);
$pizzaMarguerita->addIngerdiant($sauce);
$pizzaMarguerita->addIngerdiant($mozzarella);

$pizzaPepperoni = new Pizza("Pizza pepperoni", 8);

$pizzaPepperoni->addIngerdiant($dough);
$pizzaPepperoni->addIngerdiant($sauce);
$pizzaPepperoni->addIngerdiant($mozzarella);
$pizzaPepperoni->addIngerdiant($pepperoni);
$pizzaPepperoni->addIngerdiant($mushroom);

//Remove ingredient from product
$pizzaPepperoni->removeIngredient(4);//Removed ingredient 4 ==> muchroo from 
