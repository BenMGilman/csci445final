<?php  
 /* set up item prices */
  @ $db = new mysqli('localhost', 'root', '', 'csmadvice_445');
  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  $query = "select * from products;";
  $result = $db->query($query);
  $num_results = $result->num_rows;
  
  $pictures = array(	'coffee1.jpg', 'coffee2.jpg', 'coffee3.jpg',
						'muffin.jpg', 'muffin2.jpg');
						
  shuffle($pictures);
?>
<html>
<head>
	<title>REGISTER PAGE</title>
</head>
<body>
<h1>REGISTER PAGE</h1>
<div align="center">
<table width=100%>
<tr>
<?php
	for($i = 0; $i < 3; $i++){
		echo "<td align=\"center\"><img src=\"";
		echo $pictures[$i];
		echo "\"/></td>";
	}
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"3\" align=\"center\">";
	for ($i=0; $i<$num_results; $i++){
		$row = $result->fetch_assoc();
		echo '| '.stripslashes($row['name']);
		$price = stripslashes($row['price']);
		echo ' | '.number_format($price, 2);
		echo ' |<br />';	
	} 
	echo "</td>";	
?>
</tr>
</table>
</div>

<form action="processorder.php" method="post">
<table border="0">
<tr>
	<td colspan="2" align="left">Your Name <input type="text" name="custname" size="20" maxlength="20" required/></td>
</tr>
<tr bgcolor="#cccccc">
	<td width="200">Item</td>
	<td width="15">Quantity</td>
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