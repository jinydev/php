<?php

// 청사진(bluePrint)의 추상을 적용하여
// 실제를 구현합니다.
class Product extends BluePrint
{
    private $_computer;

    public function __construct()
    {
        echo "컴퓨터 ".__CLASS__ ."객체를 생성하였습니다.<br>";
        // 초기화 매직메서드 실행시
        // 컴퓨터 객체 인스턴스를 생성하여 저장합니다.
        $this->_computer = new Computer("default", "default", "default");

    }

    public function setCpu()
    {
        echo "CPU를 설정합니다. ";
        $this->_computer->_cpu = "i7";

        return $this;
    }

    public function setRam()
    {
        echo "RAM를 설정합니다. ";
        $this->_computer->_ram = "8gb";

        return $this;
    }
    
    public function setStorage()
    {
        echo "Storage를 설정합니다. ";
        $this->_computer->_storage = "512gb";

        return $this;
    }

    public function getComputer()
    {
        return $this->_computer;
    }
}