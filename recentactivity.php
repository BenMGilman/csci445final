<?php
	echo'<h3>Recent Activity:</h3>
	<table id="activity">';
	for ($i=0; $i<$pnum_results; $i++){
		$row = $presult->fetch_assoc();
		
		$post = stripslashes($row['post']);
		if(empty($post))
			continue;
		$keyphrase = stripslashes($row['keyphrase']);
		if(empty($keyphrase))
			$keyphrase = "Title";
		
		echo '<tr>';
		echo '<td><div id="keyword">'.$keyphrase.'</div>';
		echo $post.'</td>';
		echo '</tr>';
	}
	echo'</table>
	<form action="submitpost.php" method="post">
	<textarea name="postarea" rows="5" cols="50" placeholder="Enter text..." required></textarea><br>
	Title: <input type="text" name="keyphrase" size="18" maxlength="15" required />
	<input type="submit" value="Post"/>
	</form>';
?>