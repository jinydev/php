<?php
class UserA
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.
        echo "팩토리를 호출합니다.<br>";
        return Product::factory();
    }
}