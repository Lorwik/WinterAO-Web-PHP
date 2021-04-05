				<!-- Form -->
				<form action="controllers/accounts/recpass.php" 
					  method="POST" 
					  id="recpass-form" 
					  accept-charset="utf-8" 
					  class="form-horizontal">

					<?php renderError(); ?>

					<input type="hidden" name="csrf_token" value="<?=htmlspecialchars($token, ENT_QUOTES | ENT_HTML5, 'UTF-8')?>" />

					<input type="hidden" name="action" value="<?=$_GET['action']?>" />

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">E-Mail: </label>
						<div class="col-sm-9">
							<input 
								type="email" 
								name="email" 
								class="form-control" 
								autofocus
								required>
						</div>
					</div>	

					<?php renderCaptcha(); ?>

					<p class="center">
						<button type="submit" 
							   	class="btn btn-primary btn-lg">Enviar</button>
					</p>
				
				</form>