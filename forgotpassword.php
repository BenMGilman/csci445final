<?php
	$_SESSION['username'] = "guest";
	$_SESSION['user_id'] = 0;
	$_SESSION['search']=null;
	$_SESSION['return_page']="index";
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>FORGOT PASSWORD</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1>FORGOT PASSWORD</h1>

<form action="passwordrequest.php" method="post">
	Username or Email:
	<input type="text" name="name" autocomplete="on" size="20" maxlength="25" required />
	<br />
	<input type="submit" value="Request Password" />
</form>
</body>
</html>