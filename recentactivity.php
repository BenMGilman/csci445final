<?php
	echo'<div id="activity">';
	for ($i=0; $i<$pnum_results; $i++){
		echo'<div class="posting">';
		$prow = $presult->fetch_assoc();
		
		$postid = stripslashes($prow['id']);
		$post = stripslashes($prow['post']);
		if(empty($post))
			continue;
		$keyphrase = stripslashes($prow['keyphrase']);
		if(empty($keyphrase))
			$keyphrase = "Title";
		
		$uquery = "select * from users where id=?;";
		$stmt = $db->prepare($uquery);
		$stmt->bind_param("i", $prow['user_id']);
		$stmt->execute();
		$uresult = $stmt->get_result();
		$unum_results = $uresult->num_rows;
		$urow = $uresult->fetch_assoc();
		
		echo   '<table class="fullpost">
					<tr>
						<td>
							<table>
								<tr align="center">
									<td>
										<form id="diffuser'.$prow['user_id'].'" action="differentuser.php" method="post">
											<input type="hidden" name="user" value="'.$prow['user_id'].'">
											<a href="javascript:void()" onclick="document.getElementById(\'diffuser'.$prow['user_id'].'\').submit()">
												<img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/>
											</a>
										</form>
									</td>
								</tr>
								<tr align="center">
									<td>
										<font size="1">'.$prow['post_date'].'</font>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td id="keyword">'.$keyphrase.'</td>
								</tr>
								<tr>
									<td>'.$post.'</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>';
		
		$cquery = "select * from comments where post_id=?;";
		$stmt = $db->prepare($cquery);
		$stmt->bind_param("i", $postid);
		$stmt->execute();
		$cresult = $stmt->get_result();
		$cnum_results = $cresult->num_rows;
		if($cnum_results > 0){
			echo '<div>';
			for ($k=0; $k<$cnum_results; $k++){
				$crow = $cresult->fetch_assoc();
				$comment = stripslashes($crow['comment']);
				
				$uquery = "select * from users where id=?;";
				$stmt = $db->prepare($uquery);
				$stmt->bind_param("i", $crow['user_id']);
				$stmt->execute();
				$uresult = $stmt->get_result();
				$unum_results = $uresult->num_rows;
				$urow = $uresult->fetch_assoc();
				
				echo   '<table>
							<tr>
								<td>
									<table class="postinfo">
										<tr align="center">
											<td>
												<form id="diffuser'.$crow['user_id'].'" action="differentuser.php" method="post">
													<input type="hidden" name="user" value="'.$crow['user_id'].'">
													<a href="javascript:void()" onclick="document.getElementById(\'diffuser'.$crow['user_id'].'\').submit()">
														<img src="'.$urow['photo'].'" alt = "photo" width="50" height="50"/>
													</a>
												</form>
											</td>
										</tr>
										<tr align="center">
											<td>
												<font size="1">'.$crow['post_date'].'</font>
											</td>
										</tr>
									</table>
								</td>
								<td>';
									echo $comment.'
								</td>
							</tr>
						</table>';
			}
			echo '</div>';
		}
		echo'<div>
				<form action="submitcomment.php" method="post">
					<table>
						<tr>
							<textarea name="commentarea" rows="3" cols="80" placeholder="Enter text..." required></textarea>
							<br>
							<input type="hidden" name="postid" value="'.$postid.'" />
							<input id="comment_button" type="submit" value="Comment"/>
						</tr>
					</table>
				</form>
			</div>';
		echo '</div>';
	}
	
	if($pnum_results == 0){
		echo 'No Matches Found<br />';
	}
	
	echo'<br /><b>New Post</b>
	<form action="submitpost.php" method="post">
		Title: <input type="text" name="keyphrase" size="18" maxlength="15" required />
		<textarea name="postarea" rows="5" cols="80" placeholder="Enter text..." required></textarea><br />
		<input type="submit" value="Post"/>
	</form>
	</div>';
?>