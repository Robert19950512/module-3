<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News Add New</title>
	</head>
	<body>
<?php
	require 'database.php';
	session_start();
	
		if($_SESSION['token'] !== $_POST['token'])
	{	
		die("Request forgery detected");
	}
	
	

	
	if(isset($_POST['story_title']) && isset($_POST['story_link']) && isset($_SESSION['user_id']))
	{
		$story_title = $_POST['story_title'];
		$story_link = $_POST['story_link'];
		$story_content = $_POST['story_content'];
		$user_id = $_SESSION['user_id'];
	
		$stmt = $mysqli->prepare("insert into stories (title, link, content, author_name) values (?, ?, ?, ?)");
		if(!$stmt)
		{
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
	
		$stmt->bind_param('ssss', $story_title, $story_link, $story_content, $user_id);
	
		$stmt->execute();
	
		$stmt->close();
	
		header('Location: Story.php');
		exit;
	}
?>
	<h1>Welcome to Eastern News</h1>
	<h2>Add New Story</h2>
	<form  method = "POST">
		
		Title: <input type ="text" name = "story_title">
		<br/><br/>
		Link: <input type ="text" name = "story_link">
		<br/><br/>
		Content: <input type ="text" name = "story_content">
		<br/><br/>
		
		<input type = "submit" value = "Create">
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	
	</form>
	

</body>
</html>
