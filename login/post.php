<?php 

	// - $username and $password are from the config.php file and are for the database
	// - $user and $pass are for the login form.
	
	if($_POST) {
        $user = isset($_POST["login_name"]) ? triminput($_POST["login_name"]) : "";
        $pass = isset($_POST["login_password"]) ? trimInput($_POST["login_password"]) : "";
		$submit_type = isset($_POST["button_login"]) ? "login" : "register";
		
		checkInput($user, $pass);
		
		if(strcmp($submit_type, "login")==0) login($user, $pass);
		else register($user, $pass);
		
	}
	
	// Function for login
	function login($user, $pass)
	{
		require "../config.php";
		$connection = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
		
		$sql = "SELECT * FROM users WHERE username = '$user'";
        $statement = $connection->prepare($sql);
        $statement->execute();

		// Get the db user with the same username
        $db_user = $statement->fetch(PDO::FETCH_ASSOC);
		if(empty($db_user))
		{
			header('Refresh: 3; URL=./login.php'); 
			echo "Incorrect username!"; 
			echo "<br>";
			echo "Redirecting to login page...";
			exit();
		}
		$correct_pass = password_verify($pass, $db_user['password']);
		
		if($correct_pass)
		{
			session_start();
			$_SESSION['username'] = $user;
			header('Location:../initial_page.php'); 
			exit();
		}
		else
		{
			header('Refresh: 3; URL=./login.php'); 
			echo "Incorrect username or password!"; 
			echo "<br>";
			echo "Redirecting to login page...";
			exit();
		}		
	}
	
	// Function for registration 
	function register($user, $pass)
	{
		require "../config.php";
		$connection = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
		
		$sql = "SELECT * FROM users WHERE username='$user'";
		$res = $connection->query($sql);
		
		if($res->rowCount()>0) {
				header('Refresh: 3; URL=./login.php'); 
				echo "Username already taken!"; 
				echo "<br>";
				echo "Redirecting to login page...";
				exit();
		}
		else{
			// hashing the password
			$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
			$query = "INSERT INTO users (username, password) 
				  VALUES ('$user', '$hashed_pass')";
			$connection->query($query);
			session_start();
			$_SESSION['username'] = $user;
			header('Location:../initial_page.php'); 
			exit();
		}
	}
	
	// Trim unwanted characters from input
	function trimInput($input) {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);

        return $input;
    }
	
	// Check username and password (empty & length) and redirect to login page if error
	function checkInput($username, $password)
	{
		if (!$username || !$password) {
			header('Refresh: 3; URL=./login.php'); 
			echo "Username or Password field can't be empty!";
			echo "<br>";
			echo "Redirecting to login page...";			
			exit();
		}
		else if(strlen($username) > 20 || strlen($password) > 20)
		{
			header('Refresh: 3; URL=./login.php'); 
			echo "Username and Password can't be over 20 characters!";
			echo "<br>";
			echo "Redirecting to login page...";			
			exit();
		}
		
	}
?> 