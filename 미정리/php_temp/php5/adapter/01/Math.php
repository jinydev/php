<?php

class Math
{
    // 입력한 값을 2배 증가합니다.
    // 입력값과 반환값은 float형 입니다.
    public function twoTime(float $num):float
    {
        echo "실수 2배 적용합니다.\n";
        return $num*2;
    }

    // 입력한 값을 절반으로 감소 합니다.
    // 입력값과 반환값은 float형 입니다.
    public function halfTime(float $num):float
    {
        echo "실수 1/2배 적용합니다.\n";
        return $num/2;
    }
}
