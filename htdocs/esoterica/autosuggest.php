<?php
//include 'config/setup_idiorm.php';
$mysqli = new mysqli("localhost", "root", "", "pos");
if ($mysqli->connect_errno) {
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$queryString = $_REQUEST['q'];
$mysqli->real_query("SELECT description as name, id, category, pfs, storecode FROM products WHERE `storecode` LIKE '".$queryString."%' OR `barcode` LIKE '".$queryString."%' OR `description` LIKE '".$queryString."%' OR `category` LIKE '".$queryString."%' ");
$res = $mysqli->use_result();
$json = array();
while ($row = mysqli_fetch_assoc($res)) {
  $json[] = array_map('utf8_encode', $row);
}
/*
$json = array();
$queryString = $_REQUEST['q'];
$ps = ORM::for_table('products')->where_like('storecode', '%'.$queryString.'%')->where_like('description', '%'.$queryString.'%')->find_many();
foreach ($ps as $p) {
$json[] = array_map('utf8_encode', $products);
echo $p->id;
}
*/
header('Content-Type: application/json; Charset=UTF-8');
print(json_encode($json));
?>