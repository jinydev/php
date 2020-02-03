<?php
/**
 * 플라이웨이트 클래스를 생성합니다.
 */
class Flyweight
{
    public function __construct()
    {
        echo __CLASS__." 객체를 생성합니다.\n";
    }

    public function getData($data)
    {
        echo "입력값($data)을 반환합니다.\n";
    }

}