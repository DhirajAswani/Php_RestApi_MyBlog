<?php

class Category
{
    private $conn;
    private $table = 'categories';
    public $id;
    public $created_at;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //get Categories
    public function read()
    {
        //create Query
        $query = 'SELECT id,name,created_at FROM ' . $this->table . ' ORDER BY created_at DESC';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
    }
}
