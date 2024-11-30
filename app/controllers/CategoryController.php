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

    public function show($id)
    {
        $category = Category::find($id);

        return Template::view('category.show', ['category' => [$category]]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return Template::view('category.form', ['category' => [$category]]);
    }

    public function update($request)
    {
        $category = Category::find($request['id']);

        $attributes = Request::order(Category::getFillable(), $request);
        
        $category = $category->fill($attributes);

        $category->update();

        return header('Location: /category');
    }

    public function destroy($id)
    {
        $book = Category::find($id);

        try {
            $book->delete();
        } catch (PDOException $e) {
            // if ($e->errorInfo[1] == 1451) {
            //     return header('Location: /category');
            // } else {
            //     return header('Location: /category?error=undefined');
            // }
        }

        return header('Location: /category');
    }
    
}