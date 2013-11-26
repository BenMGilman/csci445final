<?php
	session_start();
	include_once('dbaccess.php');
	
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];

	$query = "select * from users where id=\"".$user_id."\";";
	$result = $db->query($query);
	$user = $result->fetch_assoc();
	
	$cquery = "select * from comments where user_id=".$user_id.";";
	$cresult = $db->query($cquery);
	$num_comments = $cresult->num_rows;
	
	$pquery = "select * from posts where user_id=".$user_id.";";
	$presult = $db->query($pquery);
	$num_posts = $presult->num_rows;
	
	$query = "select * from status;";
	$statresult = $db->query($query);
	$num_stats = $statresult->num_rows;
	
	if($user_id == 0){
		echo '<script type="text/javascript"> alert("You must be a registered user to have a profile."); </script>';
		// change to bring them back to what page they came from
		echo '<script type="text/javascript"> document.location.href="'.$_SESSION['return_page'].'.php"; </script>';
	}
	$_SESSION['return_page'] = "userpage";
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>USER PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1><?php echo $username; ?></h1>
<?php
// gets the image source from the database
	echo '<img src="'.$user['photo'].'" alt = "photo" width="140" height="140"/><br>';
?>
<form action="uploadphoto.php" method="post" enctype="multipart/form-data">
<table border="0">
	<tr>
		<td>First Name: </td>
		<td><input type="text" name="fname" size="18" maxlength="15" value=<?php echo $user['fname']?> /></td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td><input type="text" name="lname" size="18" maxlength="15" value=<?php echo $user['lname']?> /></td>
	</tr>
	<tr>
		<td>Email: </td>
		<td><input type="email" name="email" size="30" maxlength="30" value=<?php echo $user['email']?> /></td>
	</tr>
	<tr>
		<td>Status: </td>
		<td><select name="status">
			<?php
			   for ($i=0; $i<$num_stats; $i++)
			   {
				 $row = $statresult->fetch_assoc();
				 $status_type = stripslashes($row['name']);
				 if($status_type == $user['status']){
					echo  '<option value = "'.$status_type.'" selected>'.$status_type.'</option>';
				 }else{
					echo  '<option value = "'.$status_type.'">'.$status_type.'</option>';
				 }
			  }
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Picture: </td>
		<td><input type="file" name="file" id="file" value="Upload Photo"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Save Changes" /></td>
	</tr>
</table>
</form>
<h3>Your Activity:</h3>
<?php
	echo '<div id="userposts">';
	echo '<h4>Posts:</h4>';
	if($num_posts < 0)
		echo 'No Recent Posts';
	else{
		for ($i=0; $i<$num_posts; $i++){
			$post = $presult->fetch_assoc();
			echo '<table><tr><td>';
			echo stripslashes($post['post_date']).'
			<form action="editpost.php" method="post">
			Title: <input type="text" name="keyphrase" size="18" maxlength="15" value="'.stripslashes($post['keyphrase']).'" required /><br />
			<textarea name="postarea" rows="5" cols="80" required>'.stripslashes($post['post']).'</textarea><br>
			<input type="submit" value="Edit"/><input type="hidden" name="postid" value="'.stripslashes($post['id']).'">
			</form>';
			echo '</td></tr>';
		}
		echo "</table>";
	}
	
	echo '<h4>Comments:</h4>';
	if($num_comments < 0)
		echo 'No Recent Comments';
	else{
		for ($i=0; $i<$num_comments; $i++){
			$comment = $cresult->fetch_assoc();
			echo '<table><tr><td>';
			echo stripslashes($comment['post_date']).'
			<form action="editpost.php" method="post">
			<textarea name="postarea" rows="5" cols="80" required>'.stripslashes($comment['comment']).'</textarea><br>
			<input type="submit" value="Edit"/><input type="hidden" name="commentid" value="'.stripslashes($comment['id']).'">
			</form>';
			echo '</td></tr>';
		}
		echo "</table>";
	}
	echo '</div>';
?>
</body>
</html>