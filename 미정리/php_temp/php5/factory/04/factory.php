<?php

class Factory
{
    static public function getInstance()
    {
        echo "팩토리:인스턴스를 생성하여 반환합니다.<br>";
        return new Product();
    }
}