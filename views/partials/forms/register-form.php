				<!-- Form -->
				<form method="POST" 
					  action="controllers/accounts/register.php" 
					  id="form-registro" 
					  accept-charset="utf-8" 
					  class="form-horizontal" 
					  novalidate>
					
					<div class="alert alert-success">
						AVISO: Recuerda que tendrás que verificar la cuenta por lo que debes usar un e-mail válido.
					</div>

					<?php renderError(); ?>

					<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($token, ENT_QUOTES | ENT_HTML5, 'UTF-8')?>" />

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Usuario: </label>
						<div class="col-sm-9">
							<input 
								type="text" 
								name="username"
								autocomplete="username"
								id="username"
								class="form-control"
								autofocus>
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">E-Mail: </label>
						<div class="col-sm-9">
							<input 
								type="email" 
								name="email"
								id="email"
								class="form-control">
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Contraseña: </label>
						<div class="col-sm-9">
							<input 
								name="password"
								autocomplete="new-password"
								id="password"
								class="form-control" 
								type="password">
						</div>
					</div>

					<div class="form-group row">
						<label for="repassword" class="col-sm-2 col-form-label">Repetir Contraseña: </label>
						<div class="col-sm-9">
							<input 
								name="repassword"
								autocomplete="new-password"
								id="repassword" 
								class="form-control" 
								type="password">
						</div>
					</div>

					<div class="form-check">
						<input type="checkbox" class="form-check-input" name="checkTerms" id="checkTerms">
						<label class="form-check-label" for="checkTerms"> 
							Confirmo haber leido y aceptado el <a href="http://winterao.com.ar/wiki/index.php?title=Reglamento" target="_blank">reglamento</a>
						</label>
					</div>

					<?php renderCaptcha(); ?>

					<p class="center">
						<button type="submit" 
								id="btn-register" 
								class="btn btn-primary btn-lg">Registrarse</button>
					</p>

				</form>