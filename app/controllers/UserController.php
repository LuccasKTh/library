<?php

class UserController 
{
    public function index()
    {
        $users = User::all();

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
