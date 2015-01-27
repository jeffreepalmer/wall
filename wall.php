<?php
	session_start();
?>

<html>
<head>
	<title>WALL.</title>
	<link rel="stylesheet" type="text/css" href="wall.css">
</head>
<body>
	<div class='container'>
			<div class='header'>
				<h1>WALL.</h1>
				<span>Welcome, <?= $_SESSION['first_name'] ?>, to WALL. <a href='process.php'>LOGOUT.</a></span>
			</div>
			<div class='post_message'>
				<?php
					if(isset($_SESSION['errors'])){
						foreach ($_SESSION['errors'] as $error){
							echo "<p class='error'>{$error}</p>";

						}
						unset($_SESSION['errors']);
					};
					if (isset($_SESSION['success_message'])) {
						echo "<p class='success'>{$_SESSION['success_message']} </p>";
						unset($_SESSION['success_message']);
					}
				?>
				<form action='message_process.php' method='post'>
					<h1>COMPOSE COMMUNIQUÉ.</h1><br>
					<input type='hidden' name='action' value='message_submit'>
					<textarea name='message'></textarea><br>
					<input type='submit' value='SUBMIT COMMUNIQUÉ TO WALL.'>
				</form>
			</div>
			<div class='message_log'>

			</div>
	</div>
</body>
</html>