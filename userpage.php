<?php
	session_start();
	include_once('dbaccess.php');
	
	$_SESSION['return_page'] = "userpage";
	
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];

	$query = "select * from login where username=\"".$username."\"";
	$result = $db->query($query);
	$user = $result->fetch_assoc();

	$query = "select * from users where id=\"".$user['user_id']."\"";
	$result = $db->query($query);
	$user = $result->fetch_assoc();
	
	$query = "select * from comments where user_id=".$_SESSION['user_id'];
	$comresult = $db->query($query);
	$num_comments = $comresult->num_rows;
	
	$query = "select * from status;";
	$statresult = $db->query($query);
	$num_stats = $statresult->num_rows;
	
	if($user_id == 0){
		echo '<script type="text/javascript"> alert("You must be a registered user to have a profile."); </script>';
		// change to bring them back to what page they came from
		echo '<script type="text/javascript"> document.location.href="homepage.php"; </script>';
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>USER PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>USERNAME</h1>
<?php
// gets the image source from the database
	echo '<img src="'.$user['photo'].'" alt = "photo"<br>';
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
		<td>About Me: </td>
		<td><textarea name="aboutme" placeholder="Write about yourself here..."></textarea></td>
	</tr>
	<tr>
		<td><input type="submit" value="Save Changes" /></td>
	</tr>
</table>
</form>
<h3>Your Activity:</h3>
<?php
	if($num_comments < 0)
		echo 'No Recent Activity';
	else{
		echo '<table border="0">';
		for ($i=0; $i<$num_comments; $i++){
			$comment = $comresult->fetch_assoc();
			echo '<tr><td>';
			echo stripslashes($comment['comment']);
			echo '</td></tr>';
		}
		echo "</table>";
	}
?>
</body>
</html>