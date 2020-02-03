<?php

class Proxy implements Subject
{
    private $_object;

    public function __construct($real)
    {
        echo __CLASS__." 객체가 생성이 되었습니다.\n";
        $this->_object = $real;
    }

    public function action1()
    {
        echo __METHOD__."를 호출합니다.\n";
        echo "action1 작업을 처리합니다.\n";
    }

    public function action2()
    {
        echo __METHOD__."를 호출합니다.\n";
        $this->_object->action2();
    }
}