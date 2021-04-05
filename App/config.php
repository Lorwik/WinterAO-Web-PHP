<?php
	/*
	 * Configuraciones
	*/
	define("TITULO", "WinterAO Resurrection");

	$cuentasActivo = true; // Login
	$registroActivo = true; // Creacion de cuentas
	$verificacionRequerida = true;

	// Google reCAPTCHA - Clave Privada y Clave de Sitio
	define("RECAPTCHA", true);
	define("RECAPTCHA_SITE_KEY", "6LdvfP0UAAAAAKH_6APEeKWLKivKQP32eibq_ANq");
	define("RECAPTCHA_SECRET_KEY", "6LdvfP0UAAAAAKaUk7pBkwCWbbP9h6u5eOACT0zE");

	// Autentificacion Base de Datos
	define("DATABASE", "winterao");
	define("DATABASE_HOST", "localhost");
	define("DATABASE_USER", "root");
	define("DATABASE_PASSWORD", "");
	/*
	define("DATABASE", "winterao");
	define("DATABASE_HOST", "217.216.5.184");
	define("DATABASE_USER", "winter");
	define("DATABASE_PASSWORD", "5w32d32J3oLZrEY7");
	*/

	// Configuración y datos de PayPal
	define("PAYPAL_ENV", "development");
	define("PAYPAL_PUBLIC", "AU7pyEppkF-GEuLRmJFKnJipFNfnMGk-zsp8m1BP6tMSOmrKu0cZd7VZmMgRglaMZ8OxPj8HtgDCVXms");
	define("PAYPAL_SECRET", "EPjnrI2yNbDTdlq1EinbR4IqseBnKXxbcNT0zMosd7EeqvUNnGiISVl2CzWyrF9tk-93R8Pd_KQGNLKh");

	/*
	 *	De acá en adelante NO TOCAR NADA.
	 *	Son definiciones que deben declararse en "todos" lados (de la página).
	*/
	
	// Esto hace los hrefs dinamicos. (NO TOCAR)
	$base_url = str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname($_SERVER['PHP_SELF']));

	// Inyecta todas las dependencias manejadas por Composer (NO TOCAR)
	require_once(__DIR__ . "/../vendor/autoload.php");

	// Esto va a inicializar una sesión segura, osea, sesión normal pero con sus datos encriptados con AES-256-CBC.
	function init_secure_session()
	{
		if(session_status() !==  PHP_SESSION_ACTIVE) {
			// Modificamos algunos parámetros de la cookie PHPSESSID para hacerla mas segura.
	      	ini_set("sessions.use_only_cookies", 1);
	      	ini_set("session.cookie_secure", 0);
	      	ini_set("session.cookie_httponly", 1);
	      	ini_set("session.cookie_domain", $_SERVER['SERVER_NAME']);
	      	ini_set("session.use_strict_mode", 1);
	      	ini_set("session.referer_check", 1);
	      	ini_set("session.use_trans_sid", 0);
		}

		// La iniciamos.
		session_start();
	}

	// Renderiza la cajita del captcha en los formularios.
	function renderCaptcha()
	{
		if (RECAPTCHA == false) return;

		echo "<div  align='center' 
					class='g-recaptcha' 
					data-sitekey='" . RECAPTCHA_SITE_KEY . "' 
					data-theme='dark' 
					data-expired-callback='expiredCaptcha'>
			</div>";
	}

	function renderError() {
		if (isset($_SESSION['error'])) {
			echo "<div class='alert alert-danger'>";
			echo $_SESSION['error'];
			unset($_SESSION['error']);
			echo"</div>";
		}
	}
?>