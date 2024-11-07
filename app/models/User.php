<?php

class User extends Model {
    private string $name;
    private string $email;
    private string $password;
    private int $user_role;
    protected static $table = 'users';
    protected static $class = self::class;

    protected static $fillable = ['id', 'name', 'email', 'password', 'user_role'];

    public function __construct($id, $name, $email, $password, $user_role)
    {
        parent::__construct($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setUserRole($user_role);
    }

    public function setName($name)
    {
        if (!$name) {
            throw new Exception("Invalid name");
        } else {
            $this->name = $name;
        }
    }

    public function setEmail($email)
    {
        if (!$email) {
            throw new Exception("Invalid email");
        } else {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (!$password) {
            throw new Exception("Invalid password");
        } else {
            $this->password = $password;
        }
    }

    public function setUserRole($user_role)
    {
        if (!$user_role) {
            throw new Exception("Invalid user role");
        } else {
            $this->user_role = $user_role;
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

    public function getUserRole()
    {
        return $this->user_role;    
    }

    public function login()
    {
            
    }

}