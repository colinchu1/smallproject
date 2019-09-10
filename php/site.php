<?php

	$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
	$serverName = "tcp:contactmanager.database.windows.net,1433";
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	if( $conn === false ) 
	{
		 die( print_r( sqlsrv_errors(), true));
	}
	else{
		//we can get the information throught JSON instead of post form
		$phone =  $_POST['username'];
		$address = $_POST['address'];
		$firstname = $_POST['first'];
		$lastname = $_POST['last'];
		$email = $_POST['email'];
		
		
		$stmt = sqlsrv_query( $conn, "SELECT * FROM CONTACTS WHERE phone = '$phone'" , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count = sqlsrv_num_rows( $stmt );
		
		if($row_count > 0)
		{
			echo "phone number already exist";
		}
		else
		{
			$sql = "INSERT INTO CONTACTS (email,phone,firstname,lastname,street_address)
			VALUES ('$email','$phone','$firstname','$lastname', '$address')";
			$stmt = sqlsrv_query($conn,$sql);
			if($stmt == false)
			{
				die (print_r(sqlsrv_errors(), true));
			}
			echo "inserted";
		}
	}
	
	if(//no error){
		//sendback json
	}
	
	//a function to get data from json
	function getJson(){
		
	}
	
	//function to send the result as json
	function sendJson()
	{
		
	}
	
?>