				<!-- Form -->
				<form action="controllers/accounts/recpass.php" 
					  method="POST" 
					  accept-charset="utf-8" 
					  class="form-horizontal">

					<?php renderError(); ?>

					<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($token, ENT_QUOTES | ENT_HTML5, 'UTF-8')?>" />

					<input type="hidden" name="action" value="<?=$_GET['action']?>" />

					<input type="hidden" name="email" value="<?=$_GET['email']?>" />
					<input type="hidden" name="token" value="<?=$_GET['token']?>" />

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Contraseña Nueva: </label>
						<div class="col-sm-9">
							<input 
								type="password" 
								autocomplete="new-password"
								name="new_password" 
								class="form-control" 
								autofocus
								required>
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Repite Contraseña: </label>
						<div class="col-sm-9">
							<input 
								type="password" 
								autocomplete="new-password"
								name="repeat_new_password" 
								class="form-control" 
								autofocus
								required>
						</div>
					</div>

					<?php renderCaptcha(); ?>

					<p class="center">
						<button type="submit" 
								class="btn btn-primary btn-lg">Recuperar</button>
					</p>
				
				</form>