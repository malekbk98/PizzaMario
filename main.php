<?php

use \classes\users\Admin;
use \classes\users\Chef;
use \classes\ressources\Ingredient;
use \classes\recipes\ReadyRecipe;
require_once 'src/utils/AbstractClassLoader.php';
require_once 'src/utils/ClassLoader.php'; 

//Class Loader ***********************************************************
$loader = new \mf\utils\ClassLoader('src');
$loader->register();

//Create a new admin
$admin = new Admin("Malek","Ben Khalifa","malek@gmail.com","password","19-02-1998");
print_r($admin);
//Create a new chef
$chef = new Chef("Mario","Italia","mario@gmail.com","password","05-10-1988","10-01-2021");
print_r($chef);

//Add Incredients (base incredients)
$dough = new Ingredient("Dough","dough",0,true);
$sauce = new Ingredient("Sauce","Sauce",0,true);

//Add Incredients (normal incredients)
$mozzarella = new Ingredient("Mozzarella","cheese",1,false);
$parmesan = new Ingredient("Parmesan","cheese",1,false);
$olive = new Ingredient("Olive","vegetables",0.5,false);
$mushroom = new Ingredient("Mushroom","vegetables",0.75,false);
$pepperoni = new Ingredient("Pepperoni","meat",1.5,false);
$beaf = new Ingredient("Beaf","meat",1.5,false);

//Add Recepie
$recepie_1 = new ReadyRecipe([$dough,$sauce,$mozzarella],6,"Pizza margarita","pizza");
$recepie_2 = new ReadyRecipe([$dough,$sauce,$mozzarella,$pepperoni],8,"Pizza pepperoni","pizza");

?>