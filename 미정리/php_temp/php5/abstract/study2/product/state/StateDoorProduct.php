<?php

class StateDoorProduct extends DoorProduct
{
    public function __construct()
    {
        echo "Product =".__CLASS__."객체를 생성합니다.<br>";
    }

    public function makeAssemble()
    {
        echo "메소드 호출 ".__METHOD__."<br>";
        echo "미국형 도어장착<br>";
    }
}