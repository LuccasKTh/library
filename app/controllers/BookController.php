<?php

class BookController 
{
    public function index()
    {
        $books = Book::all();

        return Template::view('book.list', ['books' => $books]);
    }

    public function create()
    {
        $categories = Category::all();
        return Template::view('book.category', ['categories'=> $categories]);
    }

    public function store($request)
    {
        $category_id = $request['category_id'];
        $category = Category::find($category_id);
        
        $attributes = Request::order(Book::getFillable(), $request);
        $attributes['category_id'] = $category;

        $author = new Book(...array_values($attributes));
        $author->save();

        return header('Location: /book');
    }

    public function show($id)
    {
        $book = Book::find($id);

        return Template::view('book.show', ['book' => [$book]]);
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();

        return Template::view('book.category', ['book' => [$book], 'categories' => $categories]);
    }

    public function update($request)
    {
        $book = Book::find($request['id']);

        $category_id = $request['category_id'];
        $category = Category::find($category_id);

        $attributes = Request::order(Book::getFillable(), $request);
        $attributes['category_id'] = $category;
        
        $book = $book->fill($attributes);

        $book->update();

        return header('Location: /book');
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return header('Location: /book');
    }
}
