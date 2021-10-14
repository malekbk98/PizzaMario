<?php

namespace classes\orders;

class Order
{
    public $status, $date, $orderID;
    public $product=[];
    
    public function __construct(array $product)
    {
        $this->orderID = "ORD-000005";
        $this->status= false;
        $this->date= new DateTime();
    }
}

?>