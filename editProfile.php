<?php

require 'functions.php';
session_start();

$uid = $_SESSION['uid'];

checkValidUser($uid);

$conn = connect($config);

if($conn)
{

	$user_info = query(
		"SELECT bio,dob,email,phone_number,address,zip FROM user_info WHERE uid = :uid",
		array(
			'uid'	=> $uid)
		,$conn)[0];

	// dpr($user_info);

}


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$bio 		= $_POST['bio'];
	$dob 		= $_POST['dob'];
	$email 	   	= $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address	= $_POST['address'];
	$zip		= $_POST['zip'];

	

	if($conn)
	{

		
		try {



			$insert_info = UPDATE(
				"UPDATE  user_info SET dob = :dob,email = :email,phone_number = :phone_number,address = :address,zip = :zip,bio = :bio WHERE uid=:uid",
				array(	
					'uid'			=>	$uid,
					'bio'			=>	$bio,
					'dob'			=>	$dob,
					'email'			=>	$email,
					'phone_number'	=>	$phone_number,
					'address'		=>	$address,
					'zip'			=>	$zip
					)
				,$conn)[0];

			header("Location: swap.php");

		}
		catch (Exception $e) {


			echo "<script>alert('Invalid zip code. Service does not exist');</script>";

		}
	}
}

require 'editProfileT.php';
