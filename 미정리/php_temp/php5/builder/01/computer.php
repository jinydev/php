<?php

class Computer
{
    public $_cpu;
    public $_ram;
    public $_storage;

    public function __construct($cpu, $ram, $storage)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        $this->_cpu = $cpu;
        $this->_ram = $ram;
        $this->_storage = $storage;

    }

    public function __toString()
    {
        return "이 컴퓨터의 사양은 CPU=". $this->_cpu. " RAM= ".$this->_ram. " Storage= ".$this->_storage. "입니다.<br>";
    }
}