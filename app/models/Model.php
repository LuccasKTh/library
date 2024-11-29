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
    
        $params = [];
        foreach ($filtredFillable as $field) {
            if (is_object($this->$field())) {
                $params[":$field"] = $this->$field()->id();
            } else {
                $params[":$field"] = $this->$field();
            }
        }
    
        $sql = "INSERT INTO $table (" . implode(', ', $filtredFillable) . ") VALUES (" . implode(', ', array_keys($params)) . ")";
    
        return Database::execute($sql, $params);
    }
    
    public function update()
    {
        $id = $this->id();
        $table = $this->getTable();
        $fillable = $this->getFillable();
    
        $filtredFillable = array_filter($fillable, fn($coluna) => $coluna !== 'id');
    
        $columns = [];
        $params = [];
        foreach ($filtredFillable as $field) {
            $columns[] = "$field = :$field";
            if (is_object($this->$field())) {
                $params[":$field"] = $this->$field()->id();
            } else {
                $params[":$field"] = $this->$field();
            }
        }
    
        $params[':id'] = $id;
    
        $sql = "UPDATE $table SET " . implode(', ', $columns) . " WHERE id = :id";
    
        return Database::execute($sql, $params);
    }    

    public function delete()
    {
        $id = $this->id();
        $table = $this->getTable();

        $sql = "DELETE FROM $table WHERE id = :id";

        $params = [
            ':id' => $id
        ];

        return Database::execute($sql, $params);
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

            foreach ($fillable as $field) {
                if (array_key_exists($field, $register)) {
                    $value = $register[$field];

                    if (preg_match('/(.*?)_id$/', $field, $matches)) {
                        $relatedClass = self::makeClass($matches[1]);

                        if (class_exists($relatedClass) && method_exists($relatedClass, 'find')) {
                            $relatedInstance = $relatedClass::find($value);

                            if ($relatedInstance) {
                                $attributes[$field] = $relatedInstance;
                            } else {
                                throw new Exception("Relação não encontrada.");
                            }
                        } else {
                            throw new Exception("Classe relacionada {$relatedClass} inválida ou método 'find' não encontrado.");
                        }
                    } else {
                        $attributes[$field] = $value;
                    }
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

    public function fill($attributes)
    {
        $class = static::getClass();

        $instance = new $class(...array_values($attributes));

        return $instance;
    }
}