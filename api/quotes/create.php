<?php 

// Headers

header('Access-Control-Allow-Oirigin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$quote->quote = $data->quote;
$quote->categoryId = $data->categoryId;
$quote->authorId = $data->authorId;

// Create Post

if($quote->create()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode( 
        array('message' => 'Post Not Created')
    );
}

?>