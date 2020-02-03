<?php

require "Calculator.php";
require "Plus.php";
require "Sub.php";

require "Request.php";

echo "체인 패턴에 대해서 학습을 합니다.<br>";

$plus = new Plus;
$sub = new Sub;

// Plus 연산 실패시 동작할 다음 객체를 설정합니다.
$plus->setNext($sub);

$req1 = new Request(1,2,"+");
$req2 = new Request(5,3,"-");

// Plus 동작은 정상적으로 처리가 됩니다.
$plus->process($req1);

// sub 연산은 plus 연산 실패, sub로 체인 연결되어 동작합니다.
$plus->process($req2);