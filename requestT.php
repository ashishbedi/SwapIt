<!DOCTYPE html>
<html>
<head>
	<title>swapIt</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.min.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<style type="text/css">

		body{
			background-image: url("images/swap.png") ;
		}

		.container,.sign{
			width: 50em;
		}

		.panel{
			opacity: .93;
		}

		.form-group.last { 
			margin-bottom:0px; 
		}

	</style>
</head>
<body>

	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="swap.php"><strong>Swap<em>It</em></strong></a>
		</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse">
			
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="user.php"><strong><?=$name?></strong></a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>

	<div class="container well sign">
		<h1>Select <em>your </em>product</h1>  

	</div>
	
	<div class="container well panel panel-primary" align="center">
		<form class="form-horizontal" method="post">
			<fieldset>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="p_name">Product Name</label>  
					<div class="col-lg-5">
						<br>
						<select multiple="" class="form-control" id="value" name="value">
							<?php

							foreach ($row as $key => $value) {?>

							<option value="<?=$value[0]?>"><?=$value[1]?></option>

							<?php }?>
						</select>
					</div>
				</div>

				<div class="form-group last">
					<label class="col-md-4 control-label" for="signup"></label>
					<div class="col-md-4">
						<button id="signup" name="signup" class="btn btn-primary">SWAP<EM>It</EM></button>
					</div>
				</div>


			</fieldset>
		</form>
	</div>

	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/material.min.js"></script>
	<script type="text/javascript" src="js/ripples.min.js"></script>
	<script src="js/material.min.js"></script>
	<script>
		$(document).ready(function() {
			$.material.init();
		});
	</script>

</body>
</html>
