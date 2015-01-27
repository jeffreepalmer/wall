<?php
	session_start();
?>

<html>
<head>
	<title>WALL</title>
	<link rel="stylesheet" type="text/css" href="wall.css">
</head>
<body>
	<?php
		if(isset($_SESSION['errors'])){
			foreach ($_SESSION['errors'] as $error){
				echo "<p class='error'>{$error} </p>";

			}
			unset($_SESSION['errors']);
		}
		if (isset($_SESSION['success_message'])) {
			echo "<p class='success'>{$_SESSION['success_message']} </p>";
			unset($_SESSION['success_message']);
		}
	?>
	<div class='container'>
		
		<div class='header'>
			<h1>WALL.</h1>
		</div>

		<form action='process.php' method='post'>
			<h1>REGISTER FOR WALL.</h1>
			<input type='hidden' name='action' value='register'>
			First Name: <input type='text' name='first_name' placeholder='First Name'><br>
			Last Name: <input type='text' name='last_name' placeholder='Last Name'><br>
			E-Mail Address: <input type='email' name='email' placeholder='E-Mail Address'><br>
			Password: <input type='password' name='password' placeholder='Password'><br>
			Confirm Password: <input type='password' name='password_conf' placeholder='Confirm Password'><br>
			<input type='submit' value='Register for WALL.'><br>
		</form>

		<form action='process.php' method='post'>
			<h1>LOGINTO WALL.</h1>
			<input type='hidden' name='action' value='login'><br>
			E-Mail Address: <input type='email' name='email' placeholder='E-Mail Address'><br>
			Password: <input type='password' name='password' placeholder='Password'><br>
			Confirm Password: <input type='password' name='password_conf' placeholder='Confirm Password'><br>
			<input type='submit' value='Loginto WALL.'><br>
		</form>
	</div>
</body>
</html>
