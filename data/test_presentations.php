<?php	

	$sql_insert_presentations = "INSERT IGNORE INTO presentations(presentationId, presentationName, facultyNumber, presentatorName, room, startHour, endHour, date, weekDay)
		VALUES ( NULL, 'Introduction in android development', 81598, 'Dimitrina Vasileva', 101, '10:12:00', '10:30:00', '2020-12-14', 'Monday'),
		(NULL, 'Thinking in Java', 81695, 'Yordan Georgiev', 101, '10:35:00', '10:50:00', '2020-12-14', 'Monday')";
?>