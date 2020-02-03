<?php
/**
 * 상태를 가지고 있는 객체입니다.
 */
class Originator
{
    // 상태를 저장하기 위해서 변수를 하나 가지고 있습니다.
    protected $_state;

    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.\n";
    }

    // 메멘토의 객체를 생성하여 반환을 합니다.
    public function createMemento()
    {
        echo "상태 = ".$this->_state."의 메멘토 객체를 생성합니다.\n";
        return new Memento($this->_state);
    }

    // 복원합니다.
    public function restoreMemento($mementoObj)
    {
        echo "상태를 복원합니다.\n";
        $this->_state = $mementoObj->getState();
    }

    // 상태를 읽어옵니다.
    public function getState()
    {
        return $this->_state;
    }

    // 상태를 설정합니다.
    public function setState($state)
    {
        echo $state." 객체의 상태를 저장합니다.\n";
        $this->_state = $state;
    }
}