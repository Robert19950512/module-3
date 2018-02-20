<?php
	session_start();
	$story_id = $_POST['story_id'];
	$user_id = $_SESSION['user_id'];
	
	require 'database.php';
	
	$stmt = $mysqli->prepare("select title, link, content, author_name from stories where story_id = '$story_id'");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
    
    $stmt->execute();
         
    $stmt->bind_result($title, $link, $content, $author_name);
    
    echo "<table>";
	        
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
		echo '</tr>';

    	echo "</table>";
    $stmt->close();
	
	$stmt = $mysqli->prepare("select comment_id, story_id, comments, user_id from comments where story_id = '$story_id'");
		if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
    
    $stmt->execute();
         
    $stmt->bind_result($comment_id, $story_id, $user_id, $comments);
    
    echo "<table>";
	        
    while($stmt->fetch()){
	//	printf("<td>title: %s </td> link: <td>%s </td>content: <td>%s</td> author: <td>%s</td>",
	//				htmlspecialchars($title),
	//				"<a href=".htmlspecialchars($link)."></a>",
	//				htmlspecialchars($content),
	//				htmlspecialchars($author_name)
	//			);
		echo '<tr>';
    	echo '<td>'. htmlspecialchars($comment_id) . '</td>';
    	echo '<td>'. htmlspecialchars($story_id). ' </td>';
    	echo '<td>' . htmlspecialchars($user_id) . '</td>';
    	echo '<td>' .htmlspecialchars($comments) . '</td>';
		echo '</tr>';
		if($author_name == $_SESSION['user_id']){
					echo '<td><form action = "EditComment.php" method = "POST">';
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
    	echo "</table>";
	}
    $stmt->close();
	
?>