<?php
	include_once('dbaccess.php');
	
	$name = $_POST['name'];
	$useremail = "";
	$userpassword = "";
	$username = "";
	$found = FALSE;
	
	$userquery = "select login.password, users.email from login, users
				  where login.username='".$name."'
				  and login.id = users.id";
	$userresult = $db->query($userquery);
	if($userresult->num_rows > 0){
		$user = $userresult->fetch_assoc();
		$userpassword = stripslashes($user['password']);
		$useremail = stripslashes($user['email']);
		$username = $name;
		$found = TRUE;
	}
	else{
		$emailquery = "select login.password, login.username from login, users
					   where users.email = '".$name."'
					   and login.id = users.id";
		$emailresult = $db->query($emailquery);
		if($emailresult->num_rows > 0){
			$user = $emailresult->fetch_assoc();
			$userpassword = stripslashes($user['password']);
			$username = stripslashes($user['username']);
			$useremail = $name;
			$found = TRUE;
		}
	}
	//Send email if user is found
	if($found){
		$subject = "Password Request";
		$message = "You recently requested for a password retrieval. Your information is below\n".
				   "\tUsername: ".$username."\n".
				   "\tPassword: ".$userpassword."\n";
		$fromaddress = "From: admin@finalproject.com";
		mail($useremail, $subject, $message, $fromaddress);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Password Request</title>
</head>
<body>
<h1>Request Status</h1>
<?php
	echo '<p>';
	if($found) echo 'Email sent successfully!';
	else echo 'Username or Email not found';
	echo '</p>';
?>
</body>
</html>