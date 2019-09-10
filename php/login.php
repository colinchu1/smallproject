<?php

	$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
	$serverName = "tcp:contactmanager.database.windows.net,1433";
	$conn = sqlsrv_connect($serverName, $connectionInfo);
		
	if( $conn === false ) 
	{
		 die( print_r( sqlsrv_errors(), true));
	}
	else
	{
		$username =  $_POST['username']; //we can put data we get from json package
		$password = $_POST['password'];
		
		//check if username and password exist
		$stmt = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE username = '$username'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count = sqlsrv_num_rows( $stmt );  
		$stmt2 = sqlsrv_query( $conn, "SELECT * FROM userinfo WHERE passwords = '$password'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count2 = sqlsrv_num_rows( $stmt2 );  
		if($row_count < 1)
		{
			echo "no username found";
		}
		else if($row_count2 < 1)
		{
			echo "wrong passwords";
		}
		sqlsrv_close( $conn );
	}
	
	
	//a function to get data from json
	function getJson(){
		
	}
	
	//function to send the result as json
	function sendJson()
	{
		
	}

?>