<?php
//fetch.php
$connectionInfo = array("UID" => "colin@contactmanager", "pwd" => "{COP4331proj}", "Database" => "information", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
 $serverName = "tcp:contactmanager.database.windows.net,1433";
  $connect = sqlsrv_connect($serverName, $connectionInfo);

 if( $connect === false ) 
 {
        die( print_r( sqlsrv_errors(), true));
 }
$query = "SELECT * FROM CONTACTS ";

$columns = array('firstname', 'lastname', 'email', 'phone', 'street_address');

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR last_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR email LIKE "%'.$_POST["search"]["value"].'%"
 OR phone LIKE "%'.$_POST["search"]["value"].'%"
 OR street_address LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY CONTACT_ID DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$query = "SELECT * FROM CONTACTS ";
$result = sqlsrv_query($connect,$query);
$number_filter_row = sqlsrv_num_rows(sqlsrv_query($connect, $query));
$data = array();

while($row = sqlsrv_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CONTACT_ID"].'" data-column="firstname">' . $row["firstname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CONTACT_ID"].'" data-column="lastname">' . $row["lastname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CONTACT_ID"].'" data-column="email">' . $row["email"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CONTACT_ID"].'" data-column="phone">' . $row["phone"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["CONTACT_ID"].'" data-column="street_address">' . $row["street_address"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["CONTACT_ID"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM CONTACTS";
 $result = sqlsrv_query($connect, $query);
 return sqlsrv_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>