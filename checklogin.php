<?php
	@ $db = new mysqli('localhost', 'root', '', 'team09');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}

	$query = "select * from login;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
  
	$loginQuery = "insert into login (id, username, password, user_id) values (?, ?, ?, ?)";
	$loginStmt = $db->prepare($loginQuery);
	
	$usersQuery = "insert into users (id, status, photo, fname, lname, email) values (?, ?, ?, ?, ?, ?)";
	$usersStmt = $db->prepare($usersQuery);
  
	$username = $_POST['username'];
	$userpass = $_POST['userpass'];
	$loginflag = $_POST['loginflag'];
	
	if($loginflag == '0'){
		for ($i=0; $i<$num_results; $i++){
			$row = $result->fetch_assoc();
			if($username == stripslashes($row['username'])){
				if($userpass == stripslashes($row['password'])){
					// update current user
					echo '<script type="text/javascript"> document.location.href="homepage.php"; </script>';
				}
			}
		}
		echo '<script type="text/javascript"> alert("Incorrect login combination."); </script>';
		echo '<script type="text/javascript"> document.location.href="login.php"; </script>';
	}else{
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
			echo '<script type="text/javascript"> alert("Login successful."); </script>';
			$user_id = $num_results + 1;
			$usersStmt->bind_param("isbsss", $user_id, $status, $photo, $fname, $lname, $email);
			$usersStmt->execute();
			$loginStmt->bind_param("issi", $user_id, $username, $userpass, $user_id);
			$loginStmt->execute();
			echo '<script type="text/javascript"> document.location.href="login.php"; </script>';
		}
	}
?>