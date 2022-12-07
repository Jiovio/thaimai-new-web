<?php
session_start();
//error_reporting(0);
// if ($_REQUEST['error'] == '1') {
//     ini_set('display_errors', '1');
//     error_reporting(E_ALL);
// }
if ($_SERVER['HTTP_HOST'] == 'localhost') {

    $sitename = "https://" . $_SERVER['HTTP_HOST'] . "/";
} else {
   // $sitename = "https://domainname/";
}

class Database{
 
    // specify your own database credentials
    
    private $host = "localhost:3307";
    private $db_name = "thaimaiyudan";
    private $username = "root";
    private $password = "";
    
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}


?>