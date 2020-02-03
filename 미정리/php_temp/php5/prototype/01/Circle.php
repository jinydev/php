<?php

class Circle extends Shape
{
    private $_x, $_y, $_r;

    public function __construct($x, $y, $r)
    {
        echo __CLASS__." 객체를 생성합니다.<br>";
        $this->_x = $x;
        $this->_y = $y;
        $this->_r = $r;
    }

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function getX($x)
    {
        return $this->_x;
    }

    public function setY($y)
    {
        $this->_y = $y;
    }

    public function getY($y)
    {
        return $this->_y;
    }

    public function setR($r)
    {
        $this->_r = $r;
    }

    public function getR($r)
    {
        return $this->_r;
    }

    public function __toString()
    {
        return "가로=".$this->_x. " 세로=".$this->_y. "지름=".$this->_r. " 입니다.<br>";
    }

    public function copy()
    {
      
    }

    public function __clone()
    {
        echo "객체가 복제가 됩니다.<br>";


    }
}