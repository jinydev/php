<?php

abstract class Product
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    abstract public function hello();
}