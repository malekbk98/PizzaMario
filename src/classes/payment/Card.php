<?php

namespace classes\payment;

class Card extends Payment
{
    public $cardNumber;
    public $code;
    public $valid = false;

    public function __construct(float $amount, string $cardNumber, $code, $valid)
    {
        parent::__construct($amount);
        $this->code = $code;
        $this->cardNumber = $cardNumber;
        $this->valid = $valid;
    }
}
