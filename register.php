<html>
<head>
	<title>REGISTER PAGE</title>
</head>
<body>
<h1>REGISTER PAGE</h1>

<form action="login.php" method="post">
<table border="0">
<tr>
	<td colspan="2" align="left">First Name <input type="text" name="custname" size="20" maxlength="20" required/></td>
</tr>
<tr>
	<td colspan="2" align="left">Last Name <input type="text" name="custname" size="20" maxlength="20" required/></td>
</tr>
<tr>
	<td colspan="2" align="left">Username <input type="text" name="custname" size="20" maxlength="20" required/></td>
</tr>
<tr>
	<td colspan="2" align="left">Password <input type="password" name="custname" size="20" maxlength="20" required/></td>
</tr>
<tr>
	<td>Animal</td>
	<td align="center"><input type="text" name="animalqty" size="3" maxlength="3" /></td>
	<td><select name="type">
		<?php
		   // reset to the first item (have already printed menu)
		   $result->data_seek(0);
		   for ($i=0; $i<$num_results; $i++)
		   {
			 $row = $result->fetch_assoc();
			 $animal = stripslashes($row['name']); 
			 $itype = stripslashes($row['itype']);
			 if($itype == 'animal'){
				echo  '<option value = "'.$animal.'">'.$animal.'</option>';
			 }
		  }
		?>
		</select>
	</td>
</tr>
<tr>
	<td>Food</td>
	<td align="center"><input type="text" name="foodqty" size="3" maxlength="3" /></td>
</tr>
<tr>
	<td>Toys</td>
	<td align="center"><input type="text" name="toyqty" size="3" maxlength="3" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Submit Order" /></td>
</tr>
</table>
</form>
</body>
</html>