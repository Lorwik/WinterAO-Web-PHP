<?php

require_once(__DIR__ . '/../app/config.php');
require_once('Logger.php');

class Database {

    public static function connect() : PDO {
        $pdoInstance = null;
        
        try {
            $connection = "mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdoInstance = new PDO($connection, DATABASE_USER, DATABASE_PASSWORD, $options);
    
            return $pdoInstance;

        } catch(PDOException $exception) {
           Log::databaseError($exception);
           die ('Error al conectarse a la base de datos, intentalo mas tarde o ponte en contacto con un administrador.');
        }   
    }
    
}

?>