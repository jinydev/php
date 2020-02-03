<?php

class Shape 
{
    private $_id;

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getId($id)
    {
        return $this->_id;
    }
}