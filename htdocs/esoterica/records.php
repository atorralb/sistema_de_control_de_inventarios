<?php
require_once('inc/setup_idiorm.php');


$t=$_GET['t'];
$records = ORM::for_table('records')->where('t', $t)->find_many();  
foreach ($records as $record) {
    echo "<b>test</b>";
}


?>