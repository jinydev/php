<?php
/**
 * 팩토리 클래스를 생성합니다.
 */
class FlyweightFactory
{
    public $_arrInstance;

    public function __construct()
    {
        echo __CLASS__." 객체를 생성합니다.\n";
    }

    public function getFlyweight($name)
    {
        if (!$this->_arrInstance[$name]) {
            echo "새로운 Flyweight를 생성합니다.\n";
            $this->_arrInstance[$name] = new $name;
        } else {
            echo "기존 Flyweight를 반환합니다.\n";
        }
        return $this->_arrInstance[$name];
    }
}