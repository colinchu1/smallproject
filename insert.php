<?php
session_start();
$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:contactmanager.database.windows.net,1433";
$connect = sqlsrv_connect($serverName, $connectionInfo);

if( $connect === false ) 
{
     die( print_r( sqlsrv_errors(), true));
}

function sanitize_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }
$ID = $_SESSION['ID'];
if(isset($_POST["first_name"], $_POST["last_name"]))
{
 $first_name = sanitize_input($_POST["first_name"]);
 $last_name = sanitize_input($_POST["last_name"]);
 $email = sanitize_input($_POST["email"]);
 $phone = sanitize_input($_POST["phone"]);
 $street_address = sanitize_input($_POST["street_address"]);
 $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
 echo "Invalid Email.......";
 }
 else{
 $query = "INSERT INTO CONTACTS(firstname, lastname, phone, email, street_address, ID) VALUES('$first_name', '$last_name', '$email', '$phone', '$street_address','$ID')";
 if(sqlsrv_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
}
?>