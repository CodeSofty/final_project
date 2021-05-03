<?php

//These are the functions just for the categories

class CategoriesDB {


    // public static function get_category_name($category_id){
    //     $db = Database::getDB();

    //     $query = 'SELECT categories FROM categories
    //     WHERE ID = :category_id';
    //     $statement = $db->prepare($query);
    //     bindValue(':category_id', $category_id);
    //     $statement->execute();
    //     $results = $statement->fetchALL();
    //     $statement->closeCursor();
    //     return $results;
    // }


    public static function get_categories(){
        $db = Database::getDB();

        $query = 'SELECT * FROM categories';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchALL();
        $statement->closeCursor();
        return $results;
    }

}