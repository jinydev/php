<?php

abstract class Calculator
{
    // 다음동작
    private $_next;

    public function setNext($obj)
    {
        $this->_next = $obj;
    }

    public function process($request)
    {
        if ($this->operator($request)) {
            echo ">>> 연산이 성공적으로 처리가 되었습니다.<br>";
            return TRUE;
        } else {

            echo ">>> 연산 실패. 다음 연산으로 전달합니다.<br>";
            // 다음 체인 동작으로 처리합니다.
            if ($this->_next) {
                return $this->_next->process($request);
            }
        }
        echo "!!! 연산 실패. <br>";
        return FALSE;
    }

    // 실제적인 동작
    abstract protected function operator($request);
}