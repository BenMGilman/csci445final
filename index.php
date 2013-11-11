<?php
	include_once('dbaccess.php');
	
$query = "select * from login;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	
	$loginQuery = "insert into login (id, username, password, user_id) values (?, ?, ?, ?)";
	$loginStmt = $db->prepare($loginQuery);
	
	$usersQuery = "insert into users (id, status, photo, fname, lname, email) values (?, ?, ?, ?, ?, ?)";
	$usersStmt = $db->prepare($usersQuery);
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// if form has been posted process data
		$username = $_POST['username'];
		$userpass = $_POST['userpass'];
		$status = $_POST['status'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$photo = null;
		$error = "";
		
		for ($i=0; $i<$num_results; $i++){
			$row = $result->fetch_assoc();
			if($username == stripslashes($row['username'])){
				$error="Username is taken.";
			}
		}
		if (!empty($error)){
			echo '<script type="text/javascript"> alert("'.$error.'"); </script>';
			echo '<script type="text/javascript"> document.location.href="register.php"; </script>';
		}else{
			echo '<script type="text/javascript"> alert("Registration successful."); </script>';
			$user_id = $num_results + 1;
			$usersStmt->bind_param("isbsss", $user_id, $status, $photo, $fname, $lname, $email);
			$usersStmt->execute();
			$loginStmt->bind_param("issi", $user_id, $username, $userpass, $user_id);
			$loginStmt->execute();
		}
	}
?>
<html>
<head>
	<title>CSM ADVICE</title>
</head>
<body>
<h1>CSM ADVICE</h1>

<form action="homepage.php" method="post">
<table border="0">
<tr>
	<td>Username: </td>
	<td colspan="2"><input type="text" name="username" autocomplete="on" size="18" maxlength="15" required /></td>
</tr>
<tr>
	<td>Password: </td>
	<td colspan="2"><input type="password" name="userpass" size="18" maxlength="15" required /></td>
</tr>
<tr>
	<td colspan="1"><input type="submit" value="Login"/></td>
	<td colspan="1"><input type="button" value="Guest" onclick="location.href='homepage.php'"/></td>
	<td colspan="1"><input type="button" value="Register" onclick="location.href='register.php'"/></td>
</tr>
</table>
</form>
</body>
</html>