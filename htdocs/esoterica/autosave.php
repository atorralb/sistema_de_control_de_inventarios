<?php

$mysqli = new mysqli("localhost", "root", "September1", "pos");
if ($mysqli->connect_errno) {echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;}

 if (isset($_REQUEST['new_user_id'])) {
$user_name=urldecode(@$_REQUEST['value']);
$mysqli->real_query("INSERT INTO users(user_name, join_date) VALUES ('".$user_name."', CURDATE()) ");

}


 if (isset($_REQUEST['user_password'])) {
$user_name=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET user_password_hash='".$user_name."' WHERE user_id='".$user_id."'  ");
}

if (isset($_REQUEST['slogan'])){
$slogan=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET slogan='".$slogan."' WHERE id='1' ");
}


if (isset($_REQUEST['user_email'])){
$string=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET user_email='".$string."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['user_can_delete_records'])){
$string=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET can_delete_records='".$string."' WHERE user_id='".$user_id."' ");
}


if (isset($_REQUEST['phone'])){
$value=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET phone='".$value."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['cel'])){
$string=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET cel='".$string."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['birthdate'])){
$string=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET birthdate='".$string."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['position'])){
$value=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET position='".$value."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['user_rfc'])){
$rfc=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET rfc='".$rfc."' WHERE user_id='".$user_id."' ");
}

if (isset($_REQUEST['imss'])){
$rfc=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET imss='".$rfc."' WHERE id='".$user_id."' ");
}

if (isset($_REQUEST['user_curp'])){
$value=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET curp='".$value."' WHERE id='".$user_id."' ");
}

if (isset($_REQUEST['street_name'])){
$value=urldecode(@$_REQUEST['value']);
$user_id=urldecode(@$_REQUEST['user_id']);
$mysqli->real_query("UPDATE users SET street_name='".$value."' WHERE id='".$user_id."' ");
}

if (isset($_REQUEST['address_number'])){
$address_number=urldecode(@$_REQUEST['value']);
$value=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE users SET address_number='".$value."' WHERE id='".$user_id."' ");
}

if (isset($_REQUEST['address_colony'])){
$address_colony=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET address_colony='".$address_colony."' WHERE id='1' ");
}

if (isset($_REQUEST['address_county'])){
$address_county=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET address_county='".$address_county."' WHERE id='1' ");
}

if (isset($_REQUEST['address_state'])){
$address_state=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET address_state='".$address_state."' WHERE id='1' ");
}

if (isset($_REQUEST['address_zipcode'])){
$address_zipcode=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET address_zipcode='".$address_zipcode."' WHERE id='1' ");
}

if (isset($_REQUEST['address_country'])){
$address_country=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET address_country='".$address_country."' WHERE id='1' ");
}

if (isset($_REQUEST['tel'])){
$tel=urldecode(@$_REQUEST['value']);
$mysqli->real_query("UPDATE company SET tel='".$tel."' WHERE id='1' ");
}



else{echo "noth9ing";}
?>