<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News</title>
		<link rel="stylesheet" type="text/css" href="FSS_css.css">
	</head>
	<body>
	<h1>Welcome to Eastern News</h1> <br>
		
<?php
	session_start();
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	$user_id=$_SESSION['user_id'];
		
		echo "Hello ". htmlentities($user_id). "!";

	
	require 'database.php';
	
	if(isset($_POST['sort_by'])){
		$sort_by = $_POST['sort_by'];
	}else{
		$sort_by = "none";
	}
	//else{
	//	$sort_by ="hot";
	//}
	  // echo '$_POST["sort_by"]';
	
		if($sort_by == "hot" && isset($sort_by)){
		$stmt = $mysqli->prepare("select story_id, author_name, title from stories order by comment_num");
		} else if ($sort_by == "title" && isset($sort_by)) {
			$stmt = $mysqli->prepare("select story_id, author_name, title from stories order by title");
		}else{
			$stmt = $mysqli->prepare("select story_id, author_name, title from stories");

		}

		if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
		}
		 
		$stmt->execute();
		 
		$stmt->bind_result($story_id, $author_name, $title);
		//echo "$story_id";
		echo "<table>";
		echo '<tr>';
		echo '<th> Story ID </th> <th> Author </th> <th> Title </th>';
		echo '</tr>';
	
		while($stmt->fetch()){
			//echo '<td><a href="'.htmlentities($link).'" target="_blank"> '.htmlentities($title).'</a></td>';

			//echo '<td><a href="'.htmlentities($link).'"> '.htmlentities($title).'</a></td>';

			//echo '<td>'.htmlentities($submitter).'</td>';
			//echo '<td>'.$time.'</td>';
				printf("<td>%s </td> <td>%s </td><td>%s</td>",
					htmlspecialchars($story_id),
					htmlspecialchars($author_name),
					htmlspecialchars($title)
				);

				echo '<td><form action = "ViewStory.php" method = "POST">';
				echo '<input type="hidden" name="story_id" value="' . htmlspecialchars($story_id) . '">';
				//echo '<input type="hidden" name="story_id" value="<?php echo htmlspecialchars($t); " >';
				echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
				echo '<input type = "submit" value = "view">';
				
				echo '</form></td>';
				//$comment_path = sprintf("comments.php?story_id=%s", $story_id);
				//echo '<td><a href="'.$comment_path.'"> Comments </a></td>';
				if($author_name == $_SESSION['user_id']){
					echo '<td><form action = "EditStory.php" method = "POST">';
					echo '<input type="hidden" name="story_id" value="' . htmlspecialchars($story_id) . '">';
					echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
					echo '<input type = "submit" value = "edit">';
					echo '</form></td>';
					
					echo '<td><form action = "DeleteStory.php" method = "POST">';
					echo '<input type="hidden" name="story_id" value="' . htmlspecialchars($story_id) . '">';
					echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
					echo '<input type = "submit" value = "delete">';
					echo '</form></td>';
				} else {
					echo '<td></td>';
				}
				echo '</tr>';
			}
			echo "</table>";
			 
			$stmt->close();
	
	?>
	
	<form action='NewStory.php' method = "post">
		
		
		<input type="submit" value="new story">
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
		</form> <br>
	<form action = 'Story.php' method = "post">
	<label>Sort Stories By: </label>
	<select name="sort_by">
	<option value="none"></option>
	<option value="hot">hot</option>
	<option value="title">title</option>
	</select>
	<input type ="submit" value ="click to see the story list by your order choice!"> <br>
	</form>
		
	<form action='logout.php'>
		<input type="submit" value="Log out">
		</form>
	
	
	
	
	</body>
</html>