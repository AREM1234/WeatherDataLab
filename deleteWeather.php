<?php 
	session_start();
	require_once("Models/DBConnect.php");
	require_once("Models/DBFunctions.php");
	if(!isset($_SESSION["Admin"])){
		header("Location: index.php");
		die;
	}

	if(isset($_GET['weatherID'])){
		$weatherID = $_GET['weatherID'];
	}
	else{
		header("Location: index.php");
		die;
	}

	DeleteWeatherConditions($weatherID);
	DeleteWeather($weatherID);

	header("Location: index.php");
	die;

?>