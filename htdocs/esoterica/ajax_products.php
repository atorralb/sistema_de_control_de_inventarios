<?php
include 'config/setup_idiorm.php';
// Detect if there was XHR request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$fields = array('row', 'column', 'text');
	//HERE we convert the $_POST[column] into a number eg. 0 = supplier, 1 = category
	$sqlFields = array('supplier', 'category', 'unit', 'description', 'cost', 'pfs', 'pfw', 'barcode', 'storecode');

	foreach ($fields as $field) {
		if (!isset($_POST[$field]) || strlen($_POST[$field]) <= 0) {
			sendError('No correct data');
			exit();
		}
	}


/*	$db = new mysqli('localhost', 'root', '', 'pos');
	$db->set_charset('utf8');
	if ($db->connect_errno) {
		sendError('Connect error');
		exit();
	}

	$userQuery = sprintf("UPDATE products SET %s='%s' WHERE id=%d",
			$sqlFields[intval($_POST['column'])],
			$db->real_escape_string($_POST['text']),
			$db->real_escape_string(intval($_POST['row'])));
	$stmt = $db->query($userQuery);
	if (!$stmt) {
		sendError('Update failed');
		exit();
	}
*/

ORM::for_table('products')->where('id', intval($_POST['row']))->find_result_set()
->set($sqlFields[intval($_POST['column'])], $_POST['text'])
->save();
}

header('Location: products.php');
function sendError($message) {
	header($_SERVER['SERVER_PROTOCOL'] .' 320 '. $message);
}
