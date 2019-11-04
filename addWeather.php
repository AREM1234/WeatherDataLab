<?php 
	session_start();
	if(!isset($_SESSION["Admin"])){
		header("Location: index.php");
		die;
	}
	include("Views/header.php");
	include("Models/DBConnect.php");
	include("Models/DBFunctions.php");

	$directions = GetWindDirections();
	$conditions = GetConditions();



 ?>

<div class="row">
	<div class="col s12 m10 offset-m1">		
		<div class="col s12 m8 offset-m2">
			<?php if(isset($_GET['error'])): ?>
			<?php echo $_GET['error']; ?>
			<?php endif;?>
			<div class="card white">
				<div class="card-content black-text">
					<h5>Add Weather</h5>
					<hr />

					<form action="createWeather.php" method="post">

						<label class="black-text">City</label>
						<input type="text" name="City" maxlength="60" required />

						<label class="black-text">State</label>
						<input type="text" name="State" maxlength="2" required />

						<label class="black-text">Date</label>
						<input type="date" name="Date" required />

						<label class="black-text">Max Temperature</label>
						<input type="number" name="MaxTemp" required step="0.01" />

						<label class="black-text">Min Temperature</label>
						<input type="number" name="MinTemp" required step="0.01" />

						<label class="black-text">Average Temperature</label>
						<input type="number" name="AverageTemp" required step="0.01" />

						<label class="black-text">Average Wind Speed</label>
						<input type="number" name="AverageWindSpeed" required step="0.01" />

						<label class="black-text">Wind Direction</label>
						<select name="WindDirection" class="browser-default">
							<?php foreach($directions as $direction): ?>
								<option value="<?php echo $direction['DirectionID']; ?>"><?php echo $direction['Direction']; ?></option>
							<?php endforeach; ?>
						</select>

						<label class="black-text">Precipitation</label>
						<input type="number" name="Precipitation" required step="0.01" />

						<label class="black-text">Conditions</label>
						<br/>
						<?php foreach($conditions as $condition): ?>
							<label class="black-text">
								<input type="checkbox" name="weathersConditions[]" value="<?php echo $condition['ConditionID'] ?>" />
								<span><?php echo $condition['ConditionType'] ?></span>
							</label>
							<br />
						<?php endforeach; ?>



						<a href="index.php" class="waves-effect waves-light btn">Back</a>
						<button class="btn waves-effect waves-light right" type="submit" name="action">Add Weather
							<i class="material-icons right">send</i>
						</button>

					</form>					
				</div>
			</div>
		</div>
	</div>
</div>




<?php include("Views/footer.php"); ?>