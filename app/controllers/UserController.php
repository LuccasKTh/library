<?php

class UserController 
{
    public function index()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Lucas',
                'email' => 'lucas.kthiel@gmail.com'
            ],
            [
                'id' => 2,
                'name' => 'Gustavo',
                'email' => 'gustavo@gmail.com'
            ]
        ];

        Database::getInstance();

        return Template::view('user.list', ['users' => $users]);
    }

    public function create()
    {
        echo "Login Page";
    }

    public function register()
    {
        echo "Register Page";
    }
}
