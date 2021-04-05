<?php

require("validator.php");
require("../../models/Users/Registration.php");

//¿Esta activada la creacion de cuentas?
if (!$registroActivo) {
	$error_msg = 'El creación de cuentas se encuentra DESACTIVADA en estos momentos';
	error($error_msg);
}

// Datos del formulario de registro sanitizados.
$usernameForm = $_POST['username'];
$emailForm =$_POST['email'];
$passForm = $_POST['password'];
$repassForm = $_POST['repassword'];

//¿Se dejo algun campo vacio?
if (!isset($usernameForm) || !isset($emailForm) || !isset($passForm)) {
	$error_msg = 'Por favor, complete todos los campos!';
	error($error_msg);
}

//¿Es un correo electrónico desechable?
if (!$emailChecker->isValid($emailForm)) {
	$error_msg = '¡Debes ingresar un correo electrónico que NO sea DESECHABLE!';
	error($error_msg);
}

//¿Coinciden las contraseñas?
if ($passForm <> $repassForm) {
	$error_msg = 'Las contraseñas no coinciden';
	error($error_msg);
}

//¿El usuario cumple un minimo de caracteres?
if ((strlen($usernameForm) < 4) || (strlen($usernameForm) > 23)) {
	$error_msg = 'El usuario debe tener entre 4 y 23 caracteres';
	error($error_msg);
}

//¿El Email cumple un minimo de caracteres?
if ((strlen($emailForm) < 6) || (strlen($emailForm) > 32)) {
	$error_msg = 'El E-Mail debe tener entre 6 y 32 caracteres';
	error($error_msg);
}

//¿Las contraseñas cumplen un minimo de caracteres?
if ((strlen($passForm) < 6) || (strlen($passForm) > 23)) {
	$error_msg = 'La contraseña debe tener entre 6 y 23 caracteres';
	error($error_msg);
}

//¿Tiene numeros o caracteres especiales?
if (preg_match( '/\d/', $usernameForm) || preg_match('/[^a-zA-Z\d]/', $usernameForm)) {
	$error_msg = 'Para evitar problemas, no se puede usar números o caracteres especiales en las contraseñas.';
	error($error_msg);
}

//¿Acepto los terminos?
if(!$_POST['checkTerms'] == 'on') {
	$error_msg = 'Debes aceptar los terminos y condiciones!';
	error($error_msg);
}

// De acá en adelante vamos a tener que usar el sistema de registro de cuentas.
$registrationSystem = new Registration;

//¿El usuario ya fue registrado?
if ($registrationSystem->ExisteUsuario($emailForm, $usernameForm) == true) {
	$error_msg = 'Ya hay una cuenta registrada con ese nombre de usuario o correo.';
	error($error_msg);
}

//Si llegamos aqui, creamos el usuario.
if ($registrationSystem->createAccount($usernameForm, $emailForm, $passForm, $userIP)) {

	// Le mandamos es E-Mail de verificación.
	if ($verificacionRequerida) {

		if ($registrationSystem->sendVerificationEmail($emailForm, $registrationSystem->verificationCode)) {
			// Por si las dudas..
			$registrationSystem->verificationCode = null;

			// Terminamos de mandar el e-mail, avisamos al usuario que lo vea.
			$error_msg = '¡Enhorabuena! hemos registrado tu cuenta, ahora solo debes confirmarla en el email que te hemos enviado.';
			error($error_msg);
		
		} else {

			// Terminamos de mandar el e-mail, avisamos al usuario que lo vea.
			$error_msg = '¡Enhorabuena! hemos registrado tu cuenta, pero no pudimos enviarte el mail debido a un error interno. Contacta con un administrador.';
			error($error_msg);

		}
		
    } else {
		// Terminamos de mandar el e-mail, avisamos al usuario que lo vea.
		$error_msg = '¡Enhorabuena! Hemos registrado tu cuenta.';
		error($error_msg);
    }

	// Lo mando al panel de cuenta.
	header("Location: " . str_replace("login", "cuenta", $_SERVER['HTTP_REFERER']));

} else {
	$error_msg = 'Error al registrar la cuenta, intentalo mas tarde o ponte en contacto con un administrador.';
	error($error_msg);
}

?>