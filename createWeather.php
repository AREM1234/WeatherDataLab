<?php 
	session_start();
	if(!isset($_SESSION["Admin"])){
		header("Location: index.php");
		die;
	}
	require_once("Models/DBConnect.php");
	require_once("Models/DBFunctions.php");

	$City = trim(filter_input(INPUT_POST, "City", FILTER_SANITIZE_STRING));
	$State = trim(filter_input(INPUT_POST, "State", FILTER_SANITIZE_STRING));
	$Date = trim(filter_input(INPUT_POST, "Date", FILTER_SANITIZE_STRING));
	$MaxTemp = trim(filter_input(INPUT_POST, "MaxTemp", FILTER_SANITIZE_STRING));
	$MinTemp = trim(filter_input(INPUT_POST, "MinTemp", FILTER_SANITIZE_STRING));
	$AverageTemp = trim(filter_input(INPUT_POST, "AverageTemp", FILTER_SANITIZE_STRING));
	$AverageWindSpeed = trim(filter_input(INPUT_POST, "AverageWindSpeed", FILTER_SANITIZE_STRING));
	$WindDirection = trim(filter_input(INPUT_POST, "WindDirection", FILTER_SANITIZE_STRING));
	$Precipitation = trim(filter_input(INPUT_POST, "Precipitation", FILTER_SANITIZE_STRING));
	$weathersConditions = $_POST['weathersConditions'];

	if(empty($City) || empty($State) || empty($Date) || (empty($MaxTemp) &&  $MaxTemp != 0) || (empty($MinTemp) &&  $AverageTemp != 0) || (empty($AverageTemp) &&  $AverageTemp != 0) || (empty($AverageWindSpeed) &&  $AverageWindSpeed != 0 )  || empty($WindDirection) || (empty($Precipitation) &&  $Precipitation != 0) ){
		header("Location: index.php");
		die;
	}

	if($MaxTemp < $MinTemp || $AverageTemp > $MaxTemp || $AverageTemp < $MinTemp){
		header("Location: addWeather.php?error=Invalid temperatures.");
		die;
	}

	$cityID = GetCityID($City)[0];

	if(empty($cityID)){
		$cityID = CreateCity($City);
	}

	$stateID = GetStateID($State)[0];

	if(empty($stateID)){
		$stateID = CreateState($State);
	}

	$locationID = GetLocationID($cityID, $stateID)[0];

	if(empty($locationID)){
		$locationID = CreateLocation($cityID, $stateID);
	}

	if(!CheckDateLocation($locationID, $Date)){
		header("Location: addWeather.php?error=Invalid Date and Location combo");
		die;
	}

	$MaxTempRef = GetNumberByID($MaxTemp)[0];

	if(empty($MaxTempRef)){
		CreateNumber($MaxTemp);
		$MaxTempRef = $MaxTemp;
	}
	
	$MinTempRef = GetNumberByID($MinTemp)[0];

	if(empty($MinTempRef)){
		CreateNumber($MinTemp);
		$MinTempRef = $MinTemp;
	}

	$AverageWindSpeedRef = GetNumberByID($AverageWindSpeed)[0];

	if(empty($AverageWindSpeedRef)){
		CreateNumber($AverageWindSpeed);
		$AverageWindSpeedRef = $AverageWindSpeed;
	}

	$AverageTempRef = GetNumberByID($AverageTemp)[0];

	if(empty($AverageTempRef)){
		CreateNumber($AverageTemp);
		$AverageTempRef = $AverageTemp;
	}

	$PrecipitationRef = GetNumberByID($Precipitation)[0];

	if(empty($PrecipitationRef)){
		CreateNumber($Precipitation);
		$PrecipitationRef = $Precipitation;
	}

	$weatherID = CreateWeather($locationID, $MinTempRef, $MaxTempRef, $AverageTempRef, $AverageWindSpeedRef, $WindDirection, $PrecipitationRef, $Date);

	foreach ($weathersConditions as $condition ) {
		CreateWeatherCondition($weatherID, $condition);
	}


	header("Location: index.php");
	
	
 ?>
	
