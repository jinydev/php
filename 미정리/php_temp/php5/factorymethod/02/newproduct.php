<?php

class NewProduct extends Product
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    public function hello()
    {
        echo "New 상품을 사용합니다.";
    }
}