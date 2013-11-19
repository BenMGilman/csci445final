<?php
	session_start();
// need to get post specific to this page
	include_once('dbaccess.php');
	
	$_SESSION['return_page']="degreepage";
	
	$pquery = "select * from posts;";
	$presult = $db->query($pquery);
	$pnum_results = $presult->num_rows;
	
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>DEGREE PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>DEGREE PAGE</h1>
<table>
<?php
// need to make some spacing and wrapping text stuff to make it appealing and not look so crappy
	for ($i=0; $i<$pnum_results; $i++){
		$row = $presult->fetch_assoc();
		echo '<tr><td>';
		echo stripslashes($row['post']);
		echo '</td></tr>';
	}
?>
</table>
<form action="submitpost.php" method="post">
<textarea name="postarea" rows="5" cols="50" placeholder="Enter text..." required></textarea><br>
Keyword: <input type="text" name="keyphrase" size="18" maxlength="15" required />
<input type="submit" value="Post"/>
</form>
</body>
</html>