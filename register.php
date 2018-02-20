<?php
session_start();
require 'database.php';

$username=$_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("insert into users (username, crypted_password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', $username, $password);

$stmt->execute();

$stmt->close();

$_SESSION['user_id']=$username;
header('Location: Story.php');
?>
