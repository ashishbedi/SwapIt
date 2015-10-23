<?php 

$config = array(
	'username' => 'root',
	'password' => ''
	);

function connect($config)
{
	try {
		$conn = new \PDO('mysql:host=localhost;dbname=swap',
			$config['username'],
			$config['password']);

		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	} catch(Exception $e) {
		return false;
	}
}


function query($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings);

	$results = $stmt->fetchAll();
	return $results ? $results : false;
}

function insert($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	return $stmt->execute($bindings);
}

function update($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	return $stmt->execute($bindings);
}


function get($tableName, $conn)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName");

		return ( $result->rowCount() > 0 )
		? $result
		: false;
	} catch(Exception $e) {
		return false;
	}

}

function getPUname($pid, $conn)
{
	$stmt = $conn->prepare("SELECT product.p_name,user_info.name,user_info.uid FROM product,user_info where product.pid=:pid AND product.uid=user_info.uid");
	$stmt->execute(array('pid'=>$pid));

	$result = $stmt->fetchAll();
	return $result ? $result : false;
}

function dpr($variable)
{
	die(print_r($variable));
}

function checkValidUser()
{
	if(empty($_SESSION['uid']))
		header("Location: signin.php");
}