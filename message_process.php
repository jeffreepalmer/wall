<?php
	session_start();
	require('new_connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'message_submit'){
		post_message($_POST);
	}
	else if(isset($_POST['action']) && $_POST['action'] == 'comment_submit'){
		post_comment($_POST);
	}
	else{
		session_destroy();
		header('location: index.php');
		die();
	}


	function post_message($post){
		// Might want to add more validation rules for messages later
		$_SESSION['errors'] = array();
		if(empty($post['message'])){
			$_SESSION['errors'][] = "ERROR. EMPTY COMMUNIQUÉ.";
		};
		// End of validation rules... FOR NOW!!!

		if(count($_SESSION['errors']) > 0){
			header('location: wall.php');
			die();
			}
		else{
			insert_new_message($post['message']);
			$_SESSION['success_message'] = 'COMMUNIQUÉ ADDED TO WALL.';
			header('location: wall.php');
			die();
		};
	};
	function post_comment($post){
		// Might want to add more validation rules for comments later
		$_SESSION['errors'] = array();
		if(empty($post['comment'])){
			$_SESSION['errors'][] = "ERROR. EMPTY COMMENT.";
		};
		// End of validation rules... FOR NOW!!!

		if(count($_SESSION['errors']) > 0){
			header('location: wall.php');
			die();
			}
		else{
			insert_new_comment($post['comment']);		 
			// echo $query;		 
			$_SESSION['success_message'] = 'COMMENTED.';
			header('location: wall.php');
			die();
		};
	};
	function insert_new_message($message_text){
		$esc_message_text = escape_this_string($message_text);
		$query = "INSERT INTO messages (user_id, message_text, created_at, updated_at) 
					 VALUES ('{$_SESSION['user_id']}', '{$esc_message_text}', NOW(), NOW())";
		run_mysql_query($query);
	};
	function insert_new_comment($comment_text){
		$esc_comment_text = escape_this_string($comment_text);
		$query = "INSERT INTO comments (user_id, comment_text, message_id, created_at, updated_at) 
					 VALUES ('{$_SESSION['user_id']}', '{$esc_comment_text}', '{$_POST['message_id']}', NOW(), NOW())";
		run_mysql_query($query);
	};

?>