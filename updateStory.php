<?php
	session_start();
	
	require 'database.php';
	
	if($_SESSION['token'] !== $_POST['token'])
	{
		die("Request forgery detected");
	}
	require 'database.php';
	
	if(isset($_POST['story_title']) && isset($_POST['story_link']) && isset($_POST['story_content'])){
		$story_id = $_POST['story_id'];
		$user_id = $_SESSION['user_id'];
		$title=$_POST['story_title'];
		$link=$_POST['story_link'];
		$content= $_POST['story_content'];
	
		$stmt = $mysqli->prepare("update stories set title=?, link=?, content=? where story_id =?");
			if(!$stmt){
	                printf("Query Prep Failed: %s\n", $mysqli->error);
	                exit;
	        }
	    
	    $stmt->bind_param('sssi', $title, $link, $content, $story_id);
	 
		$stmt->execute();
	 
		$stmt->close();
		//$title1=$title;
		//$link1=$link;
		//$content1=$content;
		header('Location: Story.php');
		exit;
	}
?>