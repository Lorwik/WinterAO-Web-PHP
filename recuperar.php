<?php 

	include_once('app/config.php');

	init_secure_session();

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
					<h1>Recuperar Cuenta</h1>
				</div>

				<?php
				if ($cuentasActivo) {

					// Si viene acá, quiere continuar la recuperacion de la pass sin haberla empezado, lo mando al login.
					if ($_GET['action'] == 'continue' && (!isset($_GET['email']) || !isset($_GET['token']))) {
						header("Location: login.php");
					}

					switch ($_GET['action']) {

						case 'request':
							include_once('views/partials/forms/request-forgotten-pass.php');
							break;

						case 'continue':
							include_once('views/partials/forms/new-forgotten-pass.php');
							break;

						default:
							header("Location: ?action=request");
							break;
					}


				} else {
					echo '<div id="aviso" class="alert alert-danger">';
					echo "El sistema de cuentas esta DESACTIVADO en estos momentos";
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

</html>