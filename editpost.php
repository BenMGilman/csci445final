<?php
	session_start();
	include_once('dbaccess.php');
	
	if(!empty($_POST['postid'])){
		$query = 'update posts set post="'.$_POST['postarea'].'", keyphrase="'.$_POST['keyphrase'].'", post_date=CURDATE() where id="'.$_POST['postid'].'"';
	}else{
		$query = 'update comments set comment="'.$_POST['postarea'].'", post_date=CURDATE() where id="'.$_POST['commentid'].'"';
	}
	$db->query($query);
	
	echo '<script type="text/javascript"> document.location.href="'.$_SESSION['return_page'].'.php"; </script>';
?>