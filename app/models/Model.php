<?php

abstract class Model {
    private int $id;
    protected static $table;
    protected static $class;
    protected static $fillable;

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

    public function getTable()
    {
        return $this->table;    
    }

    public function getFillable()
    {
        return $this->fillable;    
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
        $table = static::$table;
        $class = static::$class;
        $fillable = static::$fillable;

        $sql = "SELECT * FROM $table";
        $command = Database::execute($sql);

        $collection = [];
        while ($register = $command->fetch()) {
            $attributes = [];
            foreach ($register as $key => $value) {
                if (in_array($key, $fillable)) {
                    $attributes[$key] = $value;
                }
            }

            $object = new $class(...array_values($attributes));
            $collection[] = $object;
        }

        return $collection;
    }

    public static function where()
    {
        
    }

    public static function find()
    {
        
    }
}