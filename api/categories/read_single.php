<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../config/database.php');
require('../../model/category.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$category = new Category($db);


// Get ID

$category->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Get Quote

$category->read_single();

// Create Array

$category_arr = array(
    'id' => $category->id,
    'category' => $category->category

);

// Make JSON

echo json_encode($category_arr);

?>