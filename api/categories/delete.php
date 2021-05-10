<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

$category->id = $data->id;
// Delete Post

if($category->delete()) {
    echo json_encode(
        array('message' => 'Category Deleted')
    );
} else {
    echo json_encode( 
        array('message' => 'Category Not Deleted')
    );
}

?>