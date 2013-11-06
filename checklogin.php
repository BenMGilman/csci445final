<?php
	$username = $_POST['username'];
	$loginflag = $_POST['loginflag'];
	
	if($loginflag == '0'){
		echo 'login attempt';
	}else{
		echo 'register attempt';
	}
?>