<?php session_start(); ?>

<?php require "../templates/start.php"; ?>

	<div style="margin-left:80px; margin-top:20px;">
	<h2>Login/Register</h2>
	
	<form method="POST" action="post.php" style="margin-top:30px;">

		<label for="login_name">Username:</label>
		<input id="login_name" name="login_name" type="text" />
		<br>
		<br>
		<label for="login_password">Password:</label>
		<input id="login_password" name="login_password" type="password" />
		<br><br>
		<br>
		<input type="submit" name="button_login" value="Sign in" style="margin-left:45px; font-size:18px;"/>
		<input type="submit" name="button_register" value="Register" style="margin-left:20px; font-size:18px;"//>
		
		<?php
			if(isset($_SESSION["error"])){
				$error = $_SESSION["error"];
				echo "<span>$error</span>";
			}
        ?> 
	</form>
	</div>
<?php require "../templates/end.php"; ?>