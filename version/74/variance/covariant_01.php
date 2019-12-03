<?php
class ParentType
{
    public $name;
}

class ChildType extends ParentType
{
    //
}

class Foo
{
    public function covariant() :ParentType
    {

    }
}

class Bar extends Foo
{
    public function covariant() :ChildType
    {
        
    }
}

$objFoo = new Foo;
print_r($objFoo->covariant());