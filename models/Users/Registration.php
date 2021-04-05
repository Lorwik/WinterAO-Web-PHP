<?php

require_once(__DIR__ . '/../../util/Database.php');
require_once(__DIR__ . '/../../util/Mailing/MailClient.php');
require_once("Core.php");

class Registration extends Database {

    use Core;

    private $_database;

    public $mail_error = null;
    public $verificationCode = null;

    public function __construct() {
        $this->_database = Database::connect();
    }

    //Registramos un nuevo usuario
    public function createAccount($user, $email, $pass, $userIP) : bool {
        
        /*
            Hasheamos la contraseña y generamos la salt.
            NOTA: Usamos sha256() en vez de bcrypt xq no es compatible con el login del cliente VB6.
        */
        $salt = Core::generateRandomString();
        $hashpass = hash('sha256', $pass . $salt);
        
        // Genero un codigo de verificación.
        $verifyCode = Core::generateRandomString(16);

        try {
            $query = $this->_database->prepare("INSERT INTO account (username, email, password, salt, last_ip, id_confirmacion) 
            									VALUES (:username, :email, :hashed_password, :salt, :last_ip, :id_confirmacion)");
            $query->execute([
            	'username' => $user,
            	'email' => $email,
            	'hashed_password' => $hashpass,
            	'salt' => $salt,
            	'last_ip' => $userIP,
            	'id_confirmacion' => $verifyCode,
            ]);

            // Si encontramos un resultado que coincida con la query...
            if ($query->rowCount()) {
                $this->verificationCode = $verifyCode;
                return true;

            } else {
                return false;
            }
        } catch (Exception $ex) {
            Log::databaseError($ex, $this->_database);
        }
        
    }

    public function sendVerificationEmail(string $email, string $verificationCode) : bool {
        // // Link usado para verificar la cuenta
        $link = "https://" . $_SERVER['SERVER_NAME'] . "/verificar.php?email=" . $email ."&code=" . $verificationCode;

        // Enviamos correo de verificacion.
        $from = "no-responder@winterao.com.ar";
        $to = $email;
        $subject = "Confirmación de registro de cuenta de WinterAO Resurrection";
        $message = "¡Felicidades! ¡Has creado tu cuenta en WinterAO! Solo debes verificar tu cuenta ingresando a <a href='" . $link . "' target='_blank'>este link</a>";

        // To send HTML mail, the Content-type header must be set!
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";      
        $headers .= "From:" . $from . "\r\n";
        $headers .= "Organization: Winter AO" . "\r\n";
        $headers .= "Reply-To: Winter AO <admin@winterao.com.ar>" . "\r\n";
        $headers .= "Return-Path: Winter AO <admin@winterao.com.ar>" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $headers .= "X-Mailer: PHP". phpversion() . "\r\n";
        
        return mail($to, $subject, $message, $headers);
        // return sendMail($email, 
        //                 "Confirmacion de registro de cuenta de WinterAO Resurrection",
        //                 "¡Felicidades! ¡Has creado tu cuenta en WinterAO! Solo debes verificar tu cuenta ingresando a <a href='" . $link . "' target='_blank'>este link</a>");
    }

    //Verificamos el usuario.
    public function verificarUsuario($email, $verificationCode) :bool {
        $query = $this->_database->prepare('SELECT id_confirmacion 
                                            FROM account 
                                            WHERE email = :email AND id_confirmacion = :verifyCode AND status = 0');
        $query->execute(['email' => $email, 'verifyCode' => $verificationCode]);

        if ($query->rowCount()) {

            $query = $this->_database->prepare("UPDATE account 
                                                SET id_confirmacion = 'VERIFICADA', status = 1  
                                                WHERE email = :email AND status = 0");
            $query->execute(['email' => $email]);

            return true;
        } else {
            return false;
        }
    }

}