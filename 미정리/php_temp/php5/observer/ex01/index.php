<?php

// Observer
require "Manager.php";
require "UserA.php";
require "UserB.php";

//Obserbable
require "Obserable.php";

echo "옵저버 패턴에 대해서 학습을 합니다.<br>";

$em = new Employee;

// 옵저버블에 등록을 합니다.
$a = new UserA("Jiny");
$em->subscribeNotification($a);

$b = new UserB("Eric");
$em->subscribeNotification($b);

$em->update();

