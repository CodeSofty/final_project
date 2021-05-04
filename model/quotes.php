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

    $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId,  quotes.authorId, 
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

}


    // public static function get_quotes_by_category($category_id) {
    //     $db = Database::getDB();
    //     $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId, quotes.authorId, categories.categories, authors.author 
    //     FROM quotes
    //     LEFT JOIN categories ON quotes.categoryid = categories.ID
    //     LEFT JOIN authors ON quotes.authorid = authors.ID
    //     WHERE quotes.categoryId = :category_id';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':category_id', $category_id);
    //     $statement->execute();
    //     $results = $statement->fetchALL();
    //     $statement->closeCursor();
    //     return $results;
    // }

    // public static function get_quotes_by_author($author_id) {
    //     $db = Database::getDB();
    //     $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId, quotes.authorId, categories.categories, authors.author 
    //     FROM quotes
    //     LEFT JOIN categories ON quotes.categoryid = categories.ID
    //     LEFT JOIN authors ON quotes.authorid = authors.ID
    //     WHERE quotes.authorId = :author_id';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':author_id', $author_id);
    //     $statement->execute();
    //     $results = $statement->fetchALL();
    //     $statement->closeCursor();
    //     return $results;
    // }

    // public static function get_quotes_by_both($author_id, $category_id) {
    //     $db = Database::getDB();
    //     $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId, quotes.authorId, categories.categories, authors.author
    //     FROM quotes
    //     LEFT JOIN categories ON quotes.categoryId = categories.ID
    //     LEFT JOIN authors ON quotes.authorId = authors.ID
    //     WHERE quotes.authorId = :author_id AND quotes.categoryId = :category_id';
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':author_id', $author_id);
    //     $statement->bindValue(':category_id', $category_id);
    //     $statement->execute();
    //     $results = $statement->fetchALL();
    //     $statement->closeCursor();
    //     return $results;
    // }

    // public static function get_quotes(){
    //     $db = Database::getDB();

    //     $query = 'SELECT quotes.quote, quotes.ID, quotes.categoryId, quotes.authorId, categories.categories, authors.author FROM quotes
    //     INNER JOIN categories
    //     ON quotes.categoryId = categories.ID
    //     INNER JOIN authors
    //     ON quotes.authorId = authors.ID';
    //     $statement = $db->prepare($query);
    //     $statement->execute();
    //     $results = $statement->fetchALL();
    //     $statement->closeCursor();
    //     return $results;
    // }
