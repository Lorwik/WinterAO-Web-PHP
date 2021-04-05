<?php

require_once('../../app/config.php');

init_secure_session();

/*
	Al elevar privilegios, es recomendable regenerar el ID de la sesión
	para prevenir robo de sesiones.

	En este caso, validator.php solo se ejecuta en el login, registro y cambiar-pass.
*/
session_regenerate_id(true);

$csrf = new Riimu\Kit\CSRF\CSRFHandler;
$emailChecker = new EmailChecker\EmailChecker();
$userIP = $_SERVER['REMOTE_ADDR'];

function error($error_message) {
	$_SESSION['error'] = $error_message;
	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit;
}

// Analizamos la petición entrante, especialmente si proviene del mismo dominio.
$csrf->validateRequest();

// Esta actvada la comprobacion por CAPTCHA?
if (RECAPTCHA === true) {
	
	// Obtenemos el token del cliente.
	$responseKey = $_POST['g-recaptcha-response'];

	// Hacemos la petición a google.
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$url .= "?secret=" . RECAPTCHA_SECRET_KEY;
	$url .= "&response=" . $responseKey;
	$url .= "&remoteip=" . $userIP;

	// Guardamos la respuesta en un array.
	$response = file_get_contents($url);
	$response = json_decode($response);

	// ¿Se pudo hacer la petición? ¿Su puntaje esta bien?
	if($response->success == false) {
		$error_msg = "Por favor tilde el casillero 'No soy un robot'.";
		error($error_msg);
	}
}