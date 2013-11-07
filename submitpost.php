<?php
	@ $db = new mysqli('localhost', 'root', '', 'team09');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}

	$postQuery = "insert into posts (keyphrase, post, page, post_date, user_id) values (?, ?, ?, ?, ?)";
	$postStmt = $db->prepare($postQuery);

	$page = $_POST['page_type'];
	$post = $_POST['postarea'];
	// the post_date is always being set to NULL for some reason....
	// NEED TO FIX not sure if value in database needs to be changed or if there is some way to get the date another way/value
	$post_date = `getdate()`;	
	$keyphrase = $_POST['keyphrase'];
	$user_id = 1;
	
	$postStmt->bind_param("ssssi", $keyphrase, $post, $page, $post_date, $user_id);
	$postStmt->execute();
	
	echo '<script type="text/javascript"> document.location.href="'.$page.'page.php"; </script>';
?>