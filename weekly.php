 <?php require './templates/start.php' ?>
 
 <?php	
	
	echo '<h2> Weekly schedule of the presentations: </h2>';
	$date = date('Y-m-d');
	$dayofweek = date('w', strtotime($date));
	$weekParts = explode('-', $date);
	$year = $weekParts[0];
	$month = $weekParts[1];
	$firstDay = $weekParts[2] - $dayofweek;
	
	for ($day = 1; $day <= 5; $day++) {			
		$weekday = $firstDay+$day;
		$date = $year.'-'.$month.'-'.$weekday;
		
		include './daily.php';
	}
	
 ?>
 
  <?php require './templates/end.php' ?>