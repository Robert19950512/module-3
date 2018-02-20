<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News Log In</title>
	</head>
	<body>
	
		<h1>Log in</h1>
		<form action='Login.php' method="POST">
		Username:
		<input type="text" name="username">
		<br>
		Password:
		<input type="password" name="password">
		<br>
		<input type="submit" value="Log in">
		
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="Register.html">Register</a>
		</form>
	
	</body>
	<?php
		session_start();
		
		require 'database.php';

		$stmt = $mysqli->prepare("SELECT COUNT(*), username, crypted_password FROM users WHERE username=?");

		$stmt->bind_param('s', $user);
		if(isset($_POST["username"])){
		$user = $_POST['username'];
		}
		$stmt->execute();

		$stmt->bind_result($cnt, $user_id, $pwd_hash);
		$stmt->fetch();
		if(isset($_POST["password"])){
		$pwd_guess=$_POST['password'];
		}
		if(isset($_POST["password"]) && isset($_POST["username"])){
		if( $cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
			$_SESSION['user_id'] = $user_id;
			header('Location: Story.php');
		} else{
			echo 'Failed Log in!';
			}
		}
     ?>
</html>