<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News Edit</title>
		<link rel="stylesheet" type="text/css" href="FSS_css.css">
	</head>
	<body>
	<h1>Welcome to Eastern News</h1>
	<h2>Edit comments</h2>
<?php
	session_start();
	require 'database.php';
	if(isset($_POST['comment_id']) && isset($_POST['token'])){
	$comment_id = $_POST['comment_id'];
	
	
	
	$stmt = $mysqli->prepare("select comments from comments where comment_id = ?");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
	
	$stmt->bind_param('i', $comment_id);
    
    $stmt->execute();
    
         
    $stmt->bind_result($content1);
    
    echo $content1;
	$stmt->fetch();
	
	$stmt->close();
	}
	
?>


	
	<form action="updateComments.php" method = "POST">
		<input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment_id)?>"/>
		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>"/>
		Content: <?php echo '<textarea name="comment_content" rows="5" cols="40" value =" '. htmlspecialchars($content1) . '" ></textarea>'; ?>
		<br/><br/>
		<input type = "submit" value = "Edit">
	</form>
	</body>
</html>