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

    public function store($request)
    {
        foreach ($request as $key => $value) {
            if (in_array($key, Customer::getFillable())) {
                
            }
        }
        var_dump($request);
        exit;
        $customer = new Customer(...array_values($request));
        $customer->save();

        return header('Location: /customer');
    }

    public function register()
    {
        echo "Register Page";
    }
}
