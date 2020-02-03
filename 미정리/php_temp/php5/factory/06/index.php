<?php

class First
{
}

class Second
{
    protected $_first;
    public function construct(First $first)
    {
        $this->_first = $first;
    }
}

class Third
{
    protected $_second;
    public function construct(Second $second)
    {
        $this->_second = $second;
    }
}
