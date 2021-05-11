<?php

// Local 
class Database
{

    // Heroku Connection

    public function connect()
    {
        $url = getenv('mysql://eq4n79gcir6a6jnc:kthqf6rf642405mu@y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/gujm8m3lfizcbent');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');
        $dsn = "mysql:host={y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com};dbname={$gujm8m3lfizcbent}";

        try
        {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo 'Connection Failed: ' . $e->getMessage();
        }

        return $this->conn;
    }





   // Database Parameters
    // private $host = 'localhost';
    // private $db_name = 'quotesdb';
    // private $username = 'root';
    // private $conn;

    // public function connect()
    // {
    //     $this->conn = null;

    //     try
    //     {
    //         $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
    //             $this->username);
    //         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     }
    //     catch(PDOException $e)
    //     {
    //         echo 'Connection Error: ' . $e->getMessage();
    //     }

    //     return $this->conn;
    // }


    
}

?>
