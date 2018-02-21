<?php
	session_start();
	
	require 'database.php';
	
	if($_SESSION['token'] !== $_POST['token'])
	{
		die("Request forgery detected");
	}
	require 'database.php';
	
	if(isset($_POST['story_id']) && isset($_POST['comments'])){

		$uid = $_SESSION['uid'];
		$content= $_POST['comments'];
		$story_id= $_POST['story_id'];
		$user_id = $_SESSION['user_id'];
		$stmt = $mysqli->prepare("insert into comments (story_id, comments, user_id, username) values (?, ?, ?, ?)");
			if(!$stmt){
	                printf("Query Prep Failed: %s\n", $mysqli->error);
	                exit;
	        }
	    
	    $stmt->bind_param('isis', $story_id,$content, $uid, $user_id);
	 
		$stmt->execute();
	 
		$stmt->close();
		//$title1=$title;
		//$link1=$link;
		//$content1=$content;
		header('Location: Story.php');
		exit;
	}else{
		echo "not inside";
	}
?>