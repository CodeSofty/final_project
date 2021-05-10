<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../config/database.php');
require('../../model/category.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Author Object

$category = new Category($db);


// Author Query

$result = $category->read();
//Get row count
$count = $result->rowCount();

// Check if any authors

if($count > 0) {
    // Initialize Array

    $category_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id' => $id,
            'category' => $categories
        );

        // Push to array

        array_push($category_arr, $category_item);

    }

    // Turn to JSON

    echo json_encode($category_arr);
} else {

    // No Authors
    
    echo json_encode(array('message' => 'No Categories Found')
);
}

?>