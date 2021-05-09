<?php 

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../config/database.php');
require('../../model/author.php');

// Instantiate DB & Connect

$database = new Database();
$db = $database->connect();

// Instantiate Quote Object

$author = new Author($db);


// Get ID

$author->authorId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Get Quote

$author->read_single();

// Create Array

$author_arr = array(
    'id' => $author->id,
    'author' => $author->author

);

// Make JSON

echo json_encode($author_arr);

?>