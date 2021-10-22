<?php

namespace classes\payment;

abstract class Payment
{
    public $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }
}
