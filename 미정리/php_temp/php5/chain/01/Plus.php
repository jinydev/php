<?php

class Plus extends Calculator
{
    public function __construct()
    {
        echo __CLASS__." 객체를 생성하였습니다.<br>";
    }

    protected function operator($request)
    {
        echo __CLASS__."연산을 작업합니다>>> ";
        if ($request->_o == "+") {
            echo "더하기 연산입니다.<br>";
            return TRUE;
        }
        return FALSE;
    }
}