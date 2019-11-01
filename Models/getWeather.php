<?php

	session_start();

	include("DBConnect.php");

	if(isset($_GET['filterParams'])){
		$filterParams = json_decode($_GET['filterParams'], true);
	}
	if(isset($_GET['sortParams'])){
		$sortParams = json_decode($_GET['sortParams'], true);
	}

	if(isset($_GET['sortOrders'])){
		$sortOrders = json_decode($_GET['sortOrders'], true);
	}

	if($_GET['conditionFilters'] != ""){
		$condition = $_GET['conditionFilters'];
	}
	else{
		$condition = "";
	}


	function GetWeather($filterParams, $sortParams, $sortOrders, $condition){
		global $db;

		$sql = "SELECT WeatherID, MaxTemp, MinTemp, AverageTemp, Date, AverageWindSpeed, direction.Direction, Precipitation,
								 state.StateName, city.CityName
								FROM weather
								INNER JOIN direction ON direction.DirectionID = weather.WindDirection
								INNER JOIN location ON location.LocationID = weather.Location
								INNER JOIN state ON state.StateID = location.State
								INNER JOIN city ON city.CityID = location.city ";
		if($condition != ""){
			$sql .= "INNER JOIN weathersconditions ON weathersconditions.Weather = weather.WeatherID  
					INNER JOIN conditions ON conditions.ConditionID = weathersconditions.WeatherCondition ";
		}

		$sql .= "WHERE WeatherID IS NOT NULL ";

		if($condition != ""){
			$sql .= "AND conditions.ConditionType LIKE :Condition ";
		}

		if(count($filterParams) > 0){
			for($j = 0; $j < count($filterParams); $j+=2){
				if($filterParams[$j+1] != ""){
					$sql .= "AND " . $filterParams[$j] . " LIKE :" . $filterParams[$j] . " ";
				}
			}
		}

		$sql .= "ORDER BY ";

		if(count($sortParams) > 0){
			for($i = 0; $i < count($sortParams); $i++){
				$sql .= $sortParams[$i] . " " . $sortOrders[$i] . ", ";
			}
		}

		$sql .= " WeatherID ASC";

		$query = $db->prepare($sql);

		if(count($filterParams) > 0){
			for($j = 1; $j < count($filterParams); $j+=2){
				if($filterParams[$j] != ""){
					$query->bindValue($filterParams[$j-1], "%".$filterParams[$j]."%");
				}
			}
		}
		
		if($condition != ""){
			$query->bindValue(":Condition", "%".$condition."%");
		}

		$query->execute();

		$result = $query->fetchall();

		return $result;
	}

	function GetWeatherConditions($weatherID){

		global $db;

		$query = $db->prepare("SELECT conditions.ConditionType
								FROM weathersconditions
								INNER JOIN conditions ON weathersconditions.WeatherCondition = conditions.ConditionID
								WHERE Weather = $weatherID;");
		$query->execute();

		$result = $query->fetchall();

		return $result;

	}

	

	
	$theWeather = GetWeather($filterParams, $sortParams, $sortOrders, $condition);
	
	

?>


<?php foreach($theWeather as $weather): ?>

<tr>
	<td>
		<?php echo $weather['CityName'] . ", " . $weather['StateName']; ?>
	</td>
	<td>
		<?php echo $weather['Date']; ?>
	</td>
	<td>
		<?php echo $weather['MaxTemp']; ?> &#176;F
	</td>
	<td>
		<?php echo $weather['MinTemp']; ?> &#176;F
	</td>
	<td>
		<?php echo $weather['AverageTemp']; ?> &#176;F
	</td>
	<td>
		<?php echo $weather['AverageWindSpeed']; ?> MPH
	</td>
	<td>
		<?php echo $weather['Direction']; ?> 
	</td>
	<td>
		<?php echo $weather['Precipitation']; ?> in
	</td>

	<td>
		<?php $weathersConditions = GetWeatherConditions($weather['WeatherID']); ?>
		<?php foreach($weathersConditions as $condition): ?>
			<?php echo $condition['ConditionType'] . "<br />"; ?>
		<?php endforeach;?>
	</td>
	<?php if(isset($_SESSION["Admin"])): ?>
		<td>
			<a href="deleteWeather&weatherID=<?php echo $weather['WeatherID'];?>">Delete</a>
		</td>
	<?php endif; ?>
</tr>


<?php endforeach; ?>

