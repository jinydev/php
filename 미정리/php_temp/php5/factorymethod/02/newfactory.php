<?php

class NewFactory extends Factory
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    public function createProduct()
    {
        return new NewProduct();
    }
}