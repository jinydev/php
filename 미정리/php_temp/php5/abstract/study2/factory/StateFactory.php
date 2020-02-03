<?php

class StateFactory extends Factory
{
    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }
    
    public function createTire()
    {
        return new StateTireProduct;
    }

    public function createDoor()
    {
        return new StateDoorProduct;
    }
}