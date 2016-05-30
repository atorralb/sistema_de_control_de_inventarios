
<?php
require_once("config/db.php");
require_once("classes/Database.class.php");
require_once("classes/Login.class.php");
// class autoloader function, this includes all the classes that are needed by the script
// you can remove this stuff if you want to include your files manually
//create a database connection
$db    = new Database();
// start this baby and give it the database connection
$login = new Login($db);


if ($login->isUserLoggedIn()) {
    $mysqli = new mysqli("localhost", "root", "", "pos");
    if ($mysqli->connect_errno) {echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;}
    include 'config/setup_idiorm.php';
    include 'ui/elements.php'; 
    include "scripts.inc";
    echo $elements['display-header']; 
    echo $elements['display-sidebar']; 
    echo $elements['start-playground'];
    
    echo '<div class="one-half">
                <div class="box">
                    <div class="inner">
                    <form class="form-horizontal">
              <fieldset>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-calendar"></i></span><input type="text" name="range" id="range">
                </div>
              </fieldset>
            </form>
                        <div class="titlebar"><span class="icon awesome white beaker"></span> <span class="w-icon">Inventario</span></div>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Producto</th>
                                    <th>Entradas</th>
                                    <th>Salidas</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>';                               
 $today = date("Y-m-d");
/*
$mysqli ->real_query("SELECT  productid, productdescription, 
                        sum(if(movement='in'  AND date <='$today', quantity, 0)) - sum(if(movement='out'  AND date <='$today', quantity, 0))  as initialinventory,
                        sum(if(movement='in' AND date >='2008-09-01' and date <='2013-09-01', quantity, 0)) as ins,
                        sum(if(movement='out' AND date >='2008-09-01' and date <='2013-09-01', quantity, 0)) as outs,
                        sum(if(movement='out' AND date >='2008-09-01' and date <='2013-09-01', quantity, 0)) as finalinventory
                        FROM records 
                        group by productid ");
*/
$mysqli ->real_query("SELECT  pid, product, 
                        sum(if(movement='in'  AND date <='$today', quantity, 0)) - sum(if(movement='out'  AND date <='$today', quantity, 0))  as stock,
                         sum(if(movement='in' AND date >='2008-09-01' and date <='2013-09-01', quantity, 0)) as adquisitions,
                         sum(if(movement='out' AND date >='2008-09-01' and date <='2013-09-01', quantity, 0)) as sales

                        FROM records 
                        group by pid ");

$res = $mysqli->use_result();

while ($row = $res->fetch_assoc()) {

    echo "<tr class='gradeX'>";
    echo "<td>".$row['pid']."</td>";
    echo "<td>".$row['product']."</td>";
    echo "<td>".$row['adquisitions']."</td>";
    echo "<td>".$row['sales']."</td>";
    echo "<td>".$row['stock']."</td>";
    echo "</tr>\n";

}
echo '</tbody>
    <tfoot>
    <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Entradas</th>
                                    <th>Salidas</th>
                                    <th>Stock</th>
                                </tr>
                            </tfoot>
                        </table> 
                        <div class="clear"></div>';
echo $elements['end-playground'];
    }

?>
