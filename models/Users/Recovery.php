<?php

require_once("../Database.php");
require_once("../Logger.php");
require_once("Core.php");

class AccountRecovery extends Database {

    use Core;

    private $_database;

    public function __construct() {
        $this->_database = Database::connect();
    }

    public function recuperarCuenta($email, $token, $nuevaPass) {
        
        try {

            $query = $this->_database->prepare("SELECT id_recuperacion 
                                                FROM account 
                                                WHERE email = :email AND id_recuperacion = :recuperar_token");
            $query->execute(['recuperar_token' => $token, 'email' => $email]);

            // Si encontramos un resultado que coincida con la query, significa q el token pertenece a ese email.
            if ($query->rowCount()) {

                // Una vez usado el token, lo borramos asi no lo puede volver a usar.
                $query = $this->_database->prepare("UPDATE account 
                                SET id_recuperacion = NULL
                                WHERE email = :email AND id_recuperacion = :recuperar_token");
                $query->execute(['recuperar_token' => $token, 'email' => $email]);

                // Seguimos el proceso de recuperacion
                $this->cambiarContraseña($email, $nuevaPass);

                return true;
            } else {
                return false;
            }
        
        } catch (Exception $ex) {
            Log::databaseError($ex, $this->_database);
        }
    
    }

    public function enviarEmailRecuperacion($email) {
        
        try {
            // Generamos un nuevo token de recuperacion
            $token = Core::generateRandomString();
            
            // Lo actualizamos en la base de datos.
            $query = $this->_database->prepare("UPDATE account
                                                SET id_recuperacion = :token
                                                WHERE email = :email");
            $query->execute(['token' => $token, 'email' => $email]);

            // Si se pudo actualizar, seguimos.
            if ($query->rowCount()) {
                
                // Link usado para verificar la cuenta
                $link = "https://" . $_SERVER['SERVER_NAME'] . $base_url . "/recuperar.php?action=continue&email=" . $email ."&token=" . $token;

                // Enviamos correo de verificacion.
                $from = "no-responder@winterao.com.ar";
                $to = $email;
                $subject = "Recuperacion de cuenta de WinterAO Resurrection";
                $message = "Buenas! Para continuar el proceso de recuperacion vaya a <a href='" . $link . "' target='_blank'>este link</a>";

                // To send HTML mail, the Content-type header must be set!
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";      
                $headers .= "From:" . $from . "\r\n";
                $headers .= "Organization: Winter AO" . "\r\n";
                $headers .= "Reply-To: Winter AO <admin@winterao.com.ar>" . "\r\n";
                $headers .= "Return-Path: The Sender <admin@winterao.com.ar>" . "\r\n";
                $headers .= "X-Priority: 3" . "\r\n";
                $headers .= "X-Mailer: PHP". phpversion() . "\r\n";
                
                return mail($to, $subject, $message, $headers);

            } else {
                return false;
            }
        } catch (Exception $ex) {
            Log::databaseError($ex, $this->_database);
        }   

    } 

}