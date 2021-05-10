<?php

class Category {
 // DB Stuff

private $conn;


// Properties

public $id;
public $category;

// Constructor with DB

public function __construct($db){
    $this->conn = $db;
}


// Get Authors

public function read() {
    // Create query

    $query = 'SELECT categories.id, categories.categories
                FROM categories';

                    $statement = $this->conn->prepare($query);
                    $statement->execute();
                    return $statement;
}

}
