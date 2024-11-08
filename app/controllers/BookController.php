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
        echo "Login Page";
    }

    public function register()
    {
        echo "Register Page";
    }
}
