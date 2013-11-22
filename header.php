<?php
	echo 	'<nav class="navbar">
				<div id="header">
					<div id="left">
						Welcome '; echo $_SESSION['username'];
						$signinout = "Sign Out";
						if($_SESSION['username'] == "guest") $signinout = "Sign In";
						echo ' | 
						<a href="userpage.php">Profile</a> | <a href="index.php" >'.$signinout.'</a>
					</div>
					<div id="right">
						<form action="'; echo $_SESSION["return_page"].".php"; echo'" method="post">';
						if($_SESSION['return_page']!="userpage" && $_SESSION['return_page']!="index" && $_SESSION['return_page']!="register" && $_SESSION['return_page']!="homepage"){
						echo '
							<input id="searchbar" type="text" name="search" autocomplete="on" size="18" maxlength="15"/>
							<input type="submit" value="Search"/>';
						}
					echo '</div>
					<ul id="pagenav">
						<li><a href="homepage.php" method="post">Home</a></li>
						<li><a href="coursepage.php" method="post">Courses</a></li>
						<li><a href="teacherpage.php" method="post">Teachers</a></li>
						<li><a href="socialpage.php" method="post">Social</a></li>
						<li><a href="degreepage.php" method="post">Degree</a></li>
						<li><a href="generalpage.php" method="post">General</a></li>
						</form>
					</ul>
					<br />
				</div>
			</nav>';
?>