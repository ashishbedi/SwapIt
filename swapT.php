<!DOCTYPE html>
<html>
<head>
	<title>swapIt</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.min.css">	
	<!-- <link rel="stylesheet" type="text/css" href="css/css.css"> -->
	<link rel="stylesheet" type="text/css" href="css/font.css">

	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<style type="text/css">

		body{
			background-image: url("images/swap.jpg") ;
		}

		.container{
			width: 50em;
		}

		.add{
			left:15px;
			/*width:60px;*/
			position:fixed;
			top:570px;
			background-repeat:no-repeat;
			z-index:22;
		}

		.btn-fab{
			margin: 0;
			padding: 15px;
			font-size: 26px;
			width: 56px;
			height: 56px;
		}

		.bg_blur
		{
			background-image:url('images/products/');
			background-size: none;
		}

	</style>



</head>
<body>

	<div class="add">
		<a class="btn btn-primary btn-fab btn-raised mdi-action-add-shopping-cart" href="add.php"></a>
	</div>

	<div class="navbar navbar-inverse ">
		<div class="navbar-header">
			<a class="navbar-brand" href="swap.php"><strong>Swap<em>It</em></strong></a>
		</div>
		
		<div class="navbar-collapse collapse navbar-inverse-collapse">

			<form class="navbar-form navbar-left form-inline" method="get">
				<select class="form-control" id="filter" name="filter">
					<font color="black">
						<option value="0">Country</option>
						<option value="1">State</option>
						<option value="2">City</option>
					</font>
				</select>

				<input type="text"  name="p_name" id="p_name" class="form-control col-lg-8" placeholder="Search">
			</form>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="notification.php" class="btn btn-lg btn-fab mdi-communication-messenger"></a></li>
				<li><a href="user.php"><strong><?=$name?></strong></a></li>
				<li><a href="editProfile.php" class="btn btn-lg btn-fab mdi-content-create"></a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>

		</div>
	</div>

	<?php 
	if(empty($row))
		echo("	<div class= 'container '><div class= 'header '><h1>No products found</h1></div></div>");
	else
		foreach ($row as $key => $value) {	?>


	<div class="container">
		<div class="row panel">
			<div class="col-md-4 bg_blur " style="background-image:url('images/product/<?=$value[2]%11?>.png');"></div>
			<div class="col-md-8  col-xs-12">
				<div class="header">
					<h1><?php echo(ucwords($value[3]))?></h1>
					<span>
						<?=$value[4]?>
					</span>
					<br><br>
					<form method="post">
						<button name="fav" value="<?=$value[2]?>" type="submit" class="btn btn-danger btn-fab mdi-action-favorite" aria-label="Left Align">
						</button>
						<button name="swap" value="<?=$value[2]?>" type="submit" class="btn btn-default btn-fab  btn-raised mdi-av-repeat" aria-label="Left Align">
						</button>
						<br>	
						<button name="puid" class="btn" value="<?=$value[0]?>" type="submit"><b>--<?= ucwords($value[1])?></b>
						</button>
					</form>
				</div>
			</div>
		</div> 
	</div>

	<?php  }?>




	<script src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/material.min.js"></script>
	<script type="text/javascript" src="js/ripples.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-growl.min"></script>

	<script>
		$(document).ready(function() {
			$.material.init();
		});

		$("[name='my-checkbox']").bootstrapSwitch();

		$.growl("Hello World");
	</script>

</body>

</html>