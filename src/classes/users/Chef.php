<?php
namespace classes\users;
use Data\Db;

class Chef extends Person
{
    public $dateEmbauche;

    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday, string $dateEmbauche, string $access)
    {
        $this->dateEmbauche=$dateEmbauche;
        parent::__construct($fname,$lname,$email,$password,$birthday,$access);
    }

    /**
     * Function: seeAllOrders
     * Description:
     *      - Display all placed orders
     */
    public function seeAllOrders()
    {
        foreach (Db::$orders as $key => $order) {
            if($order->status =="placed"){
                echo "Key : $key ---> " . "$order->orderID - Date : ". $order->date->format('d/m/Y') ."\n";
            }
        }
    }
}

?>