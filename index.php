<?php 

// Require models

require('model/database.php');
require('model/quotes.php');
require('model/author_db.php');
require('model/category_db.php');


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
            $quotes = QuotesDB::get_quotes_by_both($author_id, $category_id);
            $categories = CategoriesDB::get_categories();
            $authors =  AuthorsDB::get_authors();
            include('view/quote_list.php');
        break;

        } else if ($author_id) {
            $quotes = QuotesDB::get_quotes_by_author($author_id);
            $categories = CategoriesDB::get_categories();
            $authors =  AuthorsDB::get_authors();
            include('view/quote_list.php');
        break;

        } else if ($category_id) {
            $quotes = QuotesDB::get_quotes_by_category($category_id);
            $categories = CategoriesDB::get_categories();
            $authors =  AuthorsDB::get_authors();
            include('view/quote_list.php');
        break;

        } else {
            header("Location: .?action=default");
            break;
        }




    // Display all quotes

    default:
        $quotes = QuotesDB::get_quotes();
        $categories = CategoriesDB::get_categories();
        $authors =  AuthorsDB::get_authors();
        include('view/quote_list.php');
}


?>