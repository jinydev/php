<?php

class Employee
{
    public $_subs = [];

    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }

    // 관찰자 목록을 등록합니다.
    public function subscribeNotification(Manager $sub)
    {
        array_push($this->_subs, $sub);
    }


    public function update()
    {
        foreach ($this->_subs as $observer) {
            $observer->message();
        }
    }
}