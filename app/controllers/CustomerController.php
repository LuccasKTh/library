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

    public function show($id)
    {
        $customer = Customer::find($id);

        return Template::view('customer.show', ['customer' => [$customer]]);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        return Template::view('customer.form', ['customer' => [$customer]]);
    }

    public function update($request)
    {
        $customer = Customer::find($request['id']);

        $attributes = Request::order(Customer::getFillable(), $request);
        
        $customer = $customer->fill($attributes);
        
        $customer->update();

        return header('Location: /customer');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        try {
            $customer->delete();
        } catch (PDOException $e) {
            // if ($e->errorInfo[1] == 1451) {
            //     return header('Location: /category');
            // } else {
            //     return header('Location: /category?error=undefined');
            // }
        }

        return header('Location: /customer');
    }

}
