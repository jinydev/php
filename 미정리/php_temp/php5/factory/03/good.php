<?php

class Good
{
    protected $_name;
    protected $_location;

    public function __construct($name=NULL, $location="kr")
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_name = $name;
        $this->_location = $location;
    }

    public function getName()
    {
        echo "제품명은 ". $this->_name. "입니다. <br>";
    }
}