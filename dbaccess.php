<?php
	@ $db = new mysqli('localhost', 'team09', 'peach', 'team09');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}
?>