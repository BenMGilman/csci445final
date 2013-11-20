<?php
	session_start();
// need to get post specific to this page
	include_once('dbaccess.php');
	
	$_SESSION['return_page']="teacherpage";
	
	$pquery = "select * from posts;";
	$presult = $db->query($pquery);
	$pnum_results = $presult->num_rows;
	
?>
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