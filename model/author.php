<?php

class Author {
 // DB Stuff

private $conn;


// Properties

public $id;
public $category;
public $quote;
public $author;

// Constructor with DB

public function __construct($db){
    $this->conn = $db;
}


// Get Authors

public function read() {
    // Create query

    $query = 'SELECT authors.id, authors.author
                FROM authors';

                    $statement = $this->conn->prepare($query);
                    $statement->execute();
                    return $statement;
}

// Single Author 

public function read_single() {
    $query = 'SELECT authors.id, authors.author
    FROM authors  
    WHERE authors.id = ?
    LIMIT 0,1';

    $statement = $this->conn->prepare($query);
    $statement->bindParam(1, $this->id);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Set properties

    $this->author = $row['author'];
    $this->id = $row['id'];

}

// Create Author

public function create() {

    // Create Query 
    $query = 'INSERT INTO authors
    SET author = :author';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->author = htmlspecialchars(strip_tags($this->author));

    // Bind Data

    $statement->bindParam(':author', $this->author);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Author Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}




// Update Author

public function update() {

    // Create Query 
    $query = 'UPDATE authors
    SET author = :author
        WHERE authors.id = :id';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->author = htmlspecialchars(strip_tags($this->author));

    // Bind Data

    $statement->bindParam(':author', $this->author);
    $statement->bindParam(':id', $this->id);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Author Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}


// Delete Author

public function delete(){
    // Create Query

$query =  'DELETE FROM authors
    WHERE authors.id = :id';

// Prepare Query
$statement = $this->conn->prepare($query);
// Clean ID
$this->id = htmlspecialchars(strip_tags($this->id));
// Bind Parameters
$statement->bindParam(':id', $this->id);


// Execute 

if($statement->execute()) {
    return true;
    printf('Author Delete');
} else {

    // Print Error If Something Goes Wrong
    return false;
    printf("Error: %s . \n", $statement->error);
}


}

}
