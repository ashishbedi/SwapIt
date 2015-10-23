<?php

require 'functions.php';
session_start();

if(!empty($_SESSION['uid'])){
	header("Location: swap.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$user_name = $_POST['user_name'];
	$pwd 	   = $_POST['pwd'];

	$conn = connect($config);

	if($conn)
	{
		$row = query("SELECT uid,pwd FROM user_auth WHERE user_name = :user_name",
						array('user_name' => $user_name),
						$conn)[0];

		if(empty($row))
		{
			echo("<script>alert('Invalid user name.');</script>");
			// die();
			// header('Location: '.$_SERVER['PHP_SELF']);
		}

		// die(print_r($row[1]));

		if($row[1] === $pwd)
		{
			$uid = query(
			"SELECT uid FROM user_auth WHERE user_name = :user_name",
			array(	'user_name'		=>	$user_name)
			,$conn)[0][0];

			// die(print_r($uid));

			$_SESSION['uid'] = $uid;
			header("Location: swap.php");
		}
		else
			echo("<script>alert('Wrong password.');</script>");
	}
}

require 'signinT.php';