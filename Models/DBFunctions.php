<?php 

function GetWindDirections(){

	global $db;

	$query = $db->prepare("SELECT * FROM direction");
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function GetConditions(){

	global $db;

	$query = $db->prepare("SELECT * FROM conditions");
	$query->execute();

	$result = $query->fetchall();

	return $result;

}

function GetCityID($cityName){

	global $db;

	$query = $db->prepare("SELECT CityID FROM city
							WHERE CityName = :CityName");

	$query->bindParam(":CityName", $cityName);

	$query->execute();

	$result = $query->fetch();

	return $result;

}

function CreateCity($cityName){

	global $db;

	$query = $db->prepare("INSERT INTO city (CityName)
							VALUES (:CityName)");

	$query->bindParam(":CityName", $cityName);

	$query->execute();

	$id = $db->lastInsertId();

	return $id;

}

function GetStateID($stateName){

	global $db;

	$query = $db->prepare("SELECT StateID FROM state
							WHERE StateName = :StateName");

	$query->bindParam(":StateName", $stateName);

	$query->execute();

	$result = $query->fetch();

	return $result;

}

function CreateState($stateName){

	global $db;

	$query = $db->prepare("INSERT INTO state (StateName)
							VALUES (:StateName)");

	$query->bindParam(":StateName", $stateName);

	$query->execute();

	$id = $db->lastInsertId();

	return $id;

}


function GetLocationID($cityID, $stateID){

	global $db;

	$query = $db->prepare("SELECT LocationID FROM location
							WHERE City = :cityID AND State = :stateID");

	$query->bindParam(":cityID", $cityID);
	$query->bindParam(":stateID", $stateID);

	$query->execute();

	$result = $query->fetch();

	return $result;

}

function CreateLocation($cityID, $stateID){

	global $db;

	$query = $db->prepare("INSERT INTO location (City, State)
							VALUES (:cityID, :stateID)");

	$query->bindParam(":cityID", $cityID);
	$query->bindParam(":stateID", $stateID);

	$query->execute();

	$id = $db->lastInsertId();

	return $id;

}

function GetNumberByID($num){

	global $db;

	$query = $db->prepare("SELECT Number FROM numbers
							WHERE Number = :num");

	$query->bindParam(":num", $num);

	$query->execute();

	$result = $query->fetch();

	return $result;

}

function CreateNumber($num){

	global $db;

	$query = $db->prepare("INSERT INTO numbers (Number)
							VALUES (:num)");

	$query->bindParam(":num", $num);

	$query->execute();

}

function CreateWeather($locationID, $MinTemp, $MaxTemp, $AverageTemp, $AverageWindSpeed, $WindDirection, $Precipitation, $Date){

	global $db;

	$query = $db->prepare("INSERT INTO weather (Location, MinTemp, MaxTemp, AverageTemp, AverageWindSpeed, WindDirection, Precipitation, Date)
							VALUES (:locationID, :MinTemp, :MaxTemp, :AverageTemp, :AverageWindSpeed, :WindDirection, :Precipitation, :Date)");

	$query->bindParam(":locationID", $locationID);
	$query->bindParam(":MinTemp", $MinTemp);
	$query->bindParam(":MaxTemp", $MaxTemp);
	$query->bindParam(":AverageTemp", $AverageTemp);
	$query->bindParam(":AverageWindSpeed", $AverageWindSpeed);
	$query->bindParam(":WindDirection", $WindDirection);
	$query->bindParam(":Precipitation", $Precipitation);
	$query->bindParam(":Date", $Date);

	$query->execute();

	$id = $db->lastInsertId();

	return $id;

}

function CreateWeatherCondition($weatherID, $conditionID){

	global $db;

	$query = $db->prepare("INSERT INTO weathersconditions (Weather, WeatherCondition)
							VALUES (:weatherID, :conditionID)");

	$query->bindParam(":weatherID", $weatherID);
	$query->bindParam(":conditionID", $conditionID);

	$query->execute();


}

function CheckDateLocation($locationID, $date){

	global $db;

	$query = $db->prepare("SELECT WeatherID FROM weather
							WHERE Location = :locationID AND Date = :date");

	$query->bindParam(":locationID", $locationID);
	$query->bindParam(":date", $date);

	$query->execute();

	$result = $query->fetch();

	if(empty($result[0])){
		return true;
	}
	else{
		return false;
	}

}




?>