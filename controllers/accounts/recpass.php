<?php
	
	require("validator.php");
	require("../../models/Users/Recovery.php");

	$accountRecoverySystem = new AccountRecovery;

	switch ($_POST['action']) {
		
		case 'request':
			
			// Puso un e-mail?
			if (isset($_POST['email'])) {
				$email = $_POST['email'];
			} else {
				error("Ingresa un e-mail.");
			}

			// Existe una cuenta con ese e-mail?
			if (!$accountRecoverySystem->ExisteUsuario($email, 'null')) {
				error("No hay ninguna cuenta con ese e-mail.");
			}

			// Enviamos un email de recuperacion!
			if ($accountRecoverySystem->enviarEmailRecuperacion($email)) {
				error("Te hemos enviado un e-mail con un link para continuar con el proceso de recuperacion. Asegúrate de chequear la casilla de SPAM si no encuentras el correo.");
			} else {
				error("No pudimos enviarte el correo debido a un error interno. Contacta a un administrador.");
			}
			
			break;
		
		case 'continue':

			if (!isset($_POST['email']) || !isset($_POST['token'])) {
				error("Faltan datos para seguir con el proceso de recuperacion. Contracta con un administrador.");
		    }

			
			if (!isset($_POST['new_password']) || !isset($_POST['repeat_new_password'])) {
				errot("Debes completar todos los campos requeridos");
			}

		    $email = $_POST['email']);
		    $token = $_POST['token']);
		    $nuevaPass = $_POST['new_password'];
		    $repiteNuevaPass = $_POST['repeat_new_password'];

		    // Ambos campos de contraseña coinciden?
		    if ($nuevaPass !== $repiteNuevaPass) {
				error("Las contraseñas no coinciden!");
		    }

		    //¿Las contraseñas cumplen un minimo de caracteres?
			if ((strlen($nuevaPass) < 6) || (strlen($nuevaPass) > 23) ||
				(strlen($repiteNuevaPass) < 6) || (strlen($repiteNuevaPass) > 23)) {
				
				$error_msg = 'Las contraseñas deben tener entre 6 y 23 caracteres';
				error($error_msg);
			}

			if ($accountRecoverySystem->recuperarCuenta($email, $token, $nuevaPass)) {
				header("Location: " . "https://" . $_SERVER['SERVER_NAME'] . "/winteraoweb/login.php");
			} else {
				error("No se pudo recuperar tu cuenta. Contacta con un administrador.");	
			}

			break;

		default:
			error("¡Operación inválida!");	
			break;
	}
?>