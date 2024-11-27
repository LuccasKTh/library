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

    public function id()
    {
        return $this->id;
    }

    public static function getTable()
    {
        return static::$table;
    }

    public static function getClass()
    {
        return static::$class;
    }

    public static function getFillable()
    {
        return static::$fillable;
    }

    public static function makeClass($match)
    {
        return ucfirst($match);
    }

    public function save()
    {
        $table = $this->getTable();
        $fillable = $this->getFillable();
    
        $filtredFillable = array_filter($fillable, fn($coluna) => $coluna !== 'id');
    
        $getters = [];
        foreach ($filtredFillable as $fill) {
            $getters[] = $this->$fill();
        }
    
        $placeholders = array_map(fn($item) => ':' . $item, $filtredFillable);
        
        $params = array_combine($placeholders, $getters);
    
        $sql = "INSERT INTO $table (".implode(', ', $filtredFillable).") VALUES (".implode(', ', $placeholders).")";
    
        return Database::execute($sql, $params);
    }
    

    public function update()
    {

    }

    public function delete()
    {

    }

    public static function all()
    {
        $table = self::getTable();
        $class = static::getClass();
        $fillable = static::getFillable();
        
        $sql = "SELECT * FROM $table";

        $command = Database::execute($sql);

        $collection = self::makeClassList($command, $fillable, $class);
        
        return $collection;
    }

    public static function makeClassList($command, $fillable, $class)
    {
        $collection = [];
        while ($register = $command->fetch()) {
            $attributes = [];
            foreach ($register as $key => $value) {
                if (in_array($key, $fillable)) {
                    if (preg_match('/(.*?)_id/', $key, $matches)) {
                        $classFK = self::makeClass($matches[1]);
                        $attributes[] = $classFK::find($value);
                    } else {
                        $attributes[] = $value;
                    }
                }
            }

            $object = new $class(...array_values($attributes));

            $collection[] = $object;
        }

        return $collection;
    }

    public static function makeAttributes($key, $value, $fillable)
    {
        
    }

    public static function where()
    {
        
    }

    public static function find(int $id)
    {
        $table = self::getTable();
        $class = static::getClass();
        $fillable = static::getFillable();

        $sql = "SELECT * FROM $table WHERE id = :id";
        $params = [
            ':id' => $id
        ];

        $command = Database::execute($sql, $params);

        $register = self::makeClassList($command, $fillable, $class);

        return $register[0];
    }
}