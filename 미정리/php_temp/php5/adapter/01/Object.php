<?php

class Objects implements Adapter
{
    private $_adapter;
    
    function __construct()
    {
        $this->_adapter = new math;
    }

    public function twiceOf(int $num):int
    {
        echo "정수 2배 적용합니다.\n";

        // 캐스팅을 통하여 실수로 변환하여 전달합니다.
        $_num = $this->_adapter->twoTime( (float)$num );

        // 캐스팅을 통하여 정수로 변환하여 반환을 합니다.
        return (int)$_num;
    }

    public function halfOf(int $num):int
    {
        echo "정수 1/2배 적용합니다.\n";

        // 캐스팅을 통하여 실수로 변환하여 전달합니다.
        $_num = $this->_adapter->halfTime( (float)$num );

        // 캐스팅을 통하여 정수로 변환하여 반환을 합니다.
        return (int)$_num;
    }
}