<?php
	session_start();
	include_once('dbaccess.php');
	
	$query = "select * from posts;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	$newID = $num_results + 1;
	
	if($_SESSION['user_id'] == 0){
		echo '<script type="text/javascript"> alert("You must be a registered user to post."); </script>';
	}else{
		$postQuery = "insert into posts (id, keyphrase, post, page, post_date, user_id) values (?, ?, ?, ?, CURDATE(), ?)";
		$postStmt = $db->prepare($postQuery);

		$post = $_POST['postarea'];
		$keyphrase = $_POST['keyphrase'];
				
		$postStmt->bind_param("isssi", $newID, $keyphrase, $post, $_SESSION['return_page'], $_SESSION['user_id']);
		$postStmt->execute();
	}
	echo '<script type="text/javascript"> document.location.href="'.$_SESSION['return_page'].'.php"; </script>';
?>