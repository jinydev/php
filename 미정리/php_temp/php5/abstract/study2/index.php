<?php

// 생성될 객체의 제품군을 정의
require "./product/DoorProduct.php";
require "./product/korea/KoreaDoorProduct.php";
require "./product/state/StateDoorProduct.php";

require "./product/TireProduct.php";
require "./product/korea/KoreaTireProduct.php";
require "./product/state/StateTireProduct.php";

// 추상 팩토리 패턴 정의
require "./factory/Factory.php";
require "./factory/KoreaFactory.php";
require "./factory/StateFactory.php";

echo "추상 팩토리 패턴을 실습합니다.<hr>";

// 한국공장
$korea = new KoreaFactory;

$ham = $korea->createTire();
$ham->makeAssemble();

$bread = $korea->createDoor();
$bread->makeAssemble();

echo "<br>";

// 미국공장
$state = new StateFactory;

$ham = $state->createTire();
$ham->makeAssemble();

$bread = $state->createDoor();
$bread->makeAssemble();