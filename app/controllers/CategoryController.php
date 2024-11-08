<?php

class CategoryController {

    public function index()
    {
        $categories = Category::all();

        return Template::view('category.list', ['categories' => $categories]);
    }
    
}