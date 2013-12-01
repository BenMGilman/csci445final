<?php
	session_start();
// need to get post specific to this page
	include_once('dbaccess.php');
	
	$_SESSION['return_page']="socialpage";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['search']=$_POST['search'];
	}else{
		$_SESSION['search']=null;
	}
	
	if($_SESSION['search']==null){
		$pquery = "select * from posts where page=?;";
		$stmt = $db->prepare($pquery);
		$stmt->bind_param("s", $_SESSION['return_page']);
	}else{
		$pquery = "select * from posts where keyphrase=? and page=?;";
		$stmt = $db->prepare($pquery);
		$stmt->bind_param("ss", $_SESSION['search'], $_SESSION['return_page']);
	}
	
	$stmt->execute();
	$presult = $stmt->get_result();
	$pnum_results = $presult->num_rows;
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>SOCIAL PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>SOCIAL PAGE</h1>
<?php include_once('recentactivity.php'); ?>
</body>
<?php include_once('footer.php'); ?>
</html>