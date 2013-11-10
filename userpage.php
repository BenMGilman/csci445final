<?php
	include_once('dbaccess.php');
	
	$query = "select * from users where status='Senior'";
	$result = $db->query($query);
	$num_results = $result->num_rows;
?>
<html>
<head>
	<title>USER PAGE</title>
</head>
<body>
<h1>USERNAME</h1>
<?php
// gets the blob from the database
	$user = $result->fetch_assoc();
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
</body>
</html>