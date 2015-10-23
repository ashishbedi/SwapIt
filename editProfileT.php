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

		/*.navbar{
			height: 3em;
		}*/

	</style>
</head>
<body>

	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="signin.php"><strong>Swap<em>It</em></strong></a>
		</div>
		<div class="navbar-collapse collapse navbar-responsive-collapse">

			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:void(0)">About<em>Us</em></a></li>
			</ul>
		</div>
	</div>

	<div class="container well sign">
		<h1>Edit <em>your</em> Profile</h1>  

	</div>

	<div class="container well panel panel-primary">
		<form class="form-horizontal" method="post">
			<fieldset>

				<!-- Form Name -->
				<!-- <legend>Form Name</legend> -->


				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="bio">Bio</label>  
					<div class="col-md-4">
						<input value="<?=$user_info[0]?>" id="bio" name="bio" type="text" placeholder="" class="form-control input-md">

					</div>
				</div>


				<!-- TODO: DATE => INTEGER -->
				<!-- Search input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="dob">DOB</label>
					<div class="col-md-4">
						<input value="<?=$user_info[1]?>" id="dob" name="dob" type="date" placeholder="" class="form-control input-md">

					</div>
				</div>


				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="email">E-mail</label>  
					<div class="col-md-4">
						<input value="<?=$user_info[2]?>" id="email" name="email" type="email" placeholder="" class="form-control input-md">

					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="phone_number">Phone Number</label>  
					<div class="col-md-4">
						<input value="<?=$user_info[3]?>" id="phone_number" name="phone_number" type="number" placeholder="" class="form-control input-md">

					</div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="address">Address</label>
					<div class="col-md-4">                     
						<textarea value="<?=$user_info[4]?>" class="form-control" id="address" name="address"></textarea>
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="zip">Pin Code</label>  
					<div class="col-md-4">
						<input value="<?=$user_info[5]?>" id="zip" name="zip" type="number" placeholder="*required" class="form-control input-md" required="">

					</div>
				</div>

				<!-- Button -->
				<div class="form-group last">
					<label class="col-md-4 control-label" for="signup"></label>
					<div class="col-md-4">
						<button id="signup" name="signup" class="btn btn-primary">Update</button>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
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
</div>


</div>
</body>
</html>