<?php	
	// hashing some passwords for the initial users
	$pass1 = password_hash('123', PASSWORD_DEFAULT);
	$pass2 = password_hash('pass', PASSWORD_DEFAULT);
	$pass3 = password_hash('000000', PASSWORD_DEFAULT);
	
	$sql_insert_users = "INSERT IGNORE INTO users(username, password)
		VALUES ('admin', '$pass1'),
		('user1', '$pass2'),
		('user2', '$pass3');"
?>