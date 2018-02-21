<?php


	require 'database.php';
	session_start();
	$comment_id = $_POST['comment_id'];
    
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	
        
    $stmt = $mysqli->prepare("delete from comments where comment_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
	}
    $stmt->bind_param('i', $comment_id);
         
    $stmt->execute();
         
    $stmt->close();
    
    header("Location: Story.php");
	exit;


?>