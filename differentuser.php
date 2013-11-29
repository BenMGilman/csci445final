<?php
	session_start();
	include_once('dbaccess.php');
	
	$user_id = $_POST['user'];

	$query = "select * from users where id=?;";
	$stmt = $db->prepare($query);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	
	$lquery = "select * from login where id=?;";
	$stmt = $db->prepare($lquery);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$lresult = $stmt->get_result();
	$login = $lresult->fetch_assoc();
	
	$cquery = "select * from comments where user_id=?;";
	$stmt = $db->prepare($cquery);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$cresult = $stmt->get_result();
	$num_comments = $cresult->num_rows;
	
	$pquery = "select * from posts where user_id=?;";
	$stmt = $db->prepare($pquery);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$presult = $stmt->get_result();
	$num_posts = $presult->num_rows;
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>USER PAGE</title>
</head>
<body>
<?php include_once('header.php'); ?>
<h1><?php echo $login['username']; ?></h1>
<?php
// gets the image source from the database
	echo '<img src="'.$user['photo'].'" alt = "photo" width="140" height="140"/><br>';
?>
<table id ="diffuserinfo">
	<tr>
		<td>First Name: </td>
		<td><?php echo $user['fname']?></td>
	</tr>
	<tr>
		<td>Last Name: </td>
		<td><?php echo $user['lname']?></td>
	</tr>
	<tr>
		<td>Email: </td>
		<td><?php echo $user['email']?></td>
	</tr>
	<tr>
		<td>Status: </td>
		<td><?php echo $user['status']?></td>
	</tr>
</table>
<h3>Your Activity:</h3>
<?php
	echo '<div id="diffposts">';
	echo '<h4>Posts:</h4>';
	if($num_posts <= 0)
		echo 'No Recent Posts';
	else{
		for ($i=0; $i<$num_posts; $i++){
			$post = $presult->fetch_assoc();
			echo '<div class="posting">';
			echo '<table>';
			echo '<tr><td>'.$post['post_date'].'</td></tr>';
			echo '<tr><td id="key">'.$post['keyphrase'].'</td></tr>';
			echo '<tr><td>'.$post['post'].'</td></tr>';
			echo '</table>';
			echo '</div>';
		}
	}
	
	echo '<h4>Comments:</h4>';
	if($num_comments <= 0)
		echo 'No Recent Comments';
	else{
		for ($i=0; $i<$num_comments; $i++){
			$comment = $cresult->fetch_assoc();
			echo '<div class="posting">';
			echo '<table>';
			echo '<tr><td>'.$comment['post_date'].'</td></tr>';
			echo '<tr><td>'.$comment['comment'].'</td></tr>';
			echo '</table>';
			echo '</div>';
		}
	}
	echo '</div>';
?>
</body>
</html>