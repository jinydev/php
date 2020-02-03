<?php

require "Flyweight.php";
require "FlyweightFactory.php";

// 팩토리 객체를 생성합니다.
$fly = new FlyweightFactory;

// 객체를 호출합니다.(생성)
$obj = $fly->getFlyweight("Flyweight");
$obj->getData("hello");

// 객체를 호출합니다.(기존꺼 반환)
$obj2 = $fly->getFlyweight("Flyweight");
$obj2->getData("jiny");