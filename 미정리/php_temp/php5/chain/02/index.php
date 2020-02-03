<?php

require "Attact.php";

require "Defense.php";
require "Amor.php";

echo "체인 패턴2 에 대해서 학습을 합니다.<br>";

$attact = new Attact(100);

$amor1 = new Amor(10, "방패");
$amor2 = new Amor(15, "갑옷");
$amor1->setNext($amor2);

// 공격합니다.
$amor1->process($attact);

// 추가 장비 장착
echo "== 장비를 추가 장착합니다.<br>";
$amor3 = new Amor(10, "투구");
$amor2->setNext($amor3);
$amor4 = new Amor(5, "장갑");
$amor3->setNext($amor4);

// 공격합니다.
$amor1->process($attact);

