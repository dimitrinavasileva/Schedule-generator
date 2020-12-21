<?php 
	require "./db_config.php";
	$connection = new PDO("mysql:host=$host;dbname=$db_name;", $db_username, $db_password);
	$sql = 'SELECT DISTINCT date
			FROM presentations';
	$statement = $connection->prepare($sql);
	$statement->execute();
	
	$dates = "";
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
		$split = explode("-", $row['date']);
		$r_split = array_reverse($split);
		$temp = $r_split[0];
		$r_split[0] = $r_split[1];
		$r_split[1] = $temp;
		$formatted = implode("/", $r_split);
        $dates.= $formatted . ',';
    }
	$dates = substr($dates, 0, -1);
	
	echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>Schedule Generator</title>		
				
				<link rel="stylesheet" type="text/css" href="./css/style.css" >
				<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" >
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
				
				<script>
					$(document).ready(function() {
						var dates =\''; 
				echo $dates;
				echo '\';			
						console.log(dates);
						var SelectedDates = dates.split(",");
						SelectedDates = SelectedDates.map(
							function(x){
								return "\'".concat(x).concat("\'");
							}
						);
						var i;
						for(i = 0; i < SelectedDates.length; i++)
						{
							SelectedDates[new Date(SelectedDates[i])] = new Date(SelectedDates[i]).toString();
						}
						
						$(\'#datepicker\').datepicker({
							
							dateFormat: "yy-mm-dd",
							
							beforeShowDay: function(date) {
								var Highlight = SelectedDates[date];
								if (Highlight) {								
								return [true, \'highlighted\', Highlight];
								} else {
									return [false, \'\', \'\'];
								}
							},
							onSelect: function(date)
								{
								
								}
						});
					});		
				
				</script>
			</head>
		<body style="margin-left:50px;">	
			<h1 style="margin-left:8px;">Schedule Generator</h1>
			<hr style="margin-left:-42px;">
			';
?>

<?php
session_start();

$user = isset($_SESSION['username']) ? $_SESSION['username'] : "unknown";

if($user === "unknown")
{
	echo "<br><br>";
	echo "<a href=\"login\login.php\"><strong>Login</strong></a>";
	echo " to see personal schedule.";
}
else
{
	echo "<br><br>";
	echo 'Hello, <strong><i>'.$user.'</i></strong>!';
	echo ' Your personal schedule is <a href="schedule\personal.php"><strong>here</strong></a>.';
	
	echo "<a href=\"login\session_destroy.php\" class=\"button\", style = \"margin-left:800px;\"><strong>Log out</strong></a>";
}

echo '
		<form action="./schedule/daily.php" method="post"; style="margin-top:10px;""> 
				<br><br>
				Full day schedule:&emsp;
				<input type="text" id="datepicker" name="datepicker" value="pick a date" size=8 readonly="readonly"/>
				<input type="submit" name="button_picked_date" value="Show schedule" />
			</form>
	';
	
if($user == "admin")
	{
		echo '<br><br>
			<a href = "import/import_form.php" class="button">Import data</a>
		';
	}

include "templates/end.php"; 
?>