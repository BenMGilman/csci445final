<?php
// right now this is just a test page. There will not be posts specific to the homepage
	include_once('dbaccess.php');
	
	$query = "select * from posts;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	
?>
<html>
<head>
	<title>HOME PAGE</title>
</head>
<?php include_once('header.php'); ?>
<body>
<h1>HOME PAGE</h1>
<table>
<?php
// end case we try to get last 4 or so posts in the table since they will be the most recent ones, and display them on the home page
// maybe make each entry of a post into another table with the photo, username, and date as one column and the post as another
// need to make some spacing and wrapping text stuff to make it appealing and not look so crappy
	for ($i=0; $i<$num_results; $i++){
		$row = $result->fetch_assoc();
		echo '<tr><td>';
		echo stripslashes($row['post']);
		echo '</td></tr>';
	}
?>
</table>
<form action="submitpost.php" method="post">
<input type="hidden" name="page_type" value="home" />
<textarea name="postarea" rows="5" cols="50" required>Enter text here...</textarea><br>
Keyword: <input type="text" name="keyphrase" size="18" maxlength="15" required />
<input type="submit" value="Post"/>
</form>
</body>
</html>