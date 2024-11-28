<?php

class CategoryController 
{
    public function index()
    {
        $categories = Category::all();

        return Template::view('category.list', ['categories' => $categories]);
    }

    public function create() 
    {
        return Template::view('category.form');
    }

    public function store($request)
    {
        $attributes = Request::order(Category::getFillable(), $request);

        $author = new Category(...array_values($attributes));
        $author->save();

        return header('Location: /category');
    }
    
}