<?php

require 'functions.php';
session_start();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

checkValidUser($uid);

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

	/*Incoming unseen */ 
	$notifIn = query("SELECT distinct request.pid2,request.pid1,request.update_date from request,user_info,product where product.uid=user_info.uid AND request.pid1 in (SELECT product.pid from product where product.uid=:uid) AND request.state=0 AND user_info.uid=:uid order by request.update_date desc",
		array('uid'=>$uid),
		$conn);

	/* Outgoing all */ 
	$notifOut =  query("SELECT request.state,request.pid1,request.pid2,request.update_date from request,user_info,product where product.uid=user_info.uid AND request.pid2=product.pid AND user_info.uid=:uid",
		array('uid'=>$uid),
		$conn);

	// die(print_r($notifOut));

	if(isset($_POST['accept'])){
		
		$accept = explode('.', $_POST['accept']);
		
		 //die(print_r($accept));

		update("UPDATE request SET state = -1 , update_date=now() where pid1 = :pid2 OR pid2 = :pid2",
			array('pid2' => $accept[1]),
			$conn);

		update("UPDATE request SET state = -1 , update_date=now() where pid1 = :pid2 OR pid2 = :pid2",
			array('pid2' => $accept[0]),
			$conn);

		update("UPDATE request SET state = 1 , update_date=now() where pid1 = :pid2 AND pid2 = :pid1",
			array(
				'pid2' => $accept[1],
				'pid1' => $accept[0]),
			$conn);		

		update("UPDATE product SET swapped = 1 where pid=:pid1 OR pid=:pid2",
			array(	'pid1' => $accept[0],
					'pid2' => $accept[1]),
			$conn);


		$fuid = getPUname($accept[0],$conn)[0][2];
		insert("INSERT INTO buddy VALUE(:fuid,:uid)",array('fuid'=>$fuid,'uid'=>$uid),$conn);
		
		$url = "user.php?id=".$fuid;
		echo "<script>
			alert('SWAP Confirmed. Meet your SWAP buddy');</script>";
		header("refresh:1; url=".$url);
		// dpr($url);
		/*echo "<script>
			alert('Request Confirmed. Please contact the following user');
			document.location=".$url.";</script>";*/
		
	}

		if(isset($_POST['decline'])){
		
		$accept = explode('.', $_POST['decline']);

		update("UPDATE request SET state = -1 , update_date=now() where pid1 = :pid2 AND pid2 = :pid1",
			array(
				'pid2' => $accept[1],
				'pid1' => $accept[0]),
			$conn);		

		header("Location: notification.php");

	}


}

require 'notificationT.php';