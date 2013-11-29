<?php
	session_start();
	include_once('dbaccess.php');
	
	if(!empty($_POST['postid'])){
		$query = 'update posts set post=?, keyphrase=?, post_date=CURDATE() where id=?';
		$stmt = $db->prepare($query);
		$stmt->bind_param('ssi', $_POST['postarea'], $_POST['keyphrase'], $_POST['postid']);
	}else{
		$query = 'update comments set comment="'.$_POST['postarea'].'", post_date=CURDATE() where id="'.$_POST['commentid'].'"';
		$stmt = $db->prepare($query);
		$stmt->bind_param('si', $_POST['postarea'], $_POST['commentid']);
	}
	$stmt->execute();
	
	echo '<script type="text/javascript"> document.location.href="'.$_SESSION['return_page'].'.php"; </script>';
?>