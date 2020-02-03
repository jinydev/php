<?php

abstract class Mediator
{
    // 중재를 해야될 객체의 목록을 가지고 있습니다.
    // Colleague가 적용된.
    protected $_list = [];

    public function addColleague($colleague)
    {
        if ($colleague) {
            array_push($this->_list, $colleague);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function listMembers()
    {
        return $this->_list;
    }

    abstract function mediate($data, $user);
    

}