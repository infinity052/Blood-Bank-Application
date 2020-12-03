<?php
class Database{

    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "blood_bank";
    
    private static $connection = null;

    public static function getConnection(){

        if(self::$connection == null){
            self::$connection = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);
            if(self::$connection->connect_error){
                die("Connection to database Failed");
            }
        }
        return self::$connection;
    }

    public static function closeConnection(){
        if(self::$connection != null)
            self::$connection->close();
    }
}


?>