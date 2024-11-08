<?php

class Customer extends User
{
    private string $cpf;
    
    protected static $class = self::class;

    public function __construct($id, $name, $email, $cpf, $password, $user_role)
    {
        parent::__construct($id, $name, $email, $password, $user_role);
        $this->setCpf($cpf);
    }

    public function setCpf($cpf)
    {
        if (!$cpf) {
            throw new Exception("Invalid CPF");
        } else {
            $this->cpf = $cpf;
        }
    }

    public function getCpf()
    {
        return $this->cpf;    
    }

}