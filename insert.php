<?php
$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:contactmanager.database.windows.net,1433";
$connect = sqlsrv_connect($serverName, $connectionInfo);

if( $connect === false ) 
{
     die( print_r( sqlsrv_errors(), true));
}
if(isset($_POST["first_name"], $_POST["last_name"]))
{
 $first_name = $_POST["first_name"];
 $last_name = $_POST["last_name"];
 $email = $_POST["email"];
 $phone = $_POST["phone"];
 $street_address = $_POST["street_address"];
 $query = "INSERT INTO CONTACTS(firstname, lastname, phone, email, street_address) VALUES('$first_name', '$last_name', '$email', '$phone', '$street_address')";
 if(sqlsrv_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>