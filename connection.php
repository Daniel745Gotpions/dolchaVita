<?php 
class Conn{

//variable to hold connection object.
    protected static $db;

//private construct - class cannot be instatiated externally.
    private function __construct() {

        try {

            $options = array(
                PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
            );

            self::$db = new PDO( 'mysql:host=localhost;dbname=dolchaVita', 'root', 'password' ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        }
        catch (PDOException $e) {

            echo "Connection Error: " . $e->getMessage();
        }

    }

    public static function R() {

        if (!self::$db) {
            new Conn();
        }

        return self::$db;
    }
}

?>