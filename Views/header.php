<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Weather Data</title>
	<link rel="stylesheet" type="text/css" href="css\materialize.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<nav class="white">
			<div class="nav-wrapper">
				<?php if(isset($_SESSION["Admin"])): ?>
					<ul class="left hide-on-med-and-down">
						<li ><a href="addWeather.php" class="black-text">Add Weather</a></li>
					</ul>
					<ul class="right hide-on-med-and-down">
						<li ><a href="logout.php" class="black-text">Logout</a></li>
					</ul>
				<?php else: ?>
					<ul class="right hide-on-med-and-down">
						<li ><a href="login.php" class="black-text">Admin Login</a></li>
					</ul>
				<?php endif; ?>
			</div>
		</nav>
		<main>