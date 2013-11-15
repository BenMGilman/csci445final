<?php
	session_start();
	include_once('dbaccess.php');

	$postQuery = "insert into posts (keyphrase, post, page, post_date, user_id) values (?, ?, ?, CURDATE(), ?)";
	$postStmt = $db->prepare($postQuery);

	$page = $_POST['page_type'];
	$post = $_POST['postarea'];
	$keyphrase = $_POST['keyphrase'];
	$user_id = 1;
	
	$postStmt->bind_param("sssi", $keyphrase, $post, $page, $_SESSION['user_id']);
	$postStmt->execute();
	
	echo '<script type="text/javascript"> document.location.href="'.$page.'page.php"; </script>';
?>