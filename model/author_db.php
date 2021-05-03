<?php

//These are the functions just for the authors

class AuthorsDB {
     // get_quotes_by_author($author_id)


    public static function get_authors(){
        $db = Database::getDB();

        $query = 'SELECT * FROM authors';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchALL();
        $statement->closeCursor();
        return $results;
    }

}