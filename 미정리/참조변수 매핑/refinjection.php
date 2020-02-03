<?php

class foo
{
    private $bar;
    public function __construct($bar = null)
    {
        $this->bar = $bar;
    }

    public function hello()
    {
        echo "hello ";
        $this->bar->world();
        echo "\n";
    }
}

class bar
{
    private $foo;
    public function __construct($foo = null)
    {
        $this->foo = $foo;
    }

    public function world()
    {
        echo "world ";
        $this->foo->hello();
        echo "\n";
    }
}

$bar = null;
$foo = null;

$bar = &$foo;

$foo = new foo( );
$bar = new bar( &$foo );

