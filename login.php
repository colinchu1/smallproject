<?php
session_start();
$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:contactmanager.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if( $conn === false ) 
{
    die( print_r( sqlsrv_errors(), true));
}
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$username=sanitize_input($_POST["user_name"]);
$password=sha1(sanitize_input($_POST["password"]));
$query = "SELECT * FROM  userinfo WHERE username = '$username' and passwords = '$password'";
$result = sqlsrv_query($conn,$query, array(), array( "Scrollable" => 'static' ));
$data = sqlsrv_num_rows($result);


if($data>0)
{
	$data=sqlsrv_fetch_array($result);
        
        $_SESSION["ID"]=$data["ID"];
     	$_SESSION["username"]=$data["username"];
     	
		echo 1;
}else if($data == false){
	echo 2;					
    }
    else {
        echo 0;
    }						
	
?>