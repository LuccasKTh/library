<?php

abstract class Model {
    public int $id;
    public string $table;

    public function __construct($id, $table)
    {
        $this->setId($id);
        $this->setTable($table);
    }

    public function setId($id)
    {
        if ($id < 0) {
            throw new Exception("Invalid id");
        }

        $this->id = $id;
    }

    public function setTable($table)
    {
        if ($table == '') {
            throw new Exception("Invalid table");
        }

        $this->table = $table;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTable()
    {
        return $this->table;    
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