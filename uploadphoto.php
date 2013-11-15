<?php
	session_start();
	include_once('dbaccess.php');
	
	$page = $_SESSION['return_page'];
	$photo = null;
	
	if (!empty($_FILES['file']['name'])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts)){
			if ($_FILES["file"]["error"] > 0){
				echo '<script type="text/javascript"> alert("Invalid photo"); </script>';
				echo '<script type="text/javascript"> document.location.href="'.$page.'.php"; </script>';
			}
			else{
				$photo = "upload/" . $_FILES["file"]["name"];
				if (file_exists("upload/" . $_FILES["file"]["name"]) == 0){
					move_uploaded_file($_FILES["file"]["tmp_name"],
					"upload/" . $_FILES["file"]["name"]);
				}
			}
		}
		else{
			echo '<script type="text/javascript"> alert("Invalid photo"); </script>';
			echo '<script type="text/javascript"> document.location.href="'.$page.'.php"; </script>';
		}
	}
	
	// this is for if they entered from register
	if($page == "register"){
		$query = "select * from login;";
		$result = $db->query($query);
		$num_results = $result->num_rows;
			
		$loginQuery = "insert into login (id, username, password, user_id) values (?, ?, ?, ?)";
		$loginStmt = $db->prepare($loginQuery);
			
		$usersQuery = "insert into users (id, status, photo, fname, lname, email) values (?, ?, ?, ?, ?, ?)";
		$usersStmt = $db->prepare($usersQuery);
				
		$username = $_POST['username'];
		$userpass = $_POST['userpass'];
		$status = $_POST['status'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
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
			$usersStmt->bind_param("isssss", $user_id, $status, $photo, $fname, $lname, $email);
			$usersStmt->execute();
			$loginStmt->bind_param("issi", $user_id, $username, $userpass, $user_id);
			$loginStmt->execute();
		}
		echo '<script type="text/javascript"> document.location.href="index.php"; </script>';
	}
			// this is for if they enter from userpage
	else{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$status = $_POST['status'];
		
		// make queries to update tables
		if($photo == null){
			$query = 'update users set fname="'.$fname.'", lname="'.$lname.'", email="'.$email.'", status="'.$status.'" where id="'.$_SESSION['user_id'].'"';
		}else{
			$query = 'update users set fname="'.$fname.'", lname="'.$lname.'", email="'.$email.'", status="'.$status.'", photo="'.$photo.'" where id="'.$_SESSION['user_id'].'"';
		}
		$db->query($query);
				
		echo '<script type="text/javascript"> alert("Changes saved"); </script>';
		echo '<script type="text/javascript"> document.location.href="'.$page.'.php"; </script>';
	}
?>