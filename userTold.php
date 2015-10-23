
<!DOCTYPE html>
<html>
<head>
	<title>
		swapIt
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
	<!-- <link href="styles.css" type="text/css" rel="stylesheet"/>  -->
	<meta name="viewport" content="width=device-width, initial-scale=1"/>



	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font.css"> -->

</head>
<body>
	

	
		<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="row panel">
				<div class="col-md-4 bg_blur ">
					<!-- <a href="#" class="follow_btn hidden-xs">Follow</a> -->
				</div>
				<div class="col-md-8  col-xs-12">
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
					<div class="header">
						<h1><?=$uid?> : <?=$row[0]?></h1>
						<h2><?=$row[6]?></h2> 
						<h4>dob= <?=$row[1]?></h4> 
						<h4>phone= <?=$row[3]?></h4> 
						<h4>email= <?=$row[2]?></h4> 
						<h4>address= <?=$row[4]?></h4>
						<h4>zip= <?=$row[5]?></h4>
					</div>
				</div>
			</div> 
		</div>
		<br>
		<br>
		<div>
			<h1><b><u>Notifications</h1></u></b>
		    <h2>Incoming Unseen</h2>
		    <!-- TODO sksq Button to accept the reqeust -->
		    <?php 

	
	

	foreach ($notif1 as $key => $value) {
		# code...


		?>	


		<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="row panel">
				<div class="col-md-4 bg_blur ">
					<!-- <a href="#" class="follow_btn hidden-xs">Follow</a> -->
				</div>
				<div class="col-md-8  col-xs-12">
					<!-- <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
					 -->
                    <!--  ankush's product has pid2=1 and he wants to exchange your product with pid1=4 with his. -->
					 <div class="header">
						<h1>pid=<?=$value[1]?></h1>
						<h4>date=<?=$value[3]?></h4> 
						<span>
							state=<?=$value[0]?> for=<?=$value[2]?>
						</span>
					</div>
				</div>
			</div>   

			

		<!-- <div class="row nav">    
			<div class="col-md-4"></div>
			<div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-weixin fa-lg"></i> 16</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-heart-o fa-lg"></i> 14</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
			</div>
		</div> -->
	</div>

	<?php }?>
	
		    <h2>Outgoing Unseen</h2>
		    <?php 

	
	

	foreach ($notif2 as $key => $value) {
		# code...


		?>	


		<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="row panel">
				<div class="col-md-4 bg_blur ">
					<!-- <a href="#" class="follow_btn hidden-xs">Follow</a> -->
				</div>
				<div class="col-md-8  col-xs-12">
					<!-- <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
					 -->
                    <!--  ankush's product has pid2=1 and he wants to exchange your product with pid1=4 with his. -->
					 <div class="header">
						<h1>pid=<?=$value[2]?></h1>
						<h4>date=<?=$value[3]?></h4> 
						<span>
							state=<?=$value[0]?> with=<?=$value[1]?>
						</span>
					</div>
				</div>
			</div>   

			

		<!-- <div class="row nav">    
			<div class="col-md-4"></div>
			<div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-weixin fa-lg"></i> 16</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-heart-o fa-lg"></i> 14</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
			</div>
		</div> -->
	</div>

	<?php }?>
		    <h2>Incoming All</h2>
		    <?php 

	
	

	foreach ($notif3 as $key => $value) {
		# code...


		?>	


		<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="row panel">
				<div class="col-md-4 bg_blur ">
					<!-- <a href="#" class="follow_btn hidden-xs">Follow</a> -->
				</div>
				<div class="col-md-8  col-xs-12">
					<!-- <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
					 -->
                    <!--  ankush's product has pid2=1 and he wants to exchange your product with pid1=4 with his. -->
					 <div class="header">
						<h1>pid=<?=$value[1]?></h1>
						<h4>date=<?=$value[3]?></h4> 
						<span>
							state=<?=$value[0]?> for=<?=$value[2]?>
						</span>
					</div>
				</div>
			</div>   

			

		<!-- <div class="row nav">    
			<div class="col-md-4"></div>
			<div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-weixin fa-lg"></i> 16</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-heart-o fa-lg"></i> 14</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
			</div>
		</div> -->
	</div>

	<?php }?>
		    <h2>Outgoing All</h2>
		    <?php 

	
	

	foreach ($notif4 as $key => $value) {
		# code...


		?>	


		<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="row panel">
				<div class="col-md-4 bg_blur ">
					<!-- <a href="#" class="follow_btn hidden-xs">Follow</a> -->
				</div>
				<div class="col-md-8  col-xs-12">
					<!-- <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
					<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
					 -->
                    <!--  ankush's product has pid2=1 and he wants to exchange your product with pid1=4 with his. -->
					 <div class="header">
						<h1>pid=<?=$value[2]?></h1>
						<h4>date=<?=$value[3]?></h4> 
						<span>
							state=<?=$value[0]?> with=<?=$value[1]?>
						</span>
					</div>
				</div>
			</div>   

			

		<!-- <div class="row nav">    
			<div class="col-md-4"></div>
			<div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-weixin fa-lg"></i> 16</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-heart-o fa-lg"></i> 14</div>
				<div class="col-md-4 col-xs-4 well"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
			</div>
		</div> -->
	</div>

	<?php }?>

				<input type="button" value="Mark all as read." class="btn btn-danger btn-lg" />
				

</body>

</html>
