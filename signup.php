<?php

require 'functions.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$name  		= $_POST['name'];
	$user_name 	= $_POST['user_name'];
	$bio 	= $_POST['bio'];
	$pwd 	   	= $_POST['pwd'];
	$dob 		= $_POST['dob'];
	$email 	   	= $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address	= $_POST['address'];
	$zip		= $_POST['zip'];

	$conn = connect($config);

	if($conn)
	{
		//Checking whether user_name already exists
		$row = query(
			"SELECT * FROM user_auth WHERE user_name = :user_name",
			array('user_name'		=>	$user_name)
			,$conn)[0];

		if(!empty($row))
		{
			echo "<script>alert('User name exists. Sign up with another.');</script>";
		}


		
		try {

		//Inserting in user_auth and getting uid and then inserting in user_info
			$insert_auth = insert(
				"INSERT into user_auth (user_name,pwd) VALUE (:user_name,:pwd)",
				array(	
					'user_name'		=>	$user_name,
					'pwd'			=>	$pwd),
				$conn)[0];

		// die(print_r($insert_auth));

			$uid = query(
				"SELECT uid FROM user_auth WHERE user_name = :user_name",
				array(	
					'user_name'		=>	$user_name),
				$conn)[0][0];



		// die($uid);

		//TODO: IMPLEMENT ZIP CHECK => IF NOT IN LOC1
			$insert_info = insert(
				"INSERT into user_info (uid,name,dob,email,phone_number,address,zip,bio) VALUE (:uid,:name,:dob,:email,:phone_number,:address,:zip,:bio)",
				array(	
					'uid'			=>	$uid,
					'name'			=>	$name,
					'dob'			=>	$dob,
					'email'			=>	$email,
					'phone_number'	=>	$phone_number,
					'address'		=>	$address,
					'zip'			=>	$zip,
					'bio'			=>	$bio
					)
				,$conn)[0];


			$_SESSION['uid'] = $uid;
			header("Location: swap.php");

		}
		catch (Exception $e) {


			echo "<script>alert('Invalid zip code. Service does not exist');</script>";

		}
	}
}

require 'signupT.php';
