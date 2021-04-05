<?php

	require_once('app/config.php');
	require_once('models/Users/Registration.php');

	$registrationSystem = new Registration;
	$input = new voku\helper\AntiXSS;

	if (isset($_GET['email']) && isset($_GET['code'])) {

		$email = $input->xss_clean($_GET['email']);
		$verificationCode = $input->xss_clean($_GET['code']);

		if ($registrationSystem->verificarUsuario($email, $verificationCode)) {
			header("Location: login.php");
		} else {
			echo "No se ha podido verificar tu cuenta, por favor contacta a un administrador.";
		}

	} else {
		echo "Faltan datos para verificar la cuenta! Contacta con un administrador.";
	}

?>