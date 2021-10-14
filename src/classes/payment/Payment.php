<?php
namespace classes\payment;

abstract class Payment
{
    public $amount, $date, $orderID;

    public function __construct(string $orderID, double $amount)
    {
        $this->orderID = $orderID;
        $this->amount = $amount;
        $this->date = new DateTime();

    }

    public function __toString()
    {
        return json_encode($this);
    }

    public function __set(string $name, $value)
    {
        $this->$name = $value;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }
}

?>