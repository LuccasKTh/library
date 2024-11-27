<?php

class User extends Model {
    private string $name;
    private string $email;
    private string $password;
    private int $userRole;

    protected static $table = 'users';
    protected static $class = self::class;
    protected static $fillable = ['id', 'name', 'email', 'password', 'user_role'];

    public function __construct($id, $name, $email, $password, $userRole)
    {
        parent::__construct($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setUserRole($userRole);
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

    public function setUserRole($userRole)
    {
        if (!$userRole) {
            throw new Exception("Invalid user role");
        } else {
            $this->userRole = $userRole;
        }
    }

    public function name()
    {
        return $this->name;    
    }

    public function email()
    {
        return $this->email;    
    }

    public function password()
    {
        return $this->password;    
    }

    public function user_role()
    {
        return $this->userRole;    
    }

    public function login()
    {
            
    }

}