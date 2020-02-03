<?php

class BObject 
{
    private static $_delegate;

    function __construct()
    {
        self::$_delegate = new AObject;
    }

    public function funcB()
    {
        self::$_delegate->funcAA();
    }
}