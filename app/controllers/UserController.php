<?php

class UserController 
{
    public function index()
    {
        $customers = Customer::all();

        return Template::view('customer.list', ['customers' => $customers]);
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
