<?php
	include_once('dbaccess.php');
	
	$query = "select * from status;";
	$result = $db->query($query);
	$num_results = $result->num_rows;
?>
<html>
<head>
	<title>REGISTER PAGE</title>
</head>
<body>
<h1>REGISTER PAGE</h1>

<form action="checklogin.php" method="post">
<input type="hidden" name="loginflag" value="1"/>
<table border="0">
<tr>
	<td>First Name: </td>
	<td><input type="text" name="fname" size="18" maxlength="15" required/></td>
</tr>
<tr>
	<td>Last Name: </td>
	<td><input type="text" name="lname" size="18" maxlength="15" required/></td>
</tr>
<tr>
	<td>Email: </td>
	<td><input type="email" name="email" size="30" maxlength="30" required/></td>
</tr>
<tr>
	<td>Username: </td>
	<td><input type="text" name="username" size="18" maxlength="15" required/></td>
</tr>
<tr>
	<td>Password: </td>
	<td><input type="password" name="userpass" size="18" maxlength="15" required/></td>
</tr>
<tr>
	<td>Status: </td>
	<td><select name="status">
		<?php
		   for ($i=0; $i<$num_results; $i++)
		   {
			 $row = $result->fetch_assoc();
			 $status_type = stripslashes($row['name']); 
			 echo  '<option value = "'.$status_type.'">'.$status_type.'</option>';
		  }
		?>
		</select>
	</td>
</tr>
<tr>
	<td><input type="submit" value="Register" /></td>
</tr>
</table>
</form>
</body>
</html>