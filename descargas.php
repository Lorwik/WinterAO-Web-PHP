<!DOCTYPE html>
<html>
	<head>
		<?php
			include_once('app/config.php'); 
			include_once('views/partials/header.php'); 
		?>
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
				<a class="nav-link active" href="descargas.php">Descargas</a>
				<a class="nav-link" href="login.php">Control de Cuenta</a>
			</nav>
		</header>

		<section>

			<div class="container text-center">

				<div class="shadowed-box">
					<h1  class="titulo">Descargas</h1>

					<p>Lo sentimos, el juego aun no esta disponible para descargar.</p>

					<p>No pierdas detalle del desarrollo de la nueva versión y unete a nuestro servidor de Discord!</p>
					<a href="http://discord.gg/WHWZwYP"><img src="recursos/img/discord.png"></img></a>
				</div>

				<br />

				<div class="shadowed-box">
					<h1  class="titulo">Versiones Anteriores</h1>
				
					<p>WinterAO es una modificaci&oacute;n de Argentum Online bajo la licencia GNU/GPL. Nos gusta ser agradecido con la comunidad y cumplir con las licencias, es por ello
					que ponemos a disposición la descarga del codigo fuente, asi como sus recursos y herramientas de versiones anteriores.
					Accede al repositorio de GitHub y descarga el codigo fuente de WinterAO Ultimate.</p>
					<a href="https://github.com/Lorwik/Winter-AO-Libre"><img src="recursos/img/github.png"></img></a>

				</div>

			</div>

		</section>
		
	</body>
	
	<?php include_once('views/partials/footer.php'); ?>
</html>