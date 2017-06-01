<?php
class News {
    public static function getNewsById($id){
        
    }
    public static function getNewsList(){
        $host = 'localhost';
        $dbname = 'complaints';
        $user = 'root';
        $password = '';
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
         
    }
}