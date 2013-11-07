<?php
	@ $db = new mysqli('localhost', 'root', '', 'team09');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}

	$postQuery = "insert into posts (keyphrase, post, page, post_date, user_id) values (?, ?, ?, CURDATE(), ?)";
	$postStmt = $db->prepare($postQuery);

	$page = $_POST['page_type'];
	$post = $_POST['postarea'];
	$keyphrase = $_POST['keyphrase'];
	$user_id = 1;
	
	$postStmt->bind_param("sssi", $keyphrase, $post, $page, $user_id);
	$postStmt->execute();
	
	echo '<script type="text/javascript"> document.location.href="'.$page.'page.php"; </script>';
?>