<?php

namespace classes\payment;

class Card extends Payment
{
    public $cardNumber;
    public $valid=false;

    public function __construct(string $orderID, double $amount, string $cardNumber)
    {
        parent::__construct($orderID,$amount);
        $this->cardNumber= $cardNumber;
    }
}

?>