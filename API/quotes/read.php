<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/database.php');
include_once('../../model/quotes.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$quote = new Quote($db);

// Quote Query

$result = $quote->read();
//Get row count
$num = $result->rowCount();

// Check if any quotes

if($num > 0) {
    //Quote Array
    $quote_arr = array(); 
    $quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
        'id' => $id,
        'categories' => $category, 
        'author' => $author,
        'categoryid' => $category_id,
        'authorid' => $author_id,
        'quote' => html_entity_decode($quote)
        );

        //Push to data array

        array_push($quote_arr['data'], $quote_item);

    }

    // Turn into JSON & output

    echo json_encode($quote_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

?>