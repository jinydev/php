<?php

require "visitor.php";
require "Visitant.php";

require "visitable.php";
require "VisitingAreas.php";

echo "방문자 패턴을 학습합니다.<br>";

// 방문객 객체를 생성합니다.
$visitant = new Visitant;

// 방문객이 방문지를 하나씩 
$areas = [
    new VisitingAreas("James",3),
    new VisitingAreas("Jiny",2),
    new VisitingAreas("Eric",4)
];
foreach ($areas as $obj) $obj->accept($visitant);

echo "<br>우리 동내 총 인구는 <b>". $visitant->population() ."</b> 입니다.";



