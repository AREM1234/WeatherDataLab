<?php 
	session_start();
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

	if(empty($City) || empty($State) || empty($Date) || empty($MaxTemp) || empty($MinTemp) || empty($AverageTemp) || empty($AverageWindSpeed)  || empty($WindDirection) || empty($Precipitation)){
		header("Location: index.php");
		die;
	}



	$cityID = GetCityID($City);

	if(empty($cityID[0])){
		$cityID = CreateCity($City);
	}

	$stateID = GetStateID($State);

	if(empty($stateID[0])){
		$stateID = CreateState($State);
	}

	$locationID = GetLocationID($cityID[0], $stateID[0]);

	if(empty($locationID[0])){
		$locationID = CreateLocation($cityID[0], $stateID[0]);
	}

	if(!CheckDateLocation($locationID[0], $Date)){
		header("Location: addWeather.php?error=Invalid Date and Location combo");
		die;
	}

	$MaxTempRef = GetNumberByID($MaxTemp);

	if(empty($MaxTempRef[0])){
		CreateNumber($MaxTemp);
		$MaxTempRef = $MaxTemp;
	}

	$MinTempRef = GetNumberByID($MinTemp);

	if(empty($MinTempRef[0])){
		CreateNumber($MinTemp);
		$MinTempRef = $MinTemp;
	}

	$AverageWindSpeedRef = GetNumberByID($AverageWindSpeed);

	if(empty($AverageWindSpeedRef[0])){
		CreateNumber($AverageWindSpeed);
		$AverageWindSpeedRef = $AverageWindSpeed;
	}

	$AverageTempRef = GetNumberByID($AverageTemp);

	if(empty($AverageTempRef[0])){
		CreateNumber($AverageTemp);
		$AverageTempRef = $AverageTemp;
	}

	$PrecipitationRef = GetNumberByID($Precipitation);

	if(empty($PrecipitationRef[0])){
		CreateNumber($Precipitation);
		$PrecipitationRef = $Precipitation;
	}

	$weatherID = CreateWeather($locationID[0], $MinTempRef[0], $MaxTempRef[0], $AverageTempRef[0], $AverageWindSpeedRef[0], $WindDirection, $PrecipitationRef[0], $Date);

	foreach ($weathersConditions as $condition ) {
		CreateWeatherCondition($weatherID, $condition);
	}


	header("Location: index.php");
	
 ?>
	
