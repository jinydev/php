<?php
require "shape.php";
require "Circle.php";

$cir = new Circle(1 ,1, 2);
echo $cir;

echo "객체를 복사해 봅니다.<br>";

$cir2 = clone $cir;
echo $cir2;