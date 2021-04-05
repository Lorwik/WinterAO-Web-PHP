<?php 
	
	require_once('app/config.php'); 

	init_secure_session();

	// Si inició sesión, lo mando al panel de cuenta.
	if (isset($_SESSION['email'])) header("Location: cuenta.php");

	$csrf = new \Riimu\Kit\CSRF\CSRFHandler();
	$token = $csrf->getToken();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include_once('views/partials/header.php'); ?>
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

			<div class="row">

				<!-- Pequeña columna -->
				<div class="col"></div>

				<!-- Columna principal -->
				<div class="col-6 mb-auto shadowed-box">	

					<div class="titulo text-center">
						<h1>Crea una cuenta</h1>
						<p>Y participa en una gran aventura.</p>
					</div>

					<?php
						if ($registroActivo) {
							include_once('views/partials/forms/register-form.php');
						} else {
							echo '<div id="aviso" class="alert alert-danger">';
							echo "La creación de cuentas se encuentra DESACTIVADA en estos momentos";
							echo '</div>';
						}
					?>
	
				</div>	
				
				<!-- Pequeña columna -->
				<div class="col"></div>

			</div>

		</section>

	</body>
	
	<?php include_once('views/partials/footer.php'); ?>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
			crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" 
			integrity="sha256-+BEKmIvQ6IsL8sHcvidtDrNOdZO3C9LtFPtF2H0dOHI=" 
			crossorigin="anonymous"></script>
	
	<script src="public/js/registro.js"></script>

</html>