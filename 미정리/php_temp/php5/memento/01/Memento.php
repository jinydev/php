<?php

class Memento
{
    protected $_mementoState;

    // 메멘토로 전달된 상태를 초기화 메서드로 저장합니다.
    public function __construct($state)
    {
        $this->_mementoState = $state;
    }

    // 메멘토의 상태값을 읽어 옵니다.
    public function getState()
    {
        return $this->_mementoState;
    }
}