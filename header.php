<?php
	echo 	'<nav class="navbar">
				<div id="header">
					<div id="right">
						Welcome <?php echo $username; ?> | <a href="userpage.php" style="text-decoration: none">Profile</a> | <a href="index.php" style="text-decoration: none">Sign Out</a>
					</div>
					<ul id="pagenav">
						<li style="list-style-type: none"><a href="homepage.php">Home</a></li>
						<li style="list-style-type: none"><a href="homepage.php">Courses</a></li>
						<li style="list-style-type: none"><a href="homepage.php">Teachers</a></li>
						<li style="list-style-type: none"><a href="homepage.php">Books</a></li>
					</ul>
				</div>
			</nav>';
?>