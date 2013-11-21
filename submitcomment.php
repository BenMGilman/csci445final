<?php
	session_start();
	include_once('dbaccess.php');
	
	$query = "select * from comments;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	$newID = $num_results + 1;
	
	if($_SESSION['user_id'] == 0){
		echo '<script type="text/javascript"> alert("You must be a registered user to post."); </script>';
	}else{
		$commentQuery = "insert into comments (id, comment, page, post_date, user_id, post_id) values (?, ?, ?, CURDATE(), ?, ?)";
		$commentStmt = $db->prepare($commentQuery);

		$comment = $_POST['commentarea'];
				
		$commentStmt->bind_param("issii", $newID, $comment, $_SESSION['return_page'], $_SESSION['user_id'], $_POST['postid']);
		$commentStmt->execute();
	}
	echo '<script type="text/javascript"> document.location.href="'.$_SESSION['return_page'].'.php"; </script>';
?>