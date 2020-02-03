<?php
    // 인터페이스
    require("weapon.php");
    
    // 무기구현
    require("gun.php");
    require("knife.php");
    
    require("charactor.php");

    $obj = new Charactor;
    $obj->attact();

    // 무기교환
    $obj->setWeapon(new Knife);
    $obj->attact();

    // 무기교환
    $obj->setWeapon(new Gun);
    $obj->attact();
