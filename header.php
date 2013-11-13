<?php
	echo 	'<nav class="navbar">
				<div id="header">
					<div id="right">
						Welcome '; echo $username; 
						echo ' | 
						<a href="userpage.php">Profile</a> | <a href="index.php" >Sign Out</a>
					</div>
					<ul id="pagenav">
						<li><a href="homepage.php" method="post">Home</a></li>
						<li><a href="homepage.php" method="post">Courses</a></li>
						<li><a href="homepage.php" method="post">Teachers</a></li>
						<li><a href="homepage.php" method="post">General</a></li>
					</ul>
					<br />
				</div>
			</nav>';
?>