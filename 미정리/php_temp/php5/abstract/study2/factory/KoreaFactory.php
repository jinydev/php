<?php

class KoreaFactory extends Factory
{
    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }

    public function createTire()
    {
        return new KoreaTireProduct;
    }

    public function createDoor()
    {
        return new KoreaDoorProduct;
    }
}