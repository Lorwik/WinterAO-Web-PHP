<!DOCTYPE html>
<html>
	<?php include_once 'inc/header.php'; ?>

	<body>
		<div class="form-body">
			<?php include_once 'inc/menu.php'; ?>

			<!--<hr class="regBoxBar">-->
			<div class="container">
				<!-- Form -->
				<form action="?" method="POST" accept-charset="utf-8" class="form-horizontal" role="form">
					<div class="titulo">
						<h1 class="regBoxTitle">Ingresa a tu Cuenta</h1>
					</div>

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Email: </label>
						<div class="col-sm-9">
							<input type="email" name="email" class="form-control" autofocus>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Password: </label>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control">
						</div>
					</div>

					<center>
						<div class="g-recaptcha" data-sitekey="6Lc17vYUAAAAAEhs7DjTXpRecwadsJk8vd_krE_V" data-theme="dark" data-expired-callback="expiredCaptcha"></div>
					</center>

					<p class="center"><input type="submit" value="Ingresar" class="btn btn-primary btn-lg"></p>

					<a href="registro.php">¿No tienes cuenta?</a>
					<a href="">¿Olvidaste la contraseña?</a>
				</form>
			</div>
		</div>
	</body>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php include_once "inc/footer.php"; ?>
</html>