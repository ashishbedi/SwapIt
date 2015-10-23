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
			background-image: url("images/swap.png");
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

		.add{
			left:15px;
			/*width:60px;*/
			position:fixed;
			top:570px;
			background-repeat:no-repeat;
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

	<div class="container well sign">
		<h1>Noti<em>fi</em>cation</h1>  

	</div>

	<div class="container well panel panel-primary">
		<?php
		if(empty($notifIn)){ ?>

		<h4>Sorry, you have no new incoming requests.</h4>

		<?php }

		else{
			foreach ($notifIn as $key => $value) {

				$coming = getPUname($value[0],$conn)[0];
				$going  = getPUname($value[1],$conn)[0]; 

				$products = array($value[0],$value[1]);

				?>

				<b><?=$coming[1]?></b> asks for your <b><?=$going[0]?></b> in exchange for <b><?=$coming[0]?></b>.
				<form method="post">

					<button name="accept" value="<?=implode('.',$products)?>" type="submit" class="btn btn-lg btn-success mdi-navigation-check"></button>
					<button name="decline" value="<?=implode('.',$products)?>" type="submit" class="btn btn-lg btn-danger mdi-navigation-close"></button>						
				</form>
				<hr>


				<?php 
			} 
		} ?>
	</div>

	<div class="container well panel panel-primary">
		<?php
		if(empty($notifOut)){ ?>

		<h4>Sorry, you have no updates.</h4>

		<?php }

		else{
			foreach ($notifOut as $key => $value) {

				$coming = getPUname($value[1],$conn)[0];
				$going  = getPUname($value[2],$conn)[0]; 

				if($value[0] == 0){
					?>

					<b><?=$coming[1]?></b> didn't responded yet to your request for his <b><?=$coming[0]?></b> in exchange for your <b><?=$going[0]?></b>.<br>
					<?=$value[3]?>
					<hr>


					<?php 
				}

				if($value[0] == 1){
					?>

					<b><?=$coming[1]?></b> accepted your request for his <b><?=$coming[0]?></b> in exchange for your <b><?=$going[0]?></b>.<br>
					<?=$value[3]?>
					<hr>


					<?php 
				}

				if($value[0] == -1){
					?>

					Your request for <b><?=$coming[1]?></b>'s <b><?=$coming[0]?></b> in exchange for your <b><?=$going[0]?></b> was cancelled.<br>
					<?=$value[3]?>
					<hr>


					<?php 
				} 
			}
		} ?>
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
