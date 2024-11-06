<?php

require_once "../../autoload.php";

class User extends Model {
    private string $name;
    private string $email;
    private string $password;
    public string $table = 'users';

    public function __construct($id, $name, $email, $password)
    {
        parent::__construct($id, $this->table);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function setName($name)
    {
        if ($name) {
            throw new Exception("Invalid name");
        } else {
            $this->name = $name;
        }
    }

    public function setEmail($email)
    {
        if ($email) {
            throw new Exception("Invalid email");
        } else {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if ($password) {
            throw new Exception("Invalid password");
        } else {
            $this->password = $password;
        }
    }

    public function getName()
    {
        return $this->name;    
    }

    public function getEmail()
    {
        return $this->email;    
    }

    public function getPassword()
    {
        return $this->password;    
    }

    public function login()
    {
            
    }

}