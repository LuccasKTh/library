<?php

class Author extends Model {
    private string $name;
    private string $lastName;

    protected static $table = 'authors';
    protected static $class = self::class;
    protected static $fillable = ['id', 'name', 'last_name'];

    public function __construct($id, $name, $lastName)
    {
        parent::__construct($id);
        $this->setName($name);
        $this->setLastName($lastName);
    }

    public function setName($name)
    {
        if (!$name) {
            throw new Exception("Invalid name");
        } else {
            $this->name = $name;
        }
    }

    public function setLastName($lastName)
    {
        if (!$lastName) {
            throw new Exception("Invalid last name");
        } else {
            $this->lastName = $lastName;
        }
    }

    public function getName()
    {
        return $this->name;    
    }

    public function getLastName()
    {
        return $this->lastName;    
    }

}