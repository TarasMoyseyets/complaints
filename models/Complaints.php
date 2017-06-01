<?php
class Complaints {
    private $_connection;
    private static $_instance;
    private $DB_HOSTNAME = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD =  '';
    private $DB_DATABASE = 'complaints';
    public static function getInstance() {
            if(!self::$_instance) { // If no instance then make one
                self::$_instance = new self();
            }
            return self::$_instance;
    }
    private function __construct() {
            $this->_connection = new mysqli($this->DB_HOSTNAME, $this->DB_USERNAME, 
                    $this->DB_PASSWORD, $this->DB_DATABASE);
            // Error handling
            if(mysqli_connect_error()) {
                    trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                             E_USER_ERROR);
            }
    }
    public function getConnection() {
            return $this->_connection;
    }
    public function createOne($name,$email,$site,$text,$ip,$browser){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $date = date ("Y-m-d H:i:s");
        $query = "INSERT INTO complaint(name,email,site, text, date, ip,browser) VALUES('".$name."','".$email."','".$site."','".$text."','".$date."','".$ip."','".$browser."')";
        if ($mysqli->query($query) === TRUE) {
            $user_id = $mysqli->insert_id;
        }
        //return $user_id;
    }
    public function getRecords($start_from,$records_per_page){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $query_pagin = "SELECT id, name, email, site, text, date, ip, browser FROM complaint ORDER BY date DESC LIMIT {$start_from},{$records_per_page}";
        $pagination = mysqli_query($mysqli, $query_pagin);
        $pagination = $pagination->fetch_all(MYSQLI_ASSOC);
        return $pagination;
    }
    public function getPages(){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $query_page = "SELECT * FROM complaint";
        $pages = mysqli_query($mysqli, $query_page);
        $pages = mysqli_num_rows($pages);
        $pages = ceil($pages/5);
        return $pages;
    }
    public function update($id,$name,$email,$text){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();       
        $query = "UPDATE complaint SET name='".$name."',email='".$email."',text='".$text."' WHERE id = '".$id."'";
        //var_dump($db);
        mysqli_query($mysqli, $query);
        //$user = $user->fetch_assoc();
    }
    public function delete($id){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $query = "DELETE FROM complaint WHERE id = '".$id."'";
        //var_dump($db);
        mysqli_query($mysqli, $query);
        
    }
}
    $db = Complaints::getInstance();