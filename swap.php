<?php

require 'functions.php';
session_start();

$uid = $_SESSION['uid'];

if(!isset($uid))
	header("Location: signin.php");

$conn = connect($config);

if($uid === 0)
	$name='Guest';

else{
	
	$name = query("SELECT name FROM user_info WHERE uid = :uid",
		array(
			'uid' => $uid
			),
		$conn)[0][0];

	$_SESSION['name'] = $name;
}

if($conn)
{
	$row = query("SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info,product WHERE user_info.uid=product.uid AND product.swapped=0 AND user_info.uid != :uid order by product.date_created desc",
		array(
			'uid' => $uid
			),
		$conn);

	
	if(isset($_GET["p_name"]) || isset($_GET["sort"]) || isset($_GET["filter"]) )
	{
		$p_name	= (isset($_GET['p_name']) ? $_GET["p_name"] : NULL);
		$sort 	= (isset($_GET['sort']) ? $_GET["sort"] : NULL);		//0 for newest first, 1 for most favourite first
		$filter = (isset($_GET['filter']) ? $_GET["filter"] : NULL);	//0 for no filter, 1 for city, 2 for state

		if(empty($p_name))
		{
			if($sort==0 || !isset($sort))
			{
				if($filter==0 || !isset($filter)){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info,product WHERE user_info.uid=product.uid AND user_info.uid != :uid order by product.date_created desc";
				}
				elseif($filter==1){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2, loc3 WHERE user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid AND loc3.stateid in (SELECT loc3.stateid from user_info, loc1, loc2, loc3 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid) order by product.date_created desc";
				}
				else{
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2 WHERE user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.cityid in (SELECT loc2.cityid from user_info, loc1, loc2 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid) order by product.date_created desc"; 
				}
			}
			else
			{
				if($filter==0 || !isset($filter)){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info,product WHERE user_info.uid=product.uid AND user_info.uid != :uid order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc";
				}
				elseif($filter==1){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2, loc3 WHERE user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid AND loc3.stateid in (SELECT loc3.stateid from user_info, loc1, loc2, loc3 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid) order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc";
				}
				else{
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2 WHERE user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.cityid in (SELECT loc2.cityid from user_info, loc1, loc2 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid) order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc"; 
				}
			}
		}
		else
		{
			if($sort==0 || !isset($sort))
			{
				if($filter==0 || !isset($filter)){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info,product WHERE product.p_name=:p_name AND user_info.uid=product.uid AND user_info.uid != :uid order by product.date_created desc";
				}
				elseif($filter==1){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2, loc3 WHERE product.p_name=:p_name AND user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid AND loc3.stateid in (SELECT loc3.stateid from user_info, loc1, loc2, loc3 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid) order by product.date_created desc";
				}
				else{
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2 WHERE product.p_name=:p_name AND user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.cityid in (SELECT loc2.cityid from user_info, loc1, loc2 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid) order by product.date_created desc"; 
				}
			}
			else
			{
				if($filter==0 || !isset($filter)){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info,product WHERE product.p_name=:p_name AND user_info.uid=product.uid AND user_info.uid != :uid order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc";
				}
				elseif($filter==1){
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2, loc3 WHERE product.p_name=:p_name AND user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid AND loc3.stateid in (SELECT loc3.stateid from user_info, loc1, loc2, loc3 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.stateid = loc3.stateid) order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc";
				}
				else{
					$sQuery = "SELECT user_info.uid,user_info.name,product.pid,product.p_name,product.p_desc FROM user_info, product, loc1, loc2 WHERE product.p_name=:p_name AND user_info.uid = product.uid AND user_info.uid != :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid AND loc2.cityid in (SELECT loc2.cityid from user_info, loc1, loc2 where user_info.uid = :uid AND user_info.zip = loc1.zip AND loc1.cityid = loc2.cityid) order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc"; 
				}
			}
		}

		$row = query($sQuery,array ('p_name'=> $p_name,'uid'=>$uid),$conn);


	}
}

			// $fav = $_POST;
try {
	if(isset($_POST['fav'])){

		if($conn){
			insert(
				"INSERT into favourite (uid,pid,create_date) VALUE (:uid,:pid,now())",
				array(	
					'pid' => $_POST['fav'],
					'uid' => $uid) 
				, $conn)[0];
		}
	}
}
catch (Exception $e) {

	if ($uid == 0) {

		echo("<script>alert('You are not logined. Please login to favourite product.');</script>");
		
	}

	
}

if(isset($_POST['swap'])){

	if ($uid == 0) {

		echo("<script>alert('You are not logined. Please login to swap.');</script>");

	}		

	else {

		$_SESSION['pid'] = $_POST['swap'];
		header("Location: request.php");
	}
}

if(isset($_POST['puid'])){

	$puid = $_POST['puid'];
	header("Location: user.php?id=".$puid);
}


require 'swapT.php';
