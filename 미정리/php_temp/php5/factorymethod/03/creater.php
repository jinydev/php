<?php

abstract class Creater
{
    public function create()
    {
        $item = new Item;

        requestItemInfo();

        $item = createItem();

        createItemLog();
        
        return $item;
    }

    // 아이템 요청
    abstract function requestItemInfo();

    // 로그저장
    abstract function createItemLog();

    // 아이템 알고리즘
    abstract function createItem();
}