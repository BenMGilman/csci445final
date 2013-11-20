<?php
	session_start();
// right now this is just a test page. There will not be posts specific to the homepage
	include_once('dbaccess.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['return_page']=="homepage"){
		$_SESSION['search']=$_POST['search'];
	}
	
	if($_SESSION['search']==null){
		$pquery = "select * from posts;";
	}else{
		$pquery = "select * from posts where keyphrase=\"".$_SESSION['search']."\";";
	}
	$presult = $db->query($pquery);
	$pnum_results = $presult->num_rows;
	
	$query = "select * from login;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
  
	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['return_page']!="homepage") {
	// if form has been posted process data
		$username = $_POST['username'];
		$userpass = $_POST['userpass'];
		$error = 1;
		
		for ($i=0; $i<$num_results; $i++){
			$row = $result->fetch_assoc();
			if($username == stripslashes($row['username'])){
				if($userpass == stripslashes($row['password'])){
					$error = 0;
					// update current user
					$_SESSION['username']=$username;
					// update current user
					$_SESSION['user_id']=stripslashes($row['user_id']);
				}
			}
		}
		if($error == 1){
			echo '<script type="text/javascript"> alert("Incorrect login combination."); </script>';
			echo '<script type="text/javascript"> document.location.href="index.php"; </script>';
		}
	}else{
		$_SESSION['search']=null;
	}
	
	$_SESSION['return_page']="homepage";
	
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>HOME PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>HOME PAGE</h1>
<?php include_once('recentactivity.php'); ?>
</body>
</html>