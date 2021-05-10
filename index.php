<?php 

// Require models

require('config/database.php');
require('model/quotes.php');
require('model/author.php');
require('model/category.php');

$database = new Database();
$db = $database->connect();

$quotes = new Quote($db);
$authors = new Author($db);
$categories = new Category($db);


// Get ID's 

$author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
if(!$author_id) {
    $author_id = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT); 
}

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if(!$category_id) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT); 
}

// Get action variable

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if(!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

// Main Controller

switch($action) {

    case "filter_quotes":
        if($author_id && $category_id) {
            $quotes->authorId = $authorId;
            $quotes->categoryId = $categoryId;
            $quotes = $quotes->get_quotes_by_both();
            $categories = $category->read();
            $authors =  $author->read();
            include('view/quote_list.php');
        break;

        } else if ($author_id) {
            $quotes->authorId = $authorId;
            $quotes = $quotes->get_quotes_by_author();
            $categories = $categories->read();
            $authors =  $authors->read();
            include('view/quote_list.php');
        break;

        } else if ($category_id) {
            $quotes->categoryId = $categoryId;
            $quotes = $quotes->get_quotes_by_category();
            $categories = $category->read();
            $authors =  $author->read();
            include('view/quote_list.php');
        break;

        } else {
            header("Location: .?action=default");
            break;
        }




    // Display all quotes

    default:
    $quotes = $quotes->read();
    $categories = $categories->read();
    $authors =  $authors->read();
    include('view/quote_list.php');
}


?>