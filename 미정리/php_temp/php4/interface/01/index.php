<?php

    require_once("interface.php");
    require_once("class.php");

    $obj = new foo;

    // 인터페이스는 기능A를 구현하는 통로역할을 합니다.
    // 인터페이스는 선언과 기능을 구현하는 것을 분리하는 역할을 합니다.
    $obj->funcA();

