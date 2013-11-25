<?php
	session_start();
// need to get post specific to this page
	include_once('dbaccess.php');
	
	$_SESSION['return_page']="teacherpage";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['search']=$_POST['search'];
	}else{
		$_SESSION['search']=null;
	}
	
	if($_SESSION['search']==null){
		$pquery = "select * from posts where page=\"".$_SESSION['return_page']."\";";
	}else{
		$pquery = "select * from posts where keyphrase=\"".$_SESSION['search']."\" and page=\"".$_SESSION['return_page']."\";";
	}
	
	$presult = $db->query($pquery);
	$pnum_results = $presult->num_rows;
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>TEACHER PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>TEACHER PAGE</h1>
<?php include_once('recentactivity.php'); ?>
</body>
</html>