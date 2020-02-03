<?php

class kiaFactory implements CarFactory
{
    public function createBody()
    {
        echo __CLASS__."의 body를 생성합니다.<br>";
        echo "인스턴스를 생성하여 객체를 반환합니다.<br>";
        return new Body;
    }

    public function createTire()
    {
        echo __CLASS__."의 Tire를 생성합니다.<br>";
        echo "인스턴스를 생성하여 객체를 반환합니다.<br>";
        return new Tire;
    }

}