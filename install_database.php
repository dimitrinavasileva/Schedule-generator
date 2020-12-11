<?php
	// Create database, tables and test rows
	
	require "config.php";
	
	try {
    $connection = new PDO("mysql:host=$host", $username, $password);
	
	// Create database and tables
    $sql_create_db = file_get_contents("data/init.sql");
	$connection->exec($sql_create_db);
	
	// Insert initial data in the tables
	require "./data/test_users.php";
	$connection->exec($sql_insert_users);

	// Insert initial data in the tables
	require "./data/test_presentations.php";
	$connection->exec($sql_insert_presentations);

    
    echo "Database and tables created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>