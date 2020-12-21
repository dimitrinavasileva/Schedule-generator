<?php
	// Create database, tables and test rows
	
	require "db_config.php";
	
	try {
    $connection = new PDO("mysql:host=$host", $db_username, $db_password);
	
	// Create database and tables for the users
    $sql_create_db = "	
					CREATE DATABASE IF NOT EXISTS $db_name;
					USE $db_name;

					CREATE TABLE IF NOT EXISTS users (
						username VARCHAR(20) PRIMARY KEY NOT NULL,
						password VARCHAR(255) NOT NULL
					);	
					 
					CREATE TABLE IF NOT EXISTS personal (
						username VARCHAR(20) PRIMARY KEY NOT NULL,
						mustGo VARCHAR(50),
						wantToGo VARCHAR(50)
					);";
					
	$connection->exec($sql_create_db);
	
	// Insert initial data in the tables
	require "./data/test_users.php";
	$connection->exec($sql_insert_users1);
	$connection->exec($sql_insert_users2);

	// Create table for presentations based on the template in db_config.php file
	$sql_table_presentations_header = "
		USE $db_name;
		CREATE TABLE IF NOT EXISTS presentations (
		presentationId INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
		date DATE NOT NULL,
	";
	$attributes = explode(",",$presentation_attributes);
	$sql_presentation_attrs = implode(" VARCHAR(100)," , $attributes) . ' VARCHAR(100));';
	
	$sql_table_presentations = $sql_table_presentations_header . $sql_presentation_attrs;
	$statement = $connection->prepare($sql_table_presentations);
	$statement->execute();
    
    echo "Database and tables created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>