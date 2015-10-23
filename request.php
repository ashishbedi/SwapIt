<?php
require 'functions.php';
session_start();

$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];
$name = $_SESSION['name'];

checkValidUser($uid);

$conn = connect($config);

if($conn){
	$row = query("SELECT product.pid,product.p_name,product.p_desc,product.date_created FROM product WHERE product.uid=:uid AND product.swapped=0 order by product.date_created desc",
		array('uid'=>$uid),
		$conn);
}


if($_SERVER['REQUEST_METHOD'] == 'POST')
{


	try
	{
		$row = insert(
			"INSERT into request (pid1,pid2,state,update_date) VALUE (:pid1,:pid2,0,now())",
			array(	
				'pid1' =>	$pid, 
				'pid2' => 	$_POST['value']
				)	 
			, $conn)[0];		



		header("Location: swap.php");
	}

	catch (Exception $e) {
		echo("<script>alert('You have already requested for this product.');</script>");

	}

}

//@SKSQ make requestT and give checkbox to select items and then submit them redirecting to new php page.
require 'requestT.php';

?>