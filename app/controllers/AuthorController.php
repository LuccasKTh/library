<?php

class AuthorController {

    public function index()
    {
        $authors = Author::all();

        return Template::view('author.list', ['authors' => $authors]);
    }

    public function create()
    {
        return Template::view('author.form');    
    }

    public function store($request)
    {
        $author = new Author(...array_values($request));
        $author->save();
    }
    
}