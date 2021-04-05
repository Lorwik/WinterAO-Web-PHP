<?php

	require_once('app/config.php'); 

	init_secure_session();

	// Si no inició sesión, lo mando al login.
	if (!isset($_SESSION['email'])) header("Location: login.php");

	// Si quiere salir, destruyo la sesión y lo mando a la página principal.
	if (isset($_GET['logout'])) {
		session_unset();
		session_destroy();
		header("Location: index.php");
	}

	$outputSanitizer = new voku\helper\AntiXSS();
	
	// Sanitizamos los datos que se van a mostrar al usuario.
	$username = $outputSanitizer->xss_clean($_SESSION['user']);

?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('views/partials/header.php'); ?>
		
		<!-- Include the PayPal JavaScript SDK -->
    	<script src="https://www.paypal.com/sdk/js?client-id=<?=PAYPAL_PUBLIC?>&currency=EUR"></script>
	</head>

	<body>

		<header>
			<div class="banner"></div>
	    	<div class="section-divider-up"></div>
	    	<br />
			<nav class="nav nav-masthead justify-content-center">
				<a class="nav-link" href="index.php">Home</a>
				<a class="nav-link" href="staff.php">Staff</a>
				<a class="nav-link" href="http://winterao.com.ar/wiki/" target="_blank">Manual</a>
				<a class="nav-link" href="multimedia.php">Multimedia</a>
				<a class="nav-link" href="descargas.php">Descargas</a>
				<a class="nav-link active" href="login.php">Control de Cuenta</a>
			</nav>
		</header>

		<section class="container">
			
			<article class="col shadowed-box text-center">

				<h1> Bienvenido, <?= $username ?></h1>
				
				<br />

				<h3>
					Gemas: <?=$_SESSION['gemas']?>
					&nbsp;&nbsp;&nbsp;
					<button id="btnCollapseTable" class="btn btn-primary btn-lg">Comprar</button>
				</h3>

				<!-- Tabla con los precios de las gemas -->
				<?php include_once('views/partials/tabla-compra-gemas.php'); ?>

				<br />

				<!-- "Panel" de Cuenta xD jajaja -->
				<a href="cambiar-pass.php" class="btn btn-primary btn-lg">Cambiar Contraseña</a>
					&nbsp;
					&nbsp;
				<a href="?logout" class="btn btn-primary btn-lg">Desconectarse</a>

			</article>

		</section>

	</body>

	<?php include_once('views/partials/footer.php'); ?>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
			crossorigin="anonymous"></script>

	<script src="public/js/cuenta.js"></script>
	<script src="public/js/paypal.js"></script>
</html>