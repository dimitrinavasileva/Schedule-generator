<?php require '../templates/start.php' ?>
 
<?php
	session_start();
    $user = isset($_SESSION['username']) ? $_SESSION['username'] : "unknown";
	
    require "../config.php";
	
	$connection = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
	
	if($_POST) {
        $presentationName = $_POST["selectPresentation"];
		$choice = isset($_POST["choice"])? $_POST["choice"] : "unchosen";
		
		if($choice != "unchosen")
		{
			// Get presentationId from presentationName
			$sql = "SELECT presentationId
				FROM presentations
				WHERE '$presentationName' = presentationName";
			$statement = $connection->prepare($sql);
			$statement->execute();
			$presentationId = $statement->fetchAll(); // $presentationId[0][0] is the id
				
			// Add presentationId to chosen list
			$choiceColumn;
			if($choice == 'mustGo') { $choiceColumn = 'firstOption';}
			else if($choice == 'thinkToGo') { $choiceColumn = 'secondOption';}
			
			$sql = "SELECT $choiceColumn
					FROM personal
					WHERE username = '$user'";
			$statement = $connection->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			$chosenIds = "";
			
			if(!empty($result))
			{
				$chosenIds = $result[0][0];
			}			
			if($chosenIds == "")
			{
				$chosenIds = $presentationId[0][0];
			}
			else
			{
				$chosenPieces = explode(",", $chosenIds);
				if(!in_array($presentationId[0][0], $chosenPieces))
				{
					$chosenIds = $chosenIds. "," .$presentationId[0][0];
				}				
			}
			
			$sql = "UPDATE personal
					SET $choiceColumn = '$chosenIds'
					WHERE username = '$user'";
					
			$result = $connection->query($sql);			
		}
			
    }		
?>

<?php

	$sql = "SELECT *
                FROM presentations";
				
	$statement = $connection->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();

    echo '<h2> Personal schedule of the presentations: </h2>';

    
    $query = $connection->query($sql);
    
	echo '<form action="personal.php" method="post" name = "post">';
	echo 'Choose presentation ';
	echo '<select name="selectPresentation">';
	
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$row['presentationName'].'">'.$row['presentationName'].'</option>';
        }
        
		echo '
                <input type="radio" name="choice"
                value="mustGo"> Must go
                <input type="radio" name="choice"
                value="thinkToGo"> Think to go

                <input type="submit" value="Add" />
             </form>';
              
    echo '</select>';
?>

<?php
	// Create table with chosen presentations
	$sql = "SELECT *
			FROM personal
			WHERE username ='$user'";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
	$mustGoIds = $result[0]['firstOption'];
	$wantToGoIds = $result[0]['secondOption'];
	
	$mustGoPieces = explode(",", $mustGoIds);
	$wantToGoPieces = explode(",", $wantToGoIds);
	
	$mustGoInts = array_map('intval', $mustGoPieces);
	$wantToGoInts = array_map('intval', $wantToGoPieces);
	
	echo "<table>"; 
	foreach($mustGoInts as $value)
	{
		$sql = "SELECT *
				FROM presentations
				WHERE presentationId = $value";
		$statement = $connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		
		foreach ($result as $row) 
		{
			$choice = "Must go";
			
			echo "<tr><td>" . $row["presentationName"]. "</td><td>" . $row['date'] . "</td>.<td>" . $choice . "</td>.</tr>";
		}

	}
	
	foreach($wantToGoInts as $value)
	{
		$sql = "SELECT *
				FROM presentations
				WHERE presentationId = $value";
		$statement = $connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		
		foreach ($result as $row) 
		{
			$choice = "Want to go";
			
			echo "<tr><td>" . $row["presentationName"]. "</td><td>" . $row['date'] . "</td>.<td>" . $choice . "</td>.</tr>";
		}
	}

	echo "</table>"; //Close the table in HTML
?>
 
 <?php require '../templates/end.php' ?>