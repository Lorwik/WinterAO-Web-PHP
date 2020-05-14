<!DOCTYPE html>
<html>
	<?php include_once 'inc/header.php'; ?>

	<body>
		<div class="form-body">
			<?php include_once 'inc/menu.php'; ?>
			<?php require("inc/".$section.".php"); ?>	
		</div>
	</body>
	<?php include_once "inc/footer.php"; ?>
</html>