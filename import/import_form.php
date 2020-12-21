<?php
	$today = date("Y-m-d");
	echo " 
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset=\"utf-8\">
					<title>Schedule Generator</title>		
					
					<link rel=\"stylesheet\" href=\"../css/style.css\">
				</head>
				<body>	
					<h1>Schedule Generator</h1>
					<hr>
					<br>
					<form action=\"import.php\" method=\"post\" enctype=\"multipart/form-data\" style=\"font-size:18px; margin-left:20px;\">
						1. Select <strong>CSV</strong> file to import:
						<input type=\"file\" name=\"fileToImport\" id=\"fileToImport\">
						<br><br>
						&emsp;... or paste google spreadsheet link: 
						<input type=\"text\" id=\"spreadsheet_link\" name=\"spreadsheet_link\" style=\"width:400px;\">
						&emsp;sheet number:
						<input type=\"text\" id=\"spreadsheet_page\" name=\"spreadsheet_page\" style=\"width:50px;\">
						&emsp;range of the data:
						<input type=\"text\" id=\"spreadsheet_range\" name=\"spreadsheet_range\" style=\"width:60px;\">
						<br><br><br>					
						2. Date of the presentations:
						<input type=\"text\" value=\"$today\" name=\"date\" style=\"width:75px;\">
						<br><br>
						3. The default column order is: <strong><i>
		";
		
		include "../db_config.php";		
		echo $presentation_attributes;
		echo "</i></strong>";
		echo " (you can change it in the <i>db_config.php</i> file)";
		
		echo
			"
						<br><br>
						Enter the corresponding columns in your file: 
						<input type=\"text\" name=\"order\" id=\"order\">
						<br>
						(seperated with \",\"; starting from 1; 0 for missing column ==> e.g. 1,2,5,0,6,4,0)
						<br><br>
						<br><br>						
						<input type=\"submit\" value=\"Import\" name=\"submit\" style=\"font-size:24px; display:block; margin: 0 auto;\">
					</form>
					
				</body>
			</html>
			";
?>