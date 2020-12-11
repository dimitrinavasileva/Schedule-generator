	
<?php require "../templates/start.php"; ?>

	<h1>Login/Register</h1>

	<form method="POST" action="post.php">

		<label for="login_name">Username:</label>
		<input id="login_name" name="login_name" type="text" />
		<br>
		<br>
		<label for="login_password">Password:</label>
		<input id="login_password" name="login_password" type="password" />
		<br>
		<br>
		<input type="submit" name="button_login" value="Sign in" />
		<input type="submit" name="button_register" value="Register"/>
	</form>

<?php require "../templates/end.php"; ?>