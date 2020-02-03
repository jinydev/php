<?php

class Product
{
    public function __construct()
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
    }
}

$obj = new Product();
