<?php

	require_once("validator.php");
	require_once("../../models/Users/Login.php");

	// Chequeo que haya completado todos los campos.
	if (!isset($_POST['previous_password']) || !isset($_POST['new_password']) || !isset($_POST['repeat_new_password'])) {
		$error_msg = 'Por favor, complete todos los campos!';
		error($error_msg);
	}

	// Guardamos los datos recibidos en variables y los sanitizamos.
	$contraseñaAnterior = $_POST['previous_password'];
	$contraseñaNueva = $_POST['new_password'];
	$repiteContraseña = $_POST['repeat_new_password'];

	//¿Las contraseñas cumplen un minimo de caracteres?
	if ((strlen($contraseñaAnterior) < 6) || (strlen($contraseñaAnterior) > 23) ||
		(strlen($contraseñaNueva) < 6) || (strlen($contraseñaNueva) > 23) ||
		(strlen($repiteContraseña) < 6) || (strlen($repiteContraseña) > 23)) {
		
		$error_msg = 'Las contraseñas deben tener entre 6 y 23 caracteres';
		error($error_msg);
	}

	/*
		De acá en adelante, usamos el sistema de cuentas.
		Uso la clase Login xq es la que tiene el método para chequear si la contraseña anterior es correcta.
	*/
	$accountSystem = new AccountLogin;

	// La contraseña anterior, ¿es correcta?
	if (!$accountSystem->login($_SESSION['email'], $contraseñaAnterior)) {
		$error_msg = 'La contraseña anterior es incorrecta.';
		error($error_msg);
	}

	// Intentamos hacer el cambio de contraseña.
	if ($accountSystem->cambiarContraseña($_SESSION['email'], $contraseñaNueva)) {
		
		// Cerramos sesión.
		session_destroy();
		
		// Terminamos.
		// Lo mando al panel de cuenta.
		header("Location: login.php");

	} else {
		$error_msg = 'Hubo un error inesperado al procesar la petición, contacte con un administrador.';
		error($error_msg);
	}

?>