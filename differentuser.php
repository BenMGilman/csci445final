<?php
	session_start();
	include_once('dbaccess.php');
	
	$user_id = $_POST['user'];

	$query = "select * from users where id=\"".$user_id."\";";
	$result = $db->query($query);
	$user = $result->fetch_assoc();
	
	$lquery = "select * from login where id=\"".$user_id."\";";
	$lresult = $db->query($lquery);
	$login = $result->fetch_assoc();
	
	$cquery = "select * from comments where user_id=".$user_id.";";
	$cresult = $db->query($cquery);
	$num_comments = $cresult->num_rows;
	
	$pquery = "select * from posts where user_id=".$user_id.";";
	$presult = $db->query($pquery);
	$num_posts = $presult->num_rows;
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>USER PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1><?php echo $login['username']; ?></h1>
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
		<td><input type="text" name="status" size="18" maxlength="15" value=<?php echo $user['status']?> /></td>
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
			echo stripslashes($post['post_date']).'<br />'.
				stripslashes($post['post']).'<br />';
			echo '</td></tr>';
		}
		echo '</table>';
	}
	
	echo '<h4>Comments:</h4>';
	if($num_comments < 0)
		echo 'No Recent Comments';
	else{
		for ($i=0; $i<$num_comments; $i++){
			$comment = $cresult->fetch_assoc();
			echo '<table><tr><td>';
			echo stripslashes($comment['post_date']).'<br />'.
				stripslashes($comment['comment']).'<br />';
			echo '</td></tr>';
		}
		echo '</table>';
	}
	echo '</div>';
?>
</body>
</html>