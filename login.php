<html>
<head>
	<title>CSM ADVICE</title>
</head>
<body>
<h1>CSM ADVICE</h1>

<form action="checklogin.php" method="post">
<input type="hidden" name="loginflag" value="0"/>
<table border="0">
<tr>
	<td>Username: </td>
	<td colspan="2"><input type="text" name="username" autocomplete="on" size="18" maxlength="15"/></td>
</tr>
<tr>
	<td>Password: </td>
	<td colspan="2"><input type="password" name="userpass" size="18" maxlength="15"/></td>
</tr>
<tr>
	<td colspan="1"><input type="submit" value="Login"/></td>
	<td colspan="1"><input type="button" value="Guest" onclick="location.href='homepage.php'"/></td>
	<td colspan="1"><input type="button" value="Register" onclick="location.href='register.php'"/></td>
</tr>
</table>
</form>
</body>
</html>