<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../config/database.php');
require('../../model/author.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Author Object

$author = new Author($db);


// Author Query

$result = $author->read();
//Get row count
$count = $result->rowCount();

// Check if any authors

if($count > 0) {
    // Initialize Array

    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
        );

        // Push to array

        array_push($author_arr, $author_item);

    }

    // Turn to JSON

    echo json_encode($author_arr);
} else {

    // No Authors
    
    echo json_encode(array('message' => 'No Author Found')
);
}

?>