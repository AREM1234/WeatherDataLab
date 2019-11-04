<?php 
	session_start();
	include("Views/header.php");

	
 ?>
	
<div class="row">
	<div class="col s12 m10 offset-m1">		
		<div class="col s12 m8 offset-m2">
			<?php if(isset($_GET['error'])): ?>
			<?php echo $_GET['error']; ?>
			<?php endif;?>
			<div class="card white">
				<div class="card-content black-text">
					<h5>Login</h5>
					<hr />

					<form action="authenticate.php" method="post">

						<label class="black-text">Username</label>
						<input type="text" name="adminName" required />

						<label class="black-text">Password</label>
						<input type="Password" name="Password" required />

						<a href="index.php" class="waves-effect waves-light btn">Back</a>
						<button class="btn waves-effect waves-light right" type="submit" name="action">Login
							<i class="material-icons right">send</i>
						</button>

					</form>					
				</div>
			</div>
		</div>
	</div>
</div>

			
<?php include("Views/footer.php"); ?>