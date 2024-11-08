<?php

class AuthorController {

    public function index()
    {
        $authors = Author::all();

        return Template::view('author.list', ['authors' => $authors]);
    }
    
}