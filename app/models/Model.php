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
    

    public static function replaceForeignKeyNameToClassName($match)
    {
        return ucfirst($match);
    }

    public static function makeClass($match)
    {
        return self::replaceForeignKeyNameToClassName($match);
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

        foreach ($fillable as $field) {
            if (preg_match('/(.*?)_id/', $field, $matches)) {
                $class = self::makeClass($matches[1]);
                var_dump($class::class);
            }
        }

        $collection = [];
        while ($register = $command->fetch()) {
            $attributes = [];
            foreach ($register as $key => $value) {
                if (in_array($key, $fillable)) {
                    $attributes[] = $value;
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

    public static function find(int $id)
    {
        $table = static::$table;

        // $sql = "SELECT * FROM $table WHERE id = :id";
        // $params = [
        //     ':id' => $id
        // ];
        // $command = Database::execute($sql, $params);
        
        // var_dump($command->fetch());

        return $table;
    }
}