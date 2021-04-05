<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Setea la configuracion del cliente del PHPMailer autenticandome en el SMTP.
function initializeClient() : PHPMailer {

    // Objeto donde manejamos TODO lo relacionado al envio de E-Mails
    $mail = new PHPMailer();

    // Conexion al Servidor SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  // Enable verbose debug output
    $mail->setLanguage('es');                               // Set language for the client's error reports, defaults to 'en'
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                   // Specify main SMTP server
    $mail->SMTPAuth   = true;                               // Enable SMTP authentication
    $mail->Username   = 'winterargentumonline@gmail.com';   // SMTP username
    $mail->Password   = 'LwKEstaMamadisimo20';              // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption, 'ssl' also accepted
    $mail->Port       = 587;                                // TCP port to connect to

    return $mail;
}

// Enviar un mail...
function sendMail($targetEmail, $asunto, $mensaje) {
    try { 

        $mail = initializeClient();

        $mail->setFrom('admin@winterao.com.ar', 'WinterAO - NO RESPONDER ');          
        $mail->addAddress($targetEmail);    
        $mail->isHTML(true);      

        $mail->Subject = $asunto; 
        $mail->Body    = $mensaje; 
        $mail->send(); 

        return true;

    } catch (Exception $e) { 

        //die($mail->ErrorInfo . "\n\n\n" . $e->getMessage());

        return false;
    }
    
}