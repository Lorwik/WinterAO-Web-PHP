				<!-- Form -->
				<form method="POST" 
					  action="controllers/accounts/login.php" 
					  id="form-login" 
					  accept-charset="utf-8" 
					  class="form-horizontal"
					  novalidate>
					
					<?php renderError(); ?>

					<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($token, ENT_QUOTES | ENT_HTML5, 'UTF-8')?>" />

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">E-Mail: </label>
						<div class="col-sm-9">
							<input 
								type="email" 
								name="email" 
								autocomplete="username"
								class="form-control" 
								autofocus
								required>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Contrase&ntilde;a: </label>
						<div class="col-sm-9">
							<input 
								type="password" 
								autocomplete="current-password"
								name="password" 
								class="form-control"
								required>
						</div>
					</div>

					<?php renderCaptcha(); ?>

					<p class="center">
						<button type="submit" 
								id="btn-login" 
								class="btn btn-primary btn-lg">Iniciar sesi&oacute;n</button>
					</p>
				
				</form>

				<div class="text-center">
					<a href="registro.php">¿No tienes cuenta?</a>
					<br />
					<a href="recuperar.php?action=request">¿Olvidaste la contraseña?</a>
				</div>
					