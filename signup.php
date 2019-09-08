<html>
	<head>
		<title> SignUp </title>
			<style media="all"> 
			
				body{
				background-color: rgb(180, 180, 180);
				}
				
			</style>
	<head>

	<body>
		<div class="TitleDiv"> 
		<h1 style = "text-align:center"> Welcome To Your Contact Manager </h1>
		</div>
		<br>
		<form action = "signup.php" method = "post">
			First name: <input type = "text" name = "first">
			<br>
			Last name: <input type = "text" name = "last" >
			<br>
			Username: <input type = "text" name = "username" >
			<br>
			Password: <input type = "password" name = "password" >
			<br>
			Email: <input type = "text" name = "email" >
			<br>
			<input type = "submit" value = "signup">
		</form>
		<?php
		
		$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
		$serverName = "tcp:contactmanager.database.windows.net,1433";
		$conn = sqlsrv_connect($serverName, $connectionInfo);
	
		//check for duplicates
		
		
		$username =  $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['first'];
		$lastname = $_POST['last'];
		$email = $_POST['email'];
			
		$sql_user = "SELECT * FROM userinfo WHERE username = '$username'";
		$sql_email = "SELECT * FROM userinfo WHERE email = '$email'";
		$res_user = sqlsrv_query($conn, $sql_user);
		$res_email = sqlsrv_query($conn, $sql_email);
		
		echo $res_user;
		//if username is taken
		$stmt = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE username = '$username'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count = sqlsrv_num_rows( $stmt );  
		$stmt2 = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE username = '$email'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count2 = sqlsrv_num_rows( $stmt2 );  
		echo "$row_count2";
		echo "$row_count";
		if($row_count > 0)
		{
			$errmsg_user = "the username is taken";
			echo "username taken";
		}
		else if($row_count2 > 0)
		{
			$errmsg_email = "the email is taken";
			echo "mail taken";
		}
		else
		{
			$sql = "INSERT INTO userinfo (username, passwords,firstname,lastname,email)
			VALUES ('$username','$password','$firstname','$lastname', '$email')";
			$stmt = sqlsrv_query($conn,$sql);
			if($stmt == false)
			{
				die (print_r(sqlsrv_errors(), true));
			}
			echo "inserted";
		}
		
		
		
		sqlsrv_close( $conn );
		?>
	</body>
</html>