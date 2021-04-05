				<!-- Form -->
				<form 	method="POST" 
						action="controllers/accounts/change-pass.php"
						id="form-cambiarpass" 
						accept-charset="utf-8" 
						class="form-horizontal" 
						novalidate>
					
					<?php renderError(); ?>

					<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($token, ENT_QUOTES | ENT_HTML5, 'UTF-8')?>" />

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Contraseña Anterior: </label>
						<div class="col-sm-9">
							<input 
								type="password" 
								name="previous_password"
								id="previous_password"
								class="form-control"
								autofocus>
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Contraseña: </label>
						<div class="col-sm-9">
							<input 
								name="new_password"
								id="new_password"
								class="form-control" 
								type="password">
						</div>
					</div>

					<div class="form-group row">
						<label for="repassword" class="col-sm-2 col-form-label">Repetir Contraseña: </label>
						<div class="col-sm-9">
							<input 
								name="repeat_new_password"
								id="repeat_new_password" 
								class="form-control" 
								type="password">
						</div>
					</div>

					<?php renderCaptcha(); ?>

					<p class="center">
						<button type="submit" 
								id="btn-changepass" 
								class="btn btn-primary btn-lg">Cambiar Contrase&ntilde;a</button>
					</p>

				</form>