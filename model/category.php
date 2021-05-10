<?php

class Category {
 // DB Stuff

private $conn;


// Properties

public $id;
public $categories;

// Constructor with DB

public function __construct($db){
    $this->conn = $db;
}


// Get Categories

public function read() {
    // Create query

    $query = 'SELECT categories.id, categories.categories
                FROM categories';

                    $statement = $this->conn->prepare($query);
                    $statement->execute();
                    return $statement;
}

// Single Category 

public function read_single() {
    $query = 'SELECT categories.id, categories.categories
    FROM categories  
    WHERE categories.id = ?
    LIMIT 0,1';

    $statement = $this->conn->prepare($query);
    $statement->bindParam(1, $this->id);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Set properties

    $this->category = $row['categories'];
    $this->id = $row['id'];

}

// Create Category

public function create() {

    // Create Query 
    $query = 'INSERT INTO categories
    SET categories = :category';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->category = htmlspecialchars(strip_tags($this->categories));

    // Bind Data

    $statement->bindParam(':category', $this->categories);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Category Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}



// Delete Category

public function delete(){
    // Create Query

$query =  'DELETE FROM categories
    WHERE categories.id = :id';

// Prepare Query
$statement = $this->conn->prepare($query);
// Clean ID
$this->id = htmlspecialchars(strip_tags($this->id));
// Bind Parameters
$statement->bindParam(':id', $this->id);


// Execute 

if($statement->execute()) {
    return true;
    printf('Category Delete');
} else {

    // Print Error If Something Goes Wrong
    return false;
    printf("Error: %s . \n", $statement->error);
}


}

// Update Author

public function update() {

    // Create Query 
    $query = 'UPDATE categories
    SET categories = :category
        WHERE categories.id = :id';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->categories = htmlspecialchars(strip_tags($this->categories));

    // Bind Data

    $statement->bindParam(':category', $this->categories);
    $statement->bindParam(':id', $this->id);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Category Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}



}
