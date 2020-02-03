<?php

Class Amor implements Defense
{
    private $_next;
    private $_def;
    
    public $_name;

    public function __construct($def, $name)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        $this->_def = $def;
        $this->_name = $name;
    }

    public function setNext($defense)
    {
        echo "다음 방어구 체인을 추가 하였습니다.<br>";
        $this->_next = $defense;
    }

    public function process($attact)
    {
        // 방어를 처리합니다.
        $this->defense($attact);

        // 다음 방어구에 대한 처리를 연속합니다.
        if ($this->_next) {
            $this->_next->process($attact);
        }
    }

    public function defense($attact)
    {
        echo "*** 방어 ".$this->_name."<br>";

        // 공격값을 읽어 옵니다.
        $amount = $attact->getAmount();

        // 방어값을 적용 합니다.
        $amount = $amount - $this->_def;
        echo ">>> ".$this->_name." 방어 $amount 를 성공하였습니다.<br>";

        // 방어한 새로운 값을 저장합니다.
        $attact->setAmount($amount);
    }


}