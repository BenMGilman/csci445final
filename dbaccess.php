<?php
	@ $db = new mysqli('localhost', 'root', '', 'team09');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}
?>