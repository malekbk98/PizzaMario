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
     * Function: seeAllOrders
     * Description:
     *      - Display all placed orders
     */
    public function seeChefOrders()
    {
        if (isset($_SESSION['user'])) {
            foreach (Db::$orders as $key => $order) {
                if ($order->chef == $this->fname." ".$this->lname) {
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
                if (Db::$orders[$orderKey]->status == "placed") {
                    Db::$orders[$orderKey]->seeOrderDetails();
                    Db::$orders[$orderKey]->status = "progress";
                    Db::$orders[$orderKey]->chef = $this->fname." ".$this->lname;
                    echo "Order " . Db::$orders[$orderKey]->orderID . " is on progress \n";
                } else {
                    echo "Ops you can only select placed orders";
                }
            } else {
                echo "Ops! order not found! \n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }

    /**
     * Function: readyOrder
     * Description:
     *      - Mark order as ready
     */
    public function readyOrder($orderKey)
    {
        if (isset($_SESSION['user'])) {
            if (isset(Db::$orders[$orderKey])) {
                if (Db::$orders[$orderKey]->status == "progress") {
                    Db::$orders[$orderKey]->status = "ready";
                    echo "Order " . Db::$orders[$orderKey]->orderID . " is ready";
                } else {
                    echo "Please select this order first";
                }
            } else {
                echo "Ops! order not found! \n";
            }
        } else {
            echo "Ops! please login\n";
        }
    }
}

?>
