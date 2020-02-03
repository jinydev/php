<?php
/**
 * 구현체
 */
class UserA extends Manager
{
    public function __construct($name)
    {
        echo __CLASS__."객체를 생성합니다.<br>";
        $this->_name = $name;
    }

    public function message()
    {
        echo $this->_name." 환영합니다.<br>";
    }
}