<?php
class Database {
    private static $dbName = 'videoclub'; 
    private static $dbHost = 'localhost';
    private static $dbUsername = 'dwesroot'; 
    private static $dbUserPassword = 'dwesroot';
    private static $conn = null; 
    
    public function __construct(){
        die('Init-Función no permitida');
    }

    public static function conectar() {
        if (self::$conn == null){
            try {
                self::$conn = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,
                        self::$dbUsername, 
                        self::$dbUserPassword);
                    
            } catch (PDOException $e) { 
                die($e->getMessage());
            }
        }
        
        return self::$conn; 
    }

    public static function desconectar() {
        self::$conn = null; 
    }
}   //class

?>
