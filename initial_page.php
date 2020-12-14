<?php 
include "templates/start.php";

session_start();

$user = isset($_SESSION['username']) ? $_SESSION['username'] : "unknown";

echo "<a href=\"./weekly.php\"><strong>Weekly schedule</strong></a>";
echo " of upcoming/presented";
echo "</br>";

if($user === "unknown")
{
	echo "<a href=\"login\login.php\"><strong>Login</strong></a>";
	echo " to see personal schedule.";
}
else
{
	echo 'Hello, '.$user.'!';
	echo ' Your personal schedule is here.';
	echo "</br>";
	echo "Press ";
	echo "<a href=\"login\session_destroy.php\"><strong>here</strong></a>";
	echo " to log out";
}

include "templates/end.php"; 
?>