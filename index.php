<?php 
	session_start();
	include("Views/header.php");
 ?>


	
<div class="row">
	<div class="col s12 m10 offset-m1">
		<h5>Weather Data</h5>
		<hr />
		<div class="row" >
			<form action="#" id="searchForm">
				<div class="col s2">
					<label class="black-text">City</label>
					<input type="text" id="CitySearch"/>
				</div>

				<div class="col s2">
					<label class="black-text">State</label>
					<input type="text" id="StateSearch"/>
				</div>

				<div class="col s2">
					<label class="black-text">Date</label>
					<input type="text" id="DateSearch"/>
				</div>

				<div class="col s2">
					<label class="black-text">Condition</label>
					<input type="text" id="ConditionSearch"/>
				</div>


				<div class="col s2">
					<a class="waves-effect waves-light btn" id="search">Search</a>
					<a class="waves-effect waves-light btn red" id="clear">Clear Sorting</a>
				</div>

			</form>
		</div>
		<div class="row">
			<table class="responsive-table">
				<thead>
					<tr>
						<th>
							Location
						</th>
						<th>
							<a href="#" id="dateBtn" >Date <i class="material-icons tiny" id="DateIcon"></i></a>
						</th>
						<th>
							<a href="#" id="maxTempBtn" >Max Temperature <i class="material-icons tiny" id="MaxTempIcon"></i></a>
						</th>
						<th>
							<a href="#" id="minTempBtn" >Min Temperature <i class="material-icons tiny" id="MinTempIcon"></i></a>
						</th>
						<th>
							<a href="#" id="averageTempBtn" >Average Temperature <i class="material-icons tiny" id="AverageTempIcon"></i></a>
						</th>
						<th>
							<a href="#" id="avWindSpeedBtn" >Average Wind Speed <i class="material-icons tiny" id="AverageWindSpeedIcon"></i></a>
						</th>
						<th>
							Wind Direction
						</th>
						<th>
							<a href="#" id="precipitationBtn" >Precipitation <i class="material-icons tiny" id="PrecipitationIcon"></i></a>
						</th>
						<th>
							Conditions
						</th>
						<?php if(isset($_SESSION["Admin"])): ?>
							<th>
								Delete
							</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody id="tableBody">
					
				</tbody>							
			</table>
		</div>
	</div>
</div>
<script src="js/getData.js"></script>		
<?php include("Views/footer.php"); ?>