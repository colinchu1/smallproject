<?php
$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:contactmanager.database.windows.net,1433";
$connect = sqlsrv_connect($serverName, $connectionInfo);

if( $connect === false ) 
{
     die( print_r( sqlsrv_errors(), true));
}
if(isset($_POST["id"]))
{
 $value = $_POST["value"];
 $query = "UPDATE CONTACTS SET ".$_POST["column_name"]."='".$value."' WHERE CONTACT_ID = '".$_POST["id"]."'";
 if(sqlsrv_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>