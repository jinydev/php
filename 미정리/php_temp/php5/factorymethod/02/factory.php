<?php

abstract class Factory
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    public final function create()
    {
        // 팩토리 생성을 직접 반환하지 않고
        // 상속받은 클래스에서 구현합니다.
        // return new Product();
        return $this->createProduct();
    }

    abstract public function createProduct();
}