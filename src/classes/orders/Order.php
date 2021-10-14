<?php

namespace classes\orders;

class Order
{
    public $status, $date, $orderID;
    public $product=[];
    
    public function __construct(array $product, string $orderID)
    {
        $this->orderID = 
        $this->status= false;
        $this->date= new DateTime();
    }
}

?>