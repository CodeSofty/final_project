<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

require('../../config/database.php');
require('../../model/author.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$author = new Author($db);

// Get Raw Posted Data

$data = json_decode(file_get_contents("php://input"));
// Set ID to update

$author->id = $data->id;
$author->author = $data->author;

// Update Post

if($author->update()) {
    echo json_encode(
        array('message' => 'Author Updated')
    );
} else {
    echo json_encode( 
        array('message' => 'Author Not Updated')
    );
}

?>