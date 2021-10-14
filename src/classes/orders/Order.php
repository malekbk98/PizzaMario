<?php

namespace classes\orders;

class Order
{
    public $status, $date, $product, $orderID;
    
    public function __construct($product, $orderID)
    {
        $this->orderID = 
        $this->status= false;
        $this->date= new DateTime();
    }
}

?>