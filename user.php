<?php

require 'functions.php';
session_start();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

if(empty($_SESSION['uid']))
	header("Location: signin.php");

if(isset($_GET['id']))
{	
	$uid=$_GET['id'];
}


$conn = connect($config);
if($conn)
{

	if(isset($_GET["p_name"]) || isset($_GET["sort"]) || isset($_GET["filter"]))
	{
		$p_name	= (isset($_GET['p_name']) ? $_GET["p_name"] : NULL);
		$sort 	= (isset($_GET['sort']) ? $_GET["sort"] : NULL);		//0 for newest first, 1 for most favourite first
		$filter = (isset($_GET['filter']) ? $_GET["filter"] : NULL);	//0 for no filter, 1 for city, 2 for state

		header("Location: swap.php?filter=".$filter."&p_name=".$p_name);
	}

	$user_info = query(
		"SELECT name,dob,email,phone_number,address,zip,bio from user_info WHERE uid=:uid",
		array('uid'=>$uid),	
		$conn)[0];

	// die(print_r($user_info));

	$my_products = query("SELECT p_name,p_desc FROM product WHERE uid = :uid AND swapped = 0 order by date_created desc",
		array('uid' => $uid),
		$conn);

	// die(print_r($my_products));

	$barters = query("SELECT request.pid1,request.pid2,request.update_date from request where request.state=1 AND (request.pid1 in (SELECT product.pid from product where product.uid=:uid) OR request.pid2 in (SELECT product.pid from product where product.uid=:uid)) order by request.update_date desc",
		array('uid' => $uid),
		$conn);
	
	//dpr($barters);

}

require 'userT.php';
