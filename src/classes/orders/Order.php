<?php

namespace classes\orders;

use Data\Db;

class Order
{
    public $status, $date, $orderID;
    public $product = [];

    public function __construct()
    {
        $this->orderID = "ORD-" . count(Db::$orders);
        echo "Order Number : " . $this->orderID . "\n";
    }
}
