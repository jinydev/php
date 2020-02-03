<?php

class Attact
{
    private $_amount;

    public function __construct($amount)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        echo "...".$amount." 치명타를 공격하였습니다.<br>";
        $this->_amount = $amount;
    }

    public function getAmount()
    {
        return $this->_amount;
    }

    public function setAmount($amt)
    {
        $this->_amount = $amt;
    }
}