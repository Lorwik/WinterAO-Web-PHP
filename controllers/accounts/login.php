<?php

	require("validator.php");
	require_once("../../models/Users/Login.php");

	if (!$cuentasActivo) {
		$error_msg = 'El <strong>sistema de cuentas</strong> esta <strong>DESACTIVADO</strong> en estos momentos';
		error($error_msg);
	}

	$emailField = $_POST['email'];
	$passwordField = $_POST['password'];

	//¿Es un correo electrónico desechable?
	if (!$emailChecker->isValid($emailField)) {
		$error_msg = 'Hemos detectado un correo electrónico desechable. Ingrese una cuenta válida!';
		error($error_msg);
	}

	//Llegado a este punto, interactuamos con el sistema de cuentas.
	$loginSystem = new AccountLogin;

	// Existe un usuario con esa contraseña?
	if ($loginSystem->login($emailField, $passwordField)) {
        
        // Es obligatorio verificar la cuenta?
        if ($verificacionRequerida) {
        	if (!$loginSystem->cuentaVerificada($emailField)) {
				$error_msg = 'Debes verificar la cuenta para ingresar!';
				error($error_msg);
			}
        }

        $_SESSION['email'] = $emailField;
        $_SESSION['id'] = $loginSystem->accountData['id'];
        $_SESSION['user'] = $loginSystem->accountData['username'];
        $_SESSION['gemas'] = $loginSystem->accountData['gemas'];
		
		// Lo mando al panel de cuenta.
		header("Location: " . str_replace("login", "cuenta", $_SERVER['HTTP_REFERER']));

	} else {
		$error_msg = 'Los datos ingresados son incorrectos. Intente nuevamente!';
		error($error_msg);
	}
?>