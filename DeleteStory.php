<?php
	require 'database.php';
	session_start();
	$story_id = $_POST['story_id'];
    
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	
	require 'database.php';
        
    $stmt = $mysqli->prepare("delete from stories where story_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
	}
    $stmt->bind_param('i', $story_id);
         
    $stmt->execute();
         
    $stmt->close();
    
    header("Location: Story.php");
	exit;
?>