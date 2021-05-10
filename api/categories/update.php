<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

require('../../config/database.php');
require('../../model/category.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$category = new Category($db);

// Get Raw Posted Data

$data = json_decode(file_get_contents("php://input"));
// Set ID to update

$category->id = $data->id;
$category->categories = $data->category;

// Update Post

if($category->update()) {
    echo json_encode(
        array('message' => 'Category Updated')
    );
} else {
    echo json_encode( 
        array('message' => 'Category Not Updated')
    );
}

?>