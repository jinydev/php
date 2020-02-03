<?php

class Request
{
    public $_a, $_b;
    public $_o;

    public function __construct($a, $b, $o)
    {
        echo __CLASS__." 객체를 생성하였습니다.<br>";
        
        $this->_a = $a;
        $this->_b = $b;
        $this->_o = $o;

    }

}