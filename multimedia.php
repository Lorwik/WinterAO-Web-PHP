<!DOCTYPE html>
<html lang="es">
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
				<a class="nav-link active" href="multimedia.php">Multimedia</a>
				<a class="nav-link" href="descargas.php">Descargas</a>
				<a class="nav-link" href="login.php">Control de Cuenta</a>
			</nav>
		</header>

		<section class="text-center">

			<section>

				<h1 class="titulo">Videos</h1>
					
				<div>
					<p>Trailer WinterAO ultimate</p>
						
					<iframe src="https://www.youtube.com/embed/OrTmtyNzKys"
							frameborder="0" 
							allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
							allowfullscreen>	
					</iframe>
				</div>

			</section>

			<section>

				<h1 class="titulo">Imagenes</h1>
				
				<br/>

				<div>
					<p>En estos momentos no tenemos imagenes para mostrar.</p>
				</div>

			</section>

		</section>

	</body>

	<?php include_once("views/partials/footer.php"); ?>
</html>