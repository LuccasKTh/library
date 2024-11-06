<?php

abstract class Model {
    public int $id;

    public function __construct($id)
    {
        $this->setId($id);
    }

    public function setId($id)
    {
        if ($id < 0) {
            throw new Exception("Invalid id");
        } else {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
            
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public static function all()
    {
        
    }

    public static function where()
    {
        
    }

    public static function find()
    {
        
    }
}