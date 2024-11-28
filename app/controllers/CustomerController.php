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
        $request['user_role'] = 1;
        $attributes = Request::order(Customer::getFillable(), $request);

        $customer = new Customer(...array_values($attributes));
        $customer->save();

        return header('Location: /customer');
    }
}
