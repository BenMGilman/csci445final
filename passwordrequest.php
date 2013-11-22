<?php
	include_once('dbaccess.php');
	
	$tpquery = "select * from posts;";
	$tpresult = $db->query($tpquery);
	$tpnum_results = $tpresult->num_rows;
?>