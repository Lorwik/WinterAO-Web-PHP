<?php
	require_once('app/config.php');
	if (isset($_GET['logout'])) session_abort();
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
				<a class="nav-link active" href="index.php">Home</a>
				<a class="nav-link" href="staff.php">Staff</a>
				<a class="nav-link" href="http://winterao.com.ar/wiki/" target="_blank">Manual</a>
				<a class="nav-link" href="multimedia.php">Multimedia</a>
				<a class="nav-link" href="descargas.php">Descargas</a>
				<a class="nav-link" href="login.php">Control de Cuenta</a>
			</nav>
		</header>

		<section>

			<section class="bienvenida">

				<p class="text-center">
					<img src="public/img/logo.png">
				</p>

				<article class="text-center">
					<div class="container">
						<p>Sumergete en un nuevo mundo de fantasia lleno de aventuras y peligros.</p>
						<p>Basado en el popular MMORPG Argentino "Argentum Online", Winter AO vuelve en 5ª versión con nuevas implementaciones y sistemas ¡unicos!</p>
						<br/>
						<p>¡No esperes mas y sumergete en este epico mundo de fantasia!</p>
						<a href="https://discord.gg/WHWZwYP">
							<img src="public/img/discord.png"></img>
						</a>
						&nbsp;
						<a href="https://www.instagram.com/winterao_argentumonline">
							<img src="public/img/instagram.png" width="100px" />
						</a>
						&nbsp;
						<a href="https://www.facebook.com/Winter-AO-Resurrection-100546474972832/">
							<img src="public/img/facebook.png" width="90px" />
						</a>
						&nbsp;
						<a href="https://chat.whatsapp.com/HzMMJgdx5s35qVEXzggJN6">
							<img src="public/img/whatsapp.png" width="90px" />
						</a>
					</div>
				</article>
			</section>
			
			<!-- A partir de aca van las noticias -->
			<?php include("noticias.php") ?>

		</div>
	</section>

	<?php include_once('views/partials/footer.php'); ?>

</html>