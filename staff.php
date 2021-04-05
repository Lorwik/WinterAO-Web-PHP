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
				<a class="nav-link active" href="staff.php">Staff</a>
				<a class="nav-link" href="http://winterao.com.ar/wiki/" target="_blank">Manual</a>
				<a class="nav-link" href="multimedia.php">Multimedia</a>
				<a class="nav-link" href="descargas.php">Descargas</a>
				<a class="nav-link" href="login.php">Control de Cuenta</a>
			</nav>
		</header>
	
		<section class="container">
			<article class="text-center shadowed-box">

				<p class="staff-posicion">Dirección</p>
				<p>Lorwik - Servidor Primario</p>
				<p>Zharkel - Servidor Secundario</p>

				<p class="staff-posicion">Coordinación</p> 
				<p>sANTO</p>

				<p class="staff-posicion">Programación</p> 
				<p>Lorwik</p>

				<p class="staff-posicion">Mapeo</p> 
				<p>Howell</p>

				<p class="staff-posicion">Balance</p> 
				<p>Estalagmita</p>

				<p class="staff-posicion">Diseño y Programación Web</p> 
				<p>Lowik</p>
				<p>Jopi</p>

				<p class="staff-posicion">Prensa y Gestión de Redes Sociales</p> 
				<p>sANTO - Instagram, Facebook y WhatsApp</p>
                <p>Zharkel - Discord</p>

				<br />
				<p class="staff-posicion">Se agradece a la comunidad de Argentum Online por sus aportes y apoyo.</p>

			</article>
		</section>
	</body>
	
	<?php include_once('views/partials/footer.php'); ?>
</html>