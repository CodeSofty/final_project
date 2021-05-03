<?php class Database {

    //Local Host

    private $host = 'localhost';
    private $db_name = 'quotesdb';
    private static $username = 'root';
    private static $password = '';
    private $conn;


    public function connect() {
        $this->conn = null;

        try{

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e) {
            $error = $e->getMessage();
            include('view/error.php');
            exit();
        }

        return $this->conn;
    }


    // private function __construct() {}

    // public static function getDB() {
    //     if(!isset(self::$db)) {
    //         try {
    //             self::$db = new PDO(
    //             self::$dsn,
    //             self::$username,
    //             self::$password);
    //         } catch(PDOException $e) {
    //             $error = $e->getMessage();
    //             include('view/error.php');
    //             exit();
    //         }
    //     }
    //     return self::$db;
    // }

}    

?>