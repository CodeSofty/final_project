<?php

//These are the functions just for the quotes


class Quote {
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


// Read Quotes

public function read() {
    // Create query

    $query = 'SELECT quotes.quote, quotes.id, quotes.categoryId,  quotes.authorId, 
                        categories.categories, authors.author
                        FROM quotes  
                        INNER JOIN categories 
                        ON quotes.categoryId = categories.id
                        INNER JOIN authors
                        ON  quotes.authorId = authors.id';

                    $statement = $this->conn->prepare($query);
                    $statement->execute();
                    return $statement;
}

// Single Quote 

public function read_single() {
    $query = 'SELECT quotes.quote, quotes.id, quotes.categoryId,  quotes.authorId, 
    categories.categories, authors.author
    FROM quotes  
    INNER JOIN categories 
    ON quotes.categoryId = categories.id
    INNER JOIN authors
    ON  quotes.authorId = authors.id
    WHERE quotes.id = ?
    LIMIT 0,1';

    $statement = $this->conn->prepare($query);
    $statement->bindParam(1, $this->id);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Set properties

    $this->quote = $row['quote'];
    $this->author = $row['author'];
    $this->category = $row['categories'];
    $this->id = $row['id'];

}

// Create Quote

public function create() {

    // Create Query 
    $query = 'INSERT INTO quotes
    SET quote = :quote,
        authorId = :authorId,
        categoryId = :categoryId';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    // Bind Data

    $statement->bindParam(':quote', $this->quote);
    $statement->bindParam(':authorId', $this->authorId);
    $statement->bindParam(':categoryId', $this->categoryId);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Quote Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}




// Update Quote

public function update() {

    // Create Query 
    $query = 'UPDATE quotes
    SET quote = :quote,
        authorId = :authorId,
        categoryId = :categoryId
        WHERE id = :id';

    // Prepare Statement

    $statement = $this->conn->prepare($query);

    // Clean data

    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    // Bind Data

    $statement->bindParam(':quote', $this->quote);
    $statement->bindParam(':authorId', $this->authorId);
    $statement->bindParam(':categoryId', $this->categoryId);
    $statement->bindParam(':id', $this->id);

    // Execute

    if($statement->execute()) {
        return true;
        printf('Quote Created');
    } else {

        // Print Error If Something Goes Wrong
        return false;
        printf("Error: %s . \n", $statement->error);
    }
}


// Delete Quote

public function delete(){
    // Create Query

$query =  'DELETE FROM quotes
    WHERE quotes.id = :id';

// Prepare Query
$statement = $this->conn->prepare($query);
// Clean ID
$this->id = htmlspecialchars(strip_tags($this->id));
// Bind Parameters
$statement->bindParam(':id', $this->id);


// Execute 

if($statement->execute()) {
    return true;
    printf('Quote Delete');
} else {

    // Print Error If Something Goes Wrong
    return false;
    printf("Error: %s . \n", $statement->error);
}


}

public function get_quotes_by_category($category_id) {
    $query = 'SELECT quotes.quote, quotes.id, quotes.categoryId, quotes.authorID, categories.categories, authors.author
        FROM quotes
        LEFT JOIN categories ON quotes.categoryid = categories.ID
        LEFT JOIN authors ON quotes.authorid = authors.ID
        WHERE quotes.categoryId = :categoryId';

    $statement = $this->conn->prepare($query);
    $statement->bindParam(':categoryId', $this->categoryId);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;

}

public function get_quotes_by_author($author_id) {
    $query = 'SELECT quotes.quote, quotes.id, quotes.categoryId, quotes.authorID, categories.categories, authors.author
        FROM quotes
        LEFT JOIN categories ON quotes.categoryid = categories.ID
        LEFT JOIN authors ON quotes.authorid = authors.ID
        WHERE quotes.authorId = :authorId';

    $statement = $this->conn->prepare($query);
    $statement->bindParam(':authorId', $this->authorId);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;

}


public function get_quotes_by_both($author_id, $category_id) {

        $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId, quotes.authorId, categories.categories, authors.author
        FROM quotes
        LEFT JOIN categories ON quotes.categoryId = categories.ID
        LEFT JOIN authors ON quotes.authorId = authors.ID
        WHERE quotes.authorId = :author_id AND quotes.categoryId = :category_id';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':authorId', $this->authorId);
        $statement->bindParam(':categoryId', $this->categoryId);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

}
