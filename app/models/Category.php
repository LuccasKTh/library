<?php

class Category extends Model {
    private string $description;

    protected static $table = 'categories';
    protected static $class = self::class;
    protected static $fillable = ['id', 'description'];

    public function __construct($id, $description)
    {
        parent::__construct($id);
        $this->setDescription($description);
    }

    public function setDescription($description)
    {
        if (!$description) {
            throw new Exception("Invalid description");
        } else {
            $this->description = $description;
        }
    }

    public function description()
    {
        return $this->description;    
    }

}