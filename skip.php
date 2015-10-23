<?php

session_start();
$uid = $_SESSION['uid'] = 0;

header("Location: swap.php");

?>