<?php
session_start();
require('new_connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'message_submit'){
	post_message($_POST);
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
		$query = "INSERT INTO messages (user_id, message_text, created_at, updated_at) 
				 VALUES ('{$_SESSION['user_id']}', '{$post['message']}', NOW(), NOW())";
		run_mysql_query($query);
		$_SESSION['success_message'] = 'COMMUNIQUÉ ADDED TO WALL.';
		header('location: wall.php');
		die();
	};



}


?>