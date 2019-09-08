<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title> </title>
	</head>
	<body>
		<form action = "site.php" method = "post">
			Username: <input type = "text" name = "Username">
			Password: <input type = "password" name = "Password">
			<input type = "submit">
		</form>
		<br>
		<?php 
			echo $_GET["Username"]
		
		
		?>
	</body>
</html>