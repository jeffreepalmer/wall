<?php
	session_start();
	require('new_connection.php');
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
					}
					else if (isset($_SESSION['success_message'])) {
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
				<?php
					$query = "SELECT users.first_name, users.last_name, DATE_FORMAT(messages.created_at, '%M %D %Y') AS formatted_date, messages.id AS message_id, messages.message_text FROM messages
							  LEFT JOIN users ON users.id = messages.user_id
							  ORDER BY messages.id DESC;";
					$messages = fetch_all($query);
					foreach ($messages as $message) { 
						echo "<h1>".$message['first_name']." ".$message['last_name']."</h1> <h2>".$message['formatted_date']."</h2><br><p>".$message['message_text']."</p>";				
						$query2 = "SELECT users.first_name, users.last_name, DATE_FORMAT(comments.created_at, '%M %D %Y') AS formatted_date, comments.comment_text FROM comments
								   LEFT JOIN users ON users.id = comments.user_id
								   WHERE comments.message_id = ".$message['message_id'];
						$comments = fetch_all($query2);
						foreach ($comments as $comment) { 
							echo "<h3 class='comment'>".$comment['first_name']." ".$comment['last_name']."</h3> <h4>".$comment['formatted_date']."</h4><br><p class='comment'>".$comment['comment_text']."</p>";				
						};
				?>

						<form action='message_process.php' method='post'>
							COMMENT.
							<input type='hidden' name='action' value='comment_submit'>
							<input type='hidden' name='message_id' value="<?= $message['message_id']?>">
							<textarea name='comment'></textarea><br>
							<input type='submit' value='COMMENT.'>
						</form>
					<?php }; ?>
				

			</div>
	</div>
</body>
</html>