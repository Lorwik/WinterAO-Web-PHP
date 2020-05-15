<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = '217.216.5.184';
        $this->db       = 'winterao';
        $this->user     = 'winter';
        $this->password = "5w32d32J3oLZrEY7";
        $this->charset  = 'utf8mb4';
    }

    function connect(){
    
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;

        }catch(PDOException $e){
           print_r('<div class="alert alert-danger" role="alert">Error al registrar la cuenta, intentalo mas tarde o ponte en contacto con un administrador.</div>');

            //No mostramos los errores de SQL
            //print_r('Error connection: ' . $e->getMessage());
        }   
    }
    
}

?>