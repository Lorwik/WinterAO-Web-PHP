<?php

require_once("Core.php");
require_once("../../util/Database.php");
require_once("../../util/Logger.php");

class AccountLogin extends Database {

    use Core;

    private $_database;
    public array $accountData;

    public function __construct() {
        $this->_database = Database::connect();
    }

    //Funcion que comprueba si el usuario existe con esa password.
    public function login($email, $pass) : bool {
        try {

            $contador = 0;
            
            // Buscamos la contraseña actual y el salt en la base de datos.
            $query = $this->_database->prepare('SELECT id, username, password, salt, gemas
                                                FROM account 
                                                WHERE email = :email');
            $query->execute(['email' => $email]);

            // Si no hubo resultados, devolvemos FALSE.
            if ($query->rowCount() === 0) return false;

            // Obtenemos el resultado de la query y lo guardamos en un array $queryResult[columna]
            $queryResult = $query->fetch(\PDO::FETCH_ASSOC);

            // Hasheamos la contraseña que mando el usuario mediante el fomulario.
            $pass = hash('sha256', $pass . $queryResult['salt']);
            
            // Comparamos el hash con la contraseña dada por el usuario con el que tenemos en la DB.
            if (hash_equals($pass, $queryResult['password'])) {
                
                // Guardamos algunos datos en la sesión para ahorar consultas a la DB.
                $this->accountData['id'] = $queryResult['id'];
                $this->accountData['username'] = $queryResult['username'];
                $this->accountData['gemas'] = $queryResult['gemas'];

                return true;
            } 
            
            return false;

        } catch (Exception $ex) {
            Log::databaseError($ex, $this->_database);
            return false;
        }

    }

    //Funcion que comprueba si el usuario fue confirmado para poder logear
    public function cuentaVerificada($email) : bool {
        $query = $this->_database->prepare('SELECT status FROM account WHERE email = :email AND status = 1');
        $query->execute(['email' => $email]);

        if ($query->rowCount()) {
            return true;
        } else {
            return false;
        }
    }
}

?>