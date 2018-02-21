<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Eastern News View Story</title>
		<link rel="stylesheet" type="text/css" href="FSS_css.css">
	</head>
	<body>
		<h1>Welcome to Eastern News</h1>
		<h2>View Story</h2>
<?php
	session_start();
	$story_id = $_POST['story_id'];
	$user_id = $_SESSION['user_id'];
	
	require 'database.php';
	
	$stmt = $mysqli->prepare("select title, link, content, author_name from stories where story_id = ?");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
		
	$stmt->bind_param('i', $story_id);
    
    $stmt->execute();
         
    $stmt->bind_result($title, $link, $content, $author_name);
    
    echo '<table>';
	echo '<tr>';
    echo '<th> Title </th>';
    echo '<th> Link </th>';
    echo '<th> Content </th>';
    echo '<th> Author </th>';
	echo '</tr>';
	        
    $stmt->fetch();
	//	printf("<td>title: %s </td> link: <td>%s </td>content: <td>%s</td> author: <td>%s</td>",
	//				htmlspecialchars($title),
	//				"<a href=".htmlspecialchars($link)."></a>",
	//				htmlspecialchars($content),
	//				htmlspecialchars($author_name)
	//			);
		echo '<tr>';
    	echo '<td>' . htmlspecialchars($title) . '</td>';
    	echo '<td><a href="'. htmlspecialchars($link). '" >here is link</a></td>';
    	echo '<td>' . htmlspecialchars($content) . '</td>';
    	echo '<td>' .htmlspecialchars($author_name) . '</td>';
		echo '<td><form action = "AddComents.php" method = "POST">';
		echo '<input type="hidden" name="story_id" value="' . htmlspecialchars($story_id) . '">';
		echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
		echo '<input type = "submit" value = "add comments">';
		echo '</form></td>';
		echo '</tr>';
		
    	echo '</table>';
    $stmt->close();
	
	$stmt = $mysqli->prepare("select comment_id, story_id, comments, username from comments where story_id = ?");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
    
	$stmt->bind_param('i', $story_id);
	
    $stmt->execute();
         
    $stmt->bind_result($comment_id, $story_id, $comments,$username);
    echo '<br><br>';
    echo '<table>';
	echo '<th> Username </th>';
    echo '<th> Comments </th>';
	        
    while($stmt->fetch()){
	//	printf("<td>title: %s </td> link: <td>%s </td>content: <td>%s</td> author: <td>%s</td>",
	//				htmlspecialchars($title),
	//				"<a href=".htmlspecialchars($link)."></a>",
	//				htmlspecialchars($content),
	//				htmlspecialchars($author_name)
	//			);
		echo '<tr>';
 //   	echo '<td>'. htmlspecialchars($comment_id) . '</td>';
 //   	echo '<td>'. htmlspecialchars($story_id). ' </td>';
    	echo '<td>' . htmlspecialchars($username) . '</td>';
    	echo '<td>' .htmlspecialchars($comments) . '</td>';
		if($username == $_SESSION['user_id']){
					echo '<td><form action = "EditComments.php" method = "POST">';
					echo '<input type="hidden" name="comment_id" value="' . htmlspecialchars($comment_id) . '">';
					echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
					echo '<input type = "submit" value = "edit">';
					echo '</form></td>';
					
					echo '<td><form action = "DeleteComment.php" method = "POST">';
					echo '<input type="hidden" name="comment_id" value="' . htmlspecialchars($comment_id) . '">';
					echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
					echo '<input type = "submit" value = "delete">';
					echo '</form></td>';
					
				} else {
					echo '<td></td>';
				}
		echo '</tr>';

	}
	echo '</table>';
    $stmt->close();
?>
	</body>
</html>
