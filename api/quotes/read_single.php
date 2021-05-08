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


// Get ID

$quote->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Get Quote

$quote->read_single();

// Create Array

$quote_arr = array(
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author' => $quote->author,
    'category' => $quote->category
);

// Make JSON

echo json_encode($quote_arr);

?>