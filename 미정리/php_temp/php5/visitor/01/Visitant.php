<?php
/**
 * 방문 설문조사 하는 사람
 */
class Visitant implements Visitor
{
    private $_population;

    public function __construct()
    {
        echo "방문객 ".__CLASS__." 객체를 생성하였습니다.<br>";
        $this->$_population = 0;
    }

    public function visit($visitable)
    {
        // echo __METHOD__."를 호출합니다.<br>";
        echo "... 반갑게 맞이해 주셔서 감사합니다.<br>";
        // 방문자를 확인을 합니다.
        // 입력된 객체의 클래스가 VisitableA 인지를 확인합니다.
        if ($visitable instanceof VisitingAreas) {
            // 합계를 구합니다.
            echo "... 이곳은 총 ".$visitable->getPeople()."명 이군요.<br>";
            $this->_population += $visitable->getPeople();
        }
    }

    public function population()
    {
        return $this->_population;
    }
}