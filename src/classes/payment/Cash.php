<?php

namespace classes\payment;

class Cash extends Payment
{
    public function addCash($amountToAdd)
    {
        $this->amount += $amountToAdd;
    }
}
