<?php
	if (isset($_GET['section'])){
		$section=$_GET['section'];
	} else {
		header("location:index.php?section=home");
	}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("includes/config.php");?>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="css/style.css">

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <title><?php echo $titulo; ?></title>

    <div class="banner">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8">
	                
	            </div>
	        </div>
	    </div>
	    <div class="section-divider-up"></div>
    </div>
</head>