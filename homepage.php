<?php
	session_start();
// right now this is just a test page. There will not be posts specific to the homepage
	include_once('dbaccess.php');
	
	$tpquery = "select * from posts;";
	$tpresult = $db->query($tpquery);
	$tpnum_results = $tpresult->num_rows;

	if($tpnum_results <= 5){
		$presult = $tpresult;
		$pnum_results = $tpnum_results;
	}else{
		$pquery = 'select * from posts where (id='.$tpnum_results.' or id='.($tpnum_results-1).' or id='.($tpnum_results-2).' or id='.($tpnum_results-3).' or id='.($tpnum_results-5).');';
		$presult = $db->query($pquery);
		$pnum_results = $presult->num_rows;
	}
	
	$query = "select * from login;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
  
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
<?php include_once('homeposts.php'); ?>
</body>
</html>