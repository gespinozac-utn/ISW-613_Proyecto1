<?php

class Category
{
    //Attributes
    private $id,
        $name,
        $parent;

    //Contructor
    function __construct($name = null, $parent = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent = $parent;
    }

    //Set methods
    public function set_id($id)
    {
        $this->id = $id;
    }
    public function set_name($name)
    {
        $this->name = $name;
    }
    public function set_parent($parent)
    {
        $this->parent = $parent;
    }

    //Get methods

    public function get_id()
    {
        return $this->id;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_parent()
    {
        return $this->parent;
    }
}