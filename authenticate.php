<?php 
	session_start();
	require_once("Models/DBConnect.php");
	require_once("Models/Admins.php");

	$adminName = trim(filter_input(INPUT_POST, "adminName", FILTER_SANITIZE_STRING));
	$password = trim(filter_input(INPUT_POST, "Password", FILTER_SANITIZE_STRING));

	if(empty($adminName) || empty($password)){
		header("Location: ../index.php");
		die;
	}

	$admin = Login($adminName, $password);

	$_SESSION["Admin"] = $admin['AdminName'];

	header("Location: index.php");
	
 ?>
	
