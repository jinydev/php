<?php

// 설계도에 해당하는 청사진을 추상클래스로 선언합니다.
// 설계도에서 필요한 부품들을 메소드 형태로 선언
abstract class BluePrint
{
    abstract public function setCpu();
    abstract public function setRam();
    abstract public function setStorage();

    abstract public function getComputer();

}