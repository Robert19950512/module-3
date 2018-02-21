<?php
	session_start();
	
	require 'database.php';
	
	if($_SESSION['token'] !== $_POST['token'])
	{
		die("Request forgery detected");
	}
	require 'database.php';
	
	if(isset($_POST['comment_id']) && isset($_POST['comment_content'])){

		$comment_id = $_POST['comment_id'];
		$content= $_POST['comment_content'];
	
		$stmt = $mysqli->prepare("update comments set comments=?  where comment_id =?");
			if(!$stmt){
	                printf("Query Prep Failed: %s\n", $mysqli->error);
	                exit;
	        }
	    
	    $stmt->bind_param('si', $content, $comment_id);
	 
		$stmt->execute();
	 
		$stmt->close();
		//$title1=$title;
		//$link1=$link;
		//$content1=$content;
		header('Location: Story.php');
		exit;
	}else{
		echo"not into the loop";
	}
?>