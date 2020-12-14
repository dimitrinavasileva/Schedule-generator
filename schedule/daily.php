 <?php require '../templates/start.php' ?>
 
 <?php
	$date = $_GET['date'];
	require "../config.php";
	$connection = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
	
	$sql = "SELECT *
                FROM presentations
                WHERE date = '$date'";
				
	$statement = $connection->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
 ?>

<?php
	
	try{echo "<h2>",$result[0]['weekDay'],"</h2>";}
	catch(Exception $e) {
	  echo 'Message: ' .$e->getMessage();
	}
	
	echo "<div class=\"day-container\">";
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
			
			if ($noPresentations && $hour == 18){
				echo "<div > No Presentations today</div>";
			}
			echo "</div>";
	}
	
	echo "</div>";

    echo "</div>";
?>



