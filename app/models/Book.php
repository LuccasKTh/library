<?php

class Book extends Model {
    private string $title;
    private string $publication;
    private string $book_cover;
    private string $price;
    private Category $category;

    protected static $table = 'books';
    protected static $class = self::class;
    protected static $fillable = ['id', 'title', 'publication', 'book_cover', 'price', 'category_id'];

    public function __construct($id, $title, $publication, $bookCover, $price, $category)
    {
        parent::__construct($id);
        $this->setTitle($title);
        $this->setPublication($publication);
        $this->setBookCover($bookCover);
        $this->setPrice($price);
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

    public function setBookCover($bookCover)
    {
        if (!$bookCover) {
            throw new Exception("Invalid book cover");
        } else {
            $this->book_cover = $bookCover;
        }
    }

    public function setPrice($price)
    {
        if (!$price) {
            throw new Exception("Invalid price");
        } else {
            $this->price = $price;
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

    public function title()
    {
        return $this->title;    
    }

    public function publication()
    {
        return $this->publication;    
    }

    public function book_cover()
    {
        return $this->book_cover;    
    }

    public function price()
    {
        return $this->price;    
    }

    public function category_id()
    {
        return $this->category;
    }

}