<!DOCTYPE html>
<html>
<head>
	<title>swapIt</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/material.min.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.min.css">	
	
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<link rel="stylesheet" type="text/css" href="css/user-info.css">

	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<style type="text/css">

		body{
			background-image: url("images/swap.jpg") ;
		}

		.container{
			width: 50em;
		}

		.user-body{
			color: black;
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

	<div class="container " align="center">
		<div class="row">
			<div class="col-sm-12 col-md-12 user-details">
				<div class="user-image">
					<img src="images/user/<?=$uid%3?>.jpg" alt="Name" title="Name" class="img-circle">
				</div>
				<div class="user-info-block">
					<div class="user-heading">
						<h3 style="color: black;"><?=$user_info[0]?></h3>
						<span class="help-block"><h4 ><?=$user_info[6]?></h4></span>
					</div>

					<ul class="navigation">
						<li class="active">
							<a data-toggle="tab" href="#information">
								<span class="glyphicon glyphicon-user"></span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#products">
								<span class=" glyphicon glyphicon-shopping-cart"></span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#swaps">
								<span class="glyphicon glyphicon-retweet"></span>
							</a>
						</li>
					</ul>

					<div class="user-body" align="left">
						<div class="tab-content">
							<div id="information" class="tab-pane active">
								<h4><strong>Address</strong>: <?=$user_info[4]?></h4><hr>
								<h4><strong>E-mail</strong>: <?=$user_info[2]?></h4><hr>
								<h4><strong>Contact</strong>: <?=$user_info[3]?></h4><hr>
								<h4><strong>Pin Code</strong>: <?=$user_info[5]?></h4><hr>
								<h4><strong>DOB</strong>: <?=$user_info[1]?></h4><hr>
							</div>

							<div id="products" class="tab-pane" align="left">


								<?php
								if(empty($my_products)){ ?>

								<h4>Sorry, you have no products.</h4>

								<?php } 


								else{
									foreach ($my_products as $key => $value) {?>

									<STRONG><?=$value[0]?></STRONG>: <?=$value[1]?>
									<hr>
									<?php }
								} ?>

							</div>



							<div id="swaps" class="tab-pane" align="left">
								<?php
								if(empty($barters)){ ?>

								<h4>Sorry, you have no past Swaps.</h4>
								<?php }

								else{
									foreach ($barters as $key => $value) {

										$own = getPUname($value[0],$conn)[0];
										$second  = getPUname($value[1],$conn)[0]; ?>

										<b><?=$second[0]?></b> of <b><?=$second[1]?></b> with <b><?=$own[0]?></b> of <b><?=$own[1]?>.</b> <br> <?=$value[2]?>.
										<hr>


										<?php 
									} 
								} ?>

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/material.min.js"></script>
<script type="text/javascript" src="js/ripples.min.js"></script>
<script>
	$(document).ready(function() {
		$.material.init();
	});
</script>


</body>

</html>