 <?php
	echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>Schedule Generator</title>		
				
				<link rel="stylesheet" href="./css/style.css"
			</head>
		<body>	
	';
 ?>
 
 <?php
	require "./config.php";
	$connection = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
	$date = isset($_GET['date'])? $_GET['date'] : $date;
	$sql = "SELECT *
                FROM presentations
                WHERE date = '$date'";
				
	$statement = $connection->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
 ?>

<?php	
	echo "<div class=\"day-container\">";
	echo "<h2 style=\"text-align:center;\"><a href=\"daily.php?date=".$date."\">".date('l', strtotime($date))."</a></h2>";
	echo "<div class=\"day\">";
	
	for ($hour = 9; $hour <= 18; $hour++) {
        echo "<div class=\"day-hour\">$hour:00</div>";
    }
	echo "</div>";

    echo "<div class=\"day\">";
	
    $noPresentations = true;
	
	for ($hour = 9; $hour <= 18; $hour++) {
        echo "<div class=\"hour\">";
		foreach ($result as $schedule) :
				if ($schedule["startHour"] == $hour){
					$noPresentations = false;
					$startTime = $schedule["startHour"];
					$endTime = $schedule["endHour"];
					$startParts = explode(':', $startTime);
					$endParts = explode(':', $endTime);
					$startTimeString = $startParts[0] . ":" . $startParts[1];
					$endTimeString = $endParts[0] . ":" . $endParts[1];
					echo "<div class=\"event event-start event-end\"><b>", $schedule["presentationName"], "</b> - <i>", $schedule["room"], "</i> - ", $schedule["presentatorName"], "<br>",$startTimeString, " - ", $endTimeString, "</div>";
				}
			endforeach;

			echo "</div>";
			
	}
	
	echo "</div>";
	if ($noPresentations){
				echo "<div><p style=\"text-align:center; font-size:20px; font-weight:bold;font-style:italic;\">No Presentations today</p></div>";
			}
    echo "</div>";
?>

 <?php require './templates/end.php' ?>