<?php

	echo'<h3>Recent Activity:</h3>
	<div id="recent">';
	for ($i=0; $i<$pnum_results; $i++){
		$prow = $presult->fetch_assoc();
		
		$postid = stripslashes($prow['id']);
		$post = stripslashes($prow['post']);
		if(empty($post))
			continue;
		$keyphrase = stripslashes($prow['keyphrase']);
		if(empty($keyphrase))
			$keyphrase = "Title";
		$postpage = stripslashes($prow['page']);
		if($postpage == "coursepage"){
			$page = "Courses";
		}elseif($postpage == "teacherpage"){
			$page = "Teachers";
		}elseif($postpage == "socialpage"){
			$page = "Social";
		}elseif($postpage == "degreepage"){
			$page = "Degree";
		}elseif($postpage == "generalpage"){
			$page = "General";
		}
		
		$uquery = "select * from users where id=".$prow['user_id'].";";
		$uresult = $db->query($uquery);
		$unum_results = $uresult->num_rows;
		$urow = $uresult->fetch_assoc();
		
		echo '<table><tr>';
		echo '<td>Posted to the '.$page.' page:</td></tr>';
		echo '<tr><td><table><tr><td><img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/></td></tr>';
		echo '<tr><td>'.$prow['post_date'].'</td></tr></table>';
		echo '<td><table><tr><td id="key">'.$keyphrase.'</td></tr>';
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
			echo '<td><table id="postinfo"><tr><td><img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/></td></tr>';
			echo '<tr><td>'.$crow['post_date'].'</td></tr></table>';
			echo '<td>';
			echo $comment.'</td>';
			echo '</tr></table>';
		}
		echo '</div>';
	}
	
	if($pnum_results == 0){
		echo "There are no posts.";
	}
?>