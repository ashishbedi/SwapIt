<?php

require 'functions.php';
session_start();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

checkValidUser($uid);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$p_name = $_POST['p_name'];
	$p_desc = $_POST['p_desc'];
	
	$conn = connect($config);

	if($conn)
	{
			// TODO: SOLVE THE ERROR
			$row = insert(
				"INSERT into product (p_name,p_desc,date_created,swapped,uid) VALUE (:p_name,:p_desc,now(),0,:uid)",
				array(	
					'p_name' =>	$p_name, 
					'p_desc' => $p_desc, 
					'uid' 	 => $uid) 
				, $conn)[0];		
	}

	header("Location: swap.php");
}

require 'addT.php';