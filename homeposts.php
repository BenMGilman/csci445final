<?php
	echo'<h3>Recent Activity:</h3>
	<div id="recent">';
	for ($i=0; $i<$pnum_results; $i++){
		echo '<div class="posting">';
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
		
		$uquery = "select * from users where id=?;";
		$stmt = $db->prepare($uquery);
		$stmt->bind_param("i", $prow['user_id']);
		$stmt->execute();
		$uresult = $stmt->get_result();
		$unum_results = $uresult->num_rows;
		$urow = $uresult->fetch_assoc();
		
		echo '<table>
				<tr>
					<td colspan="2">
						<b>Posted to the '.$page.' page:</b>
					</td>
				</tr>
				<tr>
					<td>
						<table class="postinfo">
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
								<td id="key">'.$keyphrase.'</td>
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
			for ($i=0; $i<$cnum_results; $i++){
				$crow = $cresult->fetch_assoc();
				$comment = stripslashes($crow['comment']);
				
				$uquery = "select * from users where id=?;";
				$stmt = $db->prepare($uquery);
				$stmt->bind_param("i", $crow['user_id']);
				$stmt->execute();
				$uresult = $stmt->get_result();
				$unum_results = $uresult->num_rows;
				$urow = $uresult->fetch_assoc();
				
				echo '<table>
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
							<td>
								<table>
									<tr>
										<td>'.$comment.'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>';
			}
			echo '</div>';
		}
		echo '</div>';
	}
	
	if($pnum_results == 0){
		echo "There are no posts.";
	}
	
	echo '</div>';
?>