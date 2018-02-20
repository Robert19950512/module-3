<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News Edit</title>
		<link rel="stylesheet" type="text/css" href="FSS_css.css">
	</head>
	<body>
	<h1>Welcome to Eastern News</h1>
	<h2>Edit Story</h2>
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
	
	$stmt = $mysqli->prepare("select title, link, content from stories where story_id=?");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
	
	$stmt->bind_param('i', $story_i);
    
    $stmt->execute();
    
         
    $stmt->bind_result($title1, $link1, $content1);
    
    
	$stmt->fetch();
	
	$stmt->close();
	}
	
?>


	
	<form action="updateStory.php" method = "POST">
		<input type="hidden" name="story_id" value="<?= htmlspecialchars($story_id)?>"/>
		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>"/>
		Title: <input type ="text" name = "story_title" value="<?= htmlspecialchars($title1)?>"/>
		<br/><br/>
		Link: <?php echo '<input type ="text" name = "story_link" value =" '. htmlspecialchars($link1) . '" >'; ?>
		<br/><br/>
		Content: <?php echo '<input type ="text" name = "story_content value =" '. htmlspecialchars($content1) . '" >'; ?>
		<br/><br/>
		<input type = "submit" value = "Edit">
	</form>
	</body>
</html>