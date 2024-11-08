<?php

class Book extends Model {
    private string $title;
    private string $publication;
    private string $book_cover;
    private Category $category;

    protected static $table = 'books';
    protected static $class = self::class;
    protected static $fillable = ['id', 'title', 'publication', 'book_cover', 'category_id'];

    public function __construct($id, $title, $publication, $book_cover, $category)
    {
        parent::__construct($id);
        $this->setTitle($title);
        $this->setPublication($publication);
        $this->setBookCover($book_cover);
        $this->setCategory($category);
    }

    public function setTitle($title)
    {
        if (!$title) {
            throw new Exception("Invalid title");
        } else {
            $this->title = $title;
        }
    }

    public function setPublication($publication)
    {
        if (!$publication) {
            throw new Exception("Invalid publication");
        } else {
            $this->publication = $publication;
        }
    }

    public function setBookCover($book_cover)
    {
        if (!$book_cover) {
            throw new Exception("Invalid book cover");
        } else {
            $this->book_cover = $book_cover;
        }
    }

    public function setCategory($category)
    {
        if (!$category) {
            throw new Exception("Invalid category");
        } else {
            $this->category = $category;
        }
    }

    public function getTitle()
    {
        return $this->title;    
    }

    public function getPublication()
    {
        return $this->publication;    
    }

    public function getBookCover()
    {
        return $this->book_cover;    
    }

    public function getCategory()
    {
        return $this->category;
    }

}