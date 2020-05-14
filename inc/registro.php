<!--<hr class="regBoxBar">-->
			<div class="container">
				<!-- Form -->
				<form action="?" method="POST" accept-charset="utf-8" class="form-horizontal" role="form">
					<div class="titulo">
						<h1 class="regBoxTitle">Crear Nueva Cuenta</h1>
						<p>Y participa en una gran aventura.</p>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email: </label>
						<div class="col-sm-9">
							<input type="email" name="email" class="form-control" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Password: </label>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control" placeholder="6 a 24 caracteres.">
						</div>
					</div>

					<div class="form-group">
						<label for="repassword" class="col-sm-3 control-label">Repetir Contraseña</label>
						<div class="col-sm-9">
							<input type="password" name="repassword" class="form-control">
						</div>
					</div>

					<center>
						<div class="g-recaptcha" data-sitekey="6Lc17vYUAAAAAEhs7DjTXpRecwadsJk8vd_krE_V" data-theme="dark" data-expired-callback="expiredCaptcha"></div>
					</center>

					<div class="form-check">
						<input type="checkbox" class="form-check-input" name="checkTerms" id="checkTerms">
						<label class="form-check-label" for="checkTerms">Confirmo haber leido y aceptar el <a href="http://winterao.com.ar/wiki/index.php?title=Reglamento">reglamento</a></label>
					</div>

					<p class="center"><input type="submit" value="Registrar" onclick="login()" class="btn btn-primary btn-lg"></p>

					<?php			
						if (isset($_POST["email"])){
							$emailForm = $_POST['email'];
							$passForm = $_POST['password'];
							$repassForm = $_POST['repassword'];
								
							$secretKey = "6Lc17vYUAAAAAO67oW1y7BiAAF4gaBBFGQLzJ63X";
							$responseKey = $_POST['g-recaptcha-response'];
							$userIP = $_SERVER['REMOTE_ADDR'];

							$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
							$response = file_get_contents($url);
							$response = json_decode($response);

							//Iniciamos la bandera error
							$error = false;

							//¿Se dejo algun campo vacio?
							if (($emailForm == "") || ($passForm == "")){
								$errormsg = "¡Debes rellenar todos los campos!";
								$error = true;
							}

							//¿Coinciden las contraseñas?
							if ($passForm <> $repassForm){
								$errormsg = "Las contraseñas no coinciden";
								$error = true;
							}

							//¿El Email cumple un minimo de caracteres?
							if ((strlen($emailForm) < 7) || (strlen($emailForm) > 32)){
								$errormsg = "El email debe tener entre 7 a 32 caracteres.";
								$error = true;
							}

							//¿Las contraseñas cumplen un minimo de caracteres?
							if ((strlen($passForm) < 6) || (strlen($passForm) > 24)){
								$errormsg = "La contraseña debe tener entre 6 a 24 caracteres.";
								$error = true;
							}

							//¿Acepto los terminos?
							if($_POST['checkTerms'] == 'on') {
							} else {
							   	$errormsg = "Debes aceptar el reglamento.";
								$error = true;
							}

							include("includes/user.php");
							$user = new user();

							//¿El usuario ya fue registrado?
							if ($user->ExisteUsuario($emailForm) == true){
								$errormsg = "Ya hay una cuenta con ese email registrado.";
								$error = true;
							}


							//¿Se produjo algun error?
							if ($error == false){
								if ($response->success){
									//Si llegamos aqui, creamos el usuario
									if ($user->createUser($emailForm, $passForm)){
										echo '<div class="alert alert-success" role="alert">';
										echo "¡Registro completado!";
										echo '</div>';
									}else{
										echo "Error al registrar la cuenta, intentalo mas tarde o ponte en contacto con un administrador.";
									}
								}else{
									echo '<div class="alert alert-danger" role="alert">';
									echo "Por favor tilde el casillero 'No soy un robot'.";
									echo '</div>';
								}
							}else{ //Si se produjeron, mostamos cuales fueron.
								echo '<div class="alert alert-danger" role="alert">';
								echo $errormsg;
								echo '</div>';

								$error = false;
							}
						}
					?>
				</form>
			</div>