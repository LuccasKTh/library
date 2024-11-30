<?php

class AuthorController 
{
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
        $attributes = Request::order(Author::getFillable(), $request);

        $author = new Author(...array_values($attributes));
        $author->save();

        return header('Location: /author');
    }

    public function show($id)
    {
        $author = Author::find($id);

        return Template::view('author.show', ['author' => [$author]]);
    }

    public function edit($id)
    {
        $author = Author::find($id);

        return Template::view('author.form', ['author' => [$author]]);
    }

    public function update($request)
    {
        $author = Author::find($request['id']);

        $attributes = Request::order(Author::getFillable(), $request);
        
        $author = $author->fill($attributes);

        $author->update();

        return header('Location: /author');
    }

    public function destroy($id)
    {
        $book = Author::find($id);

        try {
            $book->delete();
        } catch (PDOException $e) {
            // if ($e->errorInfo[1] == 1451) {
            //     return header('Location: /author');
            // } else {
            //     return header('Location: /author?error=undefined');
            // }
        }

        return header('Location: /author');
    }
    
}