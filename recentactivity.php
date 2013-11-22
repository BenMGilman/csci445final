<?php

	echo'<div id="activity">';
	for ($i=0; $i<$pnum_results; $i++){
		$prow = $presult->fetch_assoc();
		
		$postid = stripslashes($prow['id']);
		$post = stripslashes($prow['post']);
		if(empty($post))
			continue;
		$keyphrase = stripslashes($prow['keyphrase']);
		if(empty($keyphrase))
			$keyphrase = "Title";
		
		$uquery = "select * from users where id=".$prow['user_id'].";";
		$uresult = $db->query($uquery);
		$unum_results = $uresult->num_rows;
		$urow = $uresult->fetch_assoc();
		
		echo '<table><tr>';
		echo '<td><table id="postinfo"><tr align="center"><td><img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/></td></tr>';
		echo '<tr align="center"><td><font size="1">'.$prow['post_date'].'</font></td></tr></table>';
		echo '<td><table><tr><td id="keyword">'.$keyphrase.'</td></tr>';
		echo '<tr><td>'.$post.'</td></tr></table>';
		echo '</tr></table>';
		
		$cquery = "select * from comments where post_id=".$postid;
		$cresult = $db->query($cquery);
		$cnum_results = $cresult->num_rows;
		
		echo '<div>';
		for ($i=0; $i<$cnum_results; $i++){
			$crow = $cresult->fetch_assoc();
			$comment = stripslashes($crow['comment']);
			
			$uquery = "select * from users where id=".$prow['user_id'].";";
			$uresult = $db->query($uquery);
			$unum_results = $uresult->num_rows;
			$urow = $uresult->fetch_assoc();
			
			echo '<table><tr>';
			echo '<td><table id="postinfo"><tr align="center"><td><img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/></td></tr>';
			echo '<tr align="center"><td><font size="1">'.$crow['post_date'].'</font></td></tr></table>';
			echo '<td>';
			echo $comment.'</td>';
			echo '</tr></table>';
		}
		echo '</div>';
		echo'<div><table>
			<tr>
			<form action="submitcomment.php" method="post">
			<textarea name="commentarea" rows="3" cols="80" placeholder="Enter text..." required></textarea><br>
			<input type="hidden" name="postid" value="'.$postid.'">
			<input id="comment_button" type="submit" value="Comment"/>
			</form>
			</tr>';
		echo '</table></div>';

	}
	
	if($pnum_results == 0){
		echo 'No Matches Found<br />';
	}
	
	echo'<br />New Post:
	<form action="submitpost.php" method="post">
	<textarea name="postarea" rows="5" cols="80" placeholder="Enter text..." required></textarea><br>
	Title: <input type="text" name="keyphrase" size="18" maxlength="15" required />
	<input type="submit" value="Post"/>
	</form>';
?>