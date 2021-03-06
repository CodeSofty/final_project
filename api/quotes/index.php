<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../config/database.php');
require('../../model/quotes.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$quote = new Quote($db);


// Quote Query

$result = $quote->read();
//Get row count
$count = $result->rowCount();

// Check if any quotes

if($count > 0) {
    // Initialize Array

    $quote_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $categories
        );

        // Push to array

        array_push($quote_arr, $quote_item);

    }

    // Turn to JSON

    echo json_encode($quote_arr);
} else {

    // No Quotes
    
    echo json_encode(array('message' => 'No Quotes Found')
);
}

?>