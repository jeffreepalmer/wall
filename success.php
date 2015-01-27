<?php
	session_start();
	echo "Howdy, {$_SESSION['first_name']}<br>";
	echo "<a href='process.php'>LOGOUT.</a>";
?>