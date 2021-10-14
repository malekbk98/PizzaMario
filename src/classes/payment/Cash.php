<?php

namespace classes\payment;

class Cash extends Payment
{
    public $paidAmount;

    public function __construct(string $orderID, double $amount, double $paidAmount)
    {
        parent::__construct($orderID,$amount);
        $this->paidAmount= $paidAmount;
    }
}

?>