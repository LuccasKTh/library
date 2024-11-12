<?php

class CustomerController 
{
    public function index()
    {
        $customers = Customer::all();

        return Template::view('customer.list', ['customers' => $customers]);
    }

    public function create()
    {
        return Template::view('customer.form');
    }

    public function register()
    {
        echo "Register Page";
    }
}
