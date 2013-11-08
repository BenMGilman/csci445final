<?php
	include_once('dbaccess.php');
	
	$query = "select * from users;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
?>
<html>
<head>
	<title>USER PAGE</title>
</head>
<body>
<h1>USERNAME</h1>
<?php
// gets the blob from the database
	$user = $result->fetch_assoc();
	echo '<img src="data:image/jpeg;base64,'.base64_encode($user['photo']).'" alt = "photo"<br>';
?>
</body>
</html>