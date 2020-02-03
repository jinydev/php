<?php

class ChatUser extends Colleague
{
    

    public function __construct($name)
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
        echo "... $name 유저가 생성이 되었습니다.<br>";

        $this->_name = $name;
    }

    public function handle($data)
    {
        echo ">>>...메세지 = ".$data."<br>";
    }
}