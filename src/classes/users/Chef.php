<?php
namespace classes\users;
use Data\Db;

class Chef extends Person
{
    public $dateEmbauche;

    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday, string $dateEmbauche, string $access)
    {
        $this->dateEmbauche = $dateEmbauche;
        parent::__construct($fname, $lname, $email, $password, $birthday, $access);
    }

    /**
     * Function: seeAllOrders
     * Description:
     *      - Display all placed orders
     */
    public function seeAllOrders()
    {
        if (isset($_SESSION['user'])) {
            foreach (Db::$orders as $key => $order) {
                if ($order->status == "placed") {
                    echo "Key : $key ---> " . "$order->orderID - Date : " . $order->date->format('d/m/Y') . "\n";
                }
            }
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: selectOrder
     * Description:
     *      - Select order to work on it
     */
    public function selectOrder($orderKey)
    {
        if (isset($_SESSION['user'])) {
            if (isset(Db::$orders[$orderKey])) {
                Db::$orders[$orderKey]->seeOrderDetails();
                Db::$orders[$orderKey]->status = "In progress";
                echo "Order " . Db::$orders[$orderKey]->orderID . " is on progress";
            } else {
                echo "Ops! order not found! \n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }
}

?>
