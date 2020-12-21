<?php
	$host       = "localhost";
	$db_username   = "root";
	$db_password   = "";
	$db_name     = "schedule";
	
	// Modify presentation table columns - add, remove, order
	// IMPORTANT: table 'presentations' starts with the attributes PRESENTATION_ID and DATE, below are the ones you can modify
	// (TOPIC is used for the personal schedule drop list so don't remove it)
	$presentation_attributes  = "START,END,TOPIC,NAMES,IDS,MAJOR,DESCRIPTION";
	
	// Specify which columns to show in the view of the table (and their order)
	$shown_columns = "DATE,START,END,TOPIC,NAMES,IDS,DESCRIPTION";
?>