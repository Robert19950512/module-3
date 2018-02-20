<?php
	session_start();
	if(isset($_POST['story_id']) && isset($_POST['token'])){
	$story_id = $_POST['story_id'];
	$user_id = $_SESSION['user_id'];
	
	if($_SESSION['token'] !== $_POST['token'])
	{
		die("Request forgery detected");
	}
	require 'database.php';
	
	
	}
	if(isset($_POST['story_title']) && isset($_POST['story_link']) && isset($_POST['story_content'])){
	$title1=$_POST['story_title'];
	$link1=$_POST['story_link'];
	$content1= $_POST['story_content'];
	}
	$stmt = $mysqli->prepare("update stories set title=?, link=?, content=? where story_id = '$story_id'");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
    
    $stmt->bind_param('sss', $title1, $link1, $content1);
 
	$stmt->execute();
 
	$stmt->close();
	//$title1=$title;
	//$link1=$link;
	//$content1=$content;
	header('Location: Story.php');
	
	
?>