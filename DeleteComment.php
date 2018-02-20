<?php

session_start();
$story_id = (int) $_POST['story_id'];
$story_link = $_POST['story_link'];
$story_title = $_POST['story_title'];
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

?>