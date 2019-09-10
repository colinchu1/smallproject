<?php
		
		$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
		$serverName = "tcp:contactmanager.database.windows.net,1433";
		$conn = sqlsrv_connect($serverName, $connectionInfo);
	
		if( $conn === false ) 
		{
			 die( print_r( sqlsrv_errors(), true));
		}
		//check for duplicates
		
		
		$username =  $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['first'];
		$lastname = $_POST['last'];
		$email = $_POST['email'];
		
			
		//if username is taken
		$stmt = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE username = '$username'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count = sqlsrv_num_rows( $stmt );  
		$stmt2 = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE email = '$email'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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