<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News Add Comments</title>
		<link rel="stylesheet" type="text/css" href="FSS_css.css">
	</head>
	<body>

	<h1>Welcome to Eastern News</h1>
	<h2>Add New Comments</h2>
	<form  method = "POST" action = "AddComments.php">
		<input type="hidden" name="token" value="<?php echo $_POST['token'];?>" />
		<input type="hidden" name="story_id" value="<?php echo $_POST['story_id'];?>" />
		Comments: <textarea name="comments" rows="5" cols="40" ></textarea>
		<br/><br/>
		<input type = "submit" value = "Add Comments">
		
		<br/><br/>
	</form>
	

</body>
</html>
