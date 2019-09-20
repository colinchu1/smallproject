<?php

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
$name=sanitize_input($_POST['name1']); // Fetching Values from URL.
$email=sanitize_input($_POST['email1']);
$fname=sanitize_input($_POST['fname1']);
$lname=sanitize_input($_POST['lname1']);
$password= sha1($_POST['password1']); // Password Encryption, If you like you can also leave sha1.
// Check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.......";
}else{
$result = sqlsrv_query($conn,"SELECT * FROM userinfo WHERE email='$email'");
$data = sqlsrv_num_rows($result);
if(($data)==0){
$query = sqlsrv_query($conn,"insert into userinfo(username, email, firstname, lastname, passwords) values ('$name', '$email', '$fname','$lname','$password')"); // Insert query
if($query){
echo "You have Successfully Registered.....";
}else
{
echo "Error....!!";
}
}else{
echo "This email is already registered, Please try another email...";
}
}
sqlsrv_close ($conn);
?>