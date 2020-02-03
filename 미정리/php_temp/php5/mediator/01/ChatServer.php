<?php

class ChatServer extends Mediator
{
    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
        echo ">>>채팅 서버가 생성이 되었습니다.<br>";
    }

    public function mediate($data, $user)
    {
        echo $user."로 부터 서버 메시지를 받았습니다 = <b>".$data."</b><br>";
  
        foreach ($this->_list as $obj) {
            //echo "<pre>==";
            //print_r($obj);
            //echo "</pre>";
            echo ">>>메시지를 유저(". $obj->userName() .")들에게 전달합니다.<br>";
            $obj->handle($data);
        }
        
        
    }
}