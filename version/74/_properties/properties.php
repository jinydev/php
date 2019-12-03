<?php

class Bar
{
    public int $a;
    public string $name;
}

class Foo
{
    public Bar $BAR;

}

$obj1 = new Bar;
$obj1->a = 1;
$obj1->a = "a";

