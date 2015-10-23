<?php
require 'functions.php';
session_start();

$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];


if($uid==0)
	header("Location: signin.php");
$conn = connect($config);
if($conn){
	$row = insert(
		"INSERT into favourite (uid,pid,create_date) VALUE (:uid,:pid,now())",
		array(	
			'pid' => $pid, 
			'uid' => $uid) 
		, $conn)[0];
}
header("Location: swap.php");

?>