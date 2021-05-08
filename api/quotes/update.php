<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

require('../../config/database.php');
require('../../model/quotes.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$quote = new Quote($db);

// Get Raw Posted Data

$data = json_decode(file_get_contents("php://input"));
// Set ID to update

$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->categoryId = $data->categoryId;
$quote->authorId = $data->authorId;

// Update Post

if($quote->update()) {
    echo json_encode(
        array('message' => 'Quote Updated')
    );
} else {
    echo json_encode( 
        array('message' => 'Quote Not Updated')
    );
}

?>