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
			background-image: url("images/signin.png") ;
		}

		.panel-primary {
			opacity: 0.85;
			margin-top:155px;
		}

		.form-group.last { 
			margin-bottom:0px; 
		}

	</style>

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-7">
				<div class="panel panel-primary">
					<div class="panel-heading"><strong>Login</strong></div>
					<div class="panel-body">
						<form class="form-horizontal bs-component" role="form" method="post">
							<fieldset>
								<div class="form-group">
									<label for="user_name" class="col-sm-3 control-label">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control floating-label" name="user_name" placeholder="username" required>
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="pwd" placeholder="password" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<!-- <div class="checkbox"> -->
										<!-- <label> -->
										<!-- <input type="checkbox"/>Remember me -->
										<!-- </label> -->
										<!-- </div> -->
									</div>
								</div>

								<div class="form-group last">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-success btn-sm">Sign in</button>
										<a href="skip.php">
											<button type="button" class="btn btn-default btn-sm"> Skip</button>
										</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="panel-footer">
						Not Registred? <a href="signup.php">Register here</a>
					</div>
				</div>
			</div>
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