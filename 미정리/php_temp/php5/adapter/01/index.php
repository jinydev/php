<?php
    include "Math.php";
    include "Adapter.php";
    include "Object.php";

    $obj = new Objects;

    // 아답터를 이용하여 두배 계산 합니다.
    echo $obj->twiceOf(5);
    echo "\n";

    // 아답터를 이용하여 절반을 계산 합니다.
    echo $obj->halfOf(4);
    