<?php

require_once(__DIR__ . "/../../util/Logger.php");

/**
 * En esta clase se guardan los métodos que se usan en mas de 1 sistema
 * 
 * Sistema de Cuentas:
 *      - Creación 
 *      - Recuperación
 *      - Autentificacion
 */
trait Core {

    //Funcion que comprueba si existe el email solo con el nombre
    public function ExisteUsuario($email, $user) : bool {
        $pdoInstance = $this->connect();
        
        try {
            $query = $pdoInstance->prepare('SELECT email, username FROM account WHERE email = :email OR username = :user');
            $query->execute(['email' => $email, 'user' => $user]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            Log::databaseError($ex, $pdoInstance);
        }  
    }

    //Funcion para cambiar la contraseña del usuario
    public function cambiarContraseña($email, $pass) : bool {
        
        $salt = $this->generateRandomString();
        $hashpass = hash('sha256', $pass . $salt);
        
        // Lo actualizamos en la base de datos.
        $pdoInstance = $this->connect();
        try {
            $query = $pdoInstance->prepare("UPDATE account 
                                            SET password = :hashpass, salt = :salt
                                            WHERE email = :email");
            $query->execute(['hashpass' => $hashpass, 'salt' => $salt, 'email' => $email]);

            if ($query->rowCount()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            Log::databaseError($ex, $pdoInstance);
        }
  
    }

    public static function generateRandomString($length = 32) : string {
        return bin2hex(random_bytes($length / 2));
    }

}