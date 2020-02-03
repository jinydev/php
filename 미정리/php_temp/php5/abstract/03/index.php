<?php

require "carFactory.php";
require "kiaFactory.php";

include "body.php";
include "tire.php";

echo "Abstract Pattern<br>";

// 기아자동차 팩토리 인스턴스를 생성합니다.
$kia = new kiaFactory;

// 매서드를 이용하여 body 인스턴스를 생성합니다.
$bodyKia = $kia->createBody();

// 매서드를 이용하여 tire 인스턴스를 생성합니다.
$tireKia = $kia->createTire();
