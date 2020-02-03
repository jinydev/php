<?php
/**
 * 방문할 지역의 집들입니다.
 */
class VisitingAreas implements Visitable
{
    private $_age;
    private $_people;

    public function __construct($name, $people)
    {
        echo "방문지 ".__CLASS__." 객체를 생성하였습니다.<br>";
        $this->_name = $name;
        $this->_people = $people;
    }

    public function accept($visitant)
    {
        // 방문자를 받아들입니다.
        echo ">>> 어서오세요. ".$this->_name."집에 오신것을 환영합니다.<br>";
        
        // 자신의 this를 넣어서 방문자의 visit 메소드를 호출합니다.
        $visitant->visit($this);
    }

    public function setPeople($people)
    {
        $this->_people = $people;
    }

    public function getPeople()
    {
        return $this->_people;
    }
}