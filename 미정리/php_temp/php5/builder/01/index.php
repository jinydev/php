<?php
require "computer.php";
require "BuilderFactory.php";

require "BluePrint.php";
require "Product.php";

// 컴퓨터를 생성하는 팩토리
// Director
$factory = new BuilderFactory;

// 빌더를 적용할 객체를 설정합니다.
$factory->bluePrint(new Product);

// 빌드 생성된 컴퓨터의 인스턴스를 전달 받습니다.
$computer = $factory->build()->getInstance();

// 생성한 컴퓨터의 사양을 출력해 봅니다.
// __toString() 매직 메서드를 이용합니다.
echo $computer;

