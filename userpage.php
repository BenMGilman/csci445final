<?php
	include_once('dbaccess.php');
	
	$username = $_GET['username'];
	$query = "select * from users where id=3";
	$userresult = $db->query($query);
	
	$query = "select * from comments where user_id=3";
	$comresult = $db->query($query);
	$num_comments = $comresult->num_rows;
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
// gets the blob from the database
	$user = $userresult->fetch_assoc();
	echo '<img src="data:image/jpeg;base64,'.base64_encode($user['photo']).'" alt = "photo"<br>';
?>
<table border="0">
	<tr>
		<td>First Name: </td>
		<td><input type="text" name="fname" size="18" maxlength="15" value=<?echo $user['fname']?> /></td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td><input type="text" name="lname" size="18" maxlength="15" value=<?echo $user['lname']?> /></td>
	</tr>
	<tr>
		<td>Email: </td>
		<td><input type="email" name="email" size="30" maxlength="30" value=<?echo $user['email']?> /></td>
	</tr>
	<tr>
		<td>About Me: </td>
		<td><textarea name="aboutme" placeholder="Write about yourself here..."></textarea></td>
	</tr>
	<tr>
		<td><input type="submit" value="Save Changes" /></td>
	</tr>
</table>
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