# TP-Contrôle continu

### Developer team

* Malek Ben Khalifa
* Youssef Bahi

### Creation date

* 13/10/2021

### Context

* This project is part of ` LP CIASIE : Conception pour le Web LP1 `.
* This project developed for ` Pizza Mario `. 

### General Description

* This project matches the requirements of our client "Pizza Mario", where it allows customers to order food through touch screens based in the restaurant.
* Customers can either choose from existing recipes or compose their desired food.
* All the available menus, ingredients, pizzas are managed by the admin where he can add/delete/view/update (CRUD).
* All the orders are handled by a chef, who can work on orders and change the status (in progress/done/in hold/...).
* Clients are not required to authenticate since the touch screens are public devices, however, they will get a unique order number to get notified when food is ready.
* For now our application is based on ordering & composing pizzas, but it's ready to be upgraded at any time to use other menus.

### Technical Description

* This application was developed based on the POO concept.
* Many classes use the heritage principle.
* This application doesn't use databases, however, DB class is used to store the instanced class object (just for organizing purposes, it can be replaced by real database & queries).
* Sessions used to check authentication.
* Access rights assigned to chef and admin:
    - Admin: 200
    - Chef: 100

### Requirements

* PHP 7.2+
* Wamp/Xamp

### How to install (with wamp):


* Unzip the package.
* Lunch wamp.
* Web use:
    * Copy this project under wwww (example: c:\wamp64\www).
    * Open your localhost (http://localhost/).
    * Navigate to the project folder.
* CMD use:
    * Using CMD navigate into the unzipped folder.
    * Type php "main.php" and press enter.