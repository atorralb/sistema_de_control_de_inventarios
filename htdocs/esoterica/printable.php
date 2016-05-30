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

    include 'config/setup_idiorm.php';
echo '
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Moviemientos</title>
        <meta name="robots" content="index, follow"/>
        <link rel="stylesheet" href="printable/bootstrap.css"/>
        <link rel="stylesheet" href="printable/responsive.css"/>
        <link rel="stylesheet" href="printable/all.css"/>
        <link rel="shortcut icon" href="favicon.png" type="image/png"/>
    </head>
    <body>
        <div class="site-wrapper">
            <header class="site-header">
                <div class="site-title"><a href="/query.php">Tienda Esoterica</a></div>
            </header>
            <div class="content">
                <div class="gittip center alert alert-info">
                    <!--<strong>Movimientos de></strong>-->
                </div>';
       if (isset($_REQUEST['action'])){
            $d = ORM::for_table('records')->where('id',$_REQUEST['id']);
            $d->delete_many();
            echo "record eliminado ";
            echo '<a href="query.php">regresar a query</a>';
    }

if (isset($_REQUEST['byproduct'])){

    $storecode = $_REQUEST['storecode'];
    $movement = urlencode(@$_REQUEST['movement']);
    $product = ORM::for_table('products')->where('storecode',$storecode)->order_by_desc('id')->find_one();
    $records = ORM::for_table('records')->where('movement',$_REQUEST['movement'])->where('pid',$product->id)->order_by_desc('date')->find_many();
    echo '<div class="gittip center alert alert-info">
        <strong>Movimientos De </strong> '.$product->storecode.' '.$product->description. ' </div><pre> <code>';
    echo '<table><th>cantidad</th><th>folio</th><th>fecha</th>';   
    foreach ($records as $record){
        echo '<tr><td>'.$record->quantity.'</td><td>'.$record->folio.'</td><td>'.$record->date.'</td><td><a href="printable.php?action=delete&id='.$record->id.'&storecode='.$_REQUEST['storecode'].'&movement='.$_REQUEST['movement'].'">X</a></td></tr>';
        }
    }
if (isset($_REQUEST['byproduct_all'])){

    $storecode = $_REQUEST['storecode'];
    $product = ORM::for_table('products')->where('storecode',$storecode)->order_by_desc('id')->find_one();
    $records = ORM::for_table('records')->where('pid',$product->id)->order_by_desc('date')->find_many();
    echo '<div class="gittip center alert alert-info">
        <strong>Movimientos De </strong> '.$product->storecode.' '.$product->description. ' </div><pre> <code>';
    echo '<table><th>cantidad</th><th>folio</th><th>moviemiento</th><th>fecha</th>';   
    foreach ($records as $record){
        if ($record->movement =='IN'){
        echo '<tr><td>'.$record->quantity.'</td><td>'.$record->folio.'</td><td>ENTRADA</td><td>'.$record->date.'</td><td><a href="printable.php?action=delete&id='.$record->id.'orecode='.$_REQUEST['storecode'].'&movement='.$record->movement.'">X</a></td></tr>';
        }
        if ($record->movement =='OUT'){
        echo '<tr><td>'.$record->quantity.'</td><td>'.$record->folio.'</td><td>SALIDA</td><td>'.$record->date.'</td><td><a href="printable.php?action=delete&id='.$record->id.'orecode='.$_REQUEST['storecode'].'&movement='.$record->movement.'">X</a></td></tr>';
        }
        }
    }

if (isset($_REQUEST['byfolio'])){
    //$records = ORM::for_table('records')->where('folio',$_REQUEST['folio'])->order_by_desc('id')->find_many();
	$records = ORM::for_table('records')->join('products', array('records.pid', '=', 'products.id'))->where('folio',$_REQUEST['folio'])->find_many();
	
    echo '<div class="gittip center alert alert-info">
        <strong>Movimientos De Folio #</strong> '.$_REQUEST['folio'].' 
		</div>
		
		<pre> <code>';
		
    echo '<table><th>cantidad</th><th>codigo</th><th>producto</th><th>fecha</th>';
    foreach ($records as $record){
        echo '<tr><td>'.$record->quantity.'</td><td>'.$record->storecode.'<td>'.$record->product.'</td><td>'.$record->date.'</td><td><a href="printable.php?action=delete&id='.$record->id.'">X</a></td></tr>';
        }

}

if (isset($_REQUEST['addtofolio'])){
    $storecode = $_REQUEST['storecode'];
    
    $product = ORM::for_table('products')->where('storecode',$storecode)->order_by_desc('id')->find_one();
    $r = ORM::for_table('records')->where('folio',$_REQUEST['folio'])->find_one();

    $add = ORM::for_table('records')->create();
    $add->folio =           $r->folio;
    $add->t =               '1';
    $add->pid =             $product->id;
    $add->product =         $product->description;
    $add->quantity =        $_REQUEST['quantity'];
    $add->price=            $product->cost;
    $add->pfs=              $product->pfs;
    $add->movement=         $r->movement;
    $add->date=             $r->date;
    $add->user=             $_SESSION['user_name'];
    $add->client_name=      $r->client_name;
    $add->client_agent=     $r->client_agent;
    $add->client_address=   $r->client_address;
    $add->client_city=      $r->client_city;
    $add->client_zipcode=   $r->client_zipcode;
    $add->client_rfc=       $r->client_rfc;
    $add->concept=          $r->concept;
    $add->save();
    echo 'record anexado';
    echo '<a href = "query.php">regresar a query </a>';
    //echo '<table><th>cantidad</th><th>folio</th><th>fecha</th>';   
    //foreach ($records as $record){
    //    echo '<tr><td>'.$record->quantity.'</td><td>'.$record->folio.'</td><td>'.$record->date.'</td><td><a href="printable.php?action=delete&id='.$record->id.'&storecode='.$_REQUEST['storecode'].'&movement='.$_REQUEST['movement'].'">X</a></td></tr>';
    //    }
}
            if (isset($_REQUEST['bycategory'])){
                $category =$_REQUEST['category'];
                $start_date =$_REQUEST['start_date'];
                $end_date = $_REQUEST['end_date'];

                $dbh = new PDO("mysql:host=127.0.0.1;dbname=pos", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                   
                $STH = $dbh->query("SELECT
                   @entradas:= sum(if(t='1' AND movement ='IN' AND date >='$start_date' and date <='$end_date', quantity, 0)) as entradas, 
                   @salidas:= sum(if(t='1' AND movement ='OUT' AND date >='$start_date' and date <='$end_date', quantity, 0)) as salidas,
                   sum(if(t='1' AND movement ='IN' AND date <'$start_date', quantity, 0)) - sum(if(t='1' AND movement ='OUT' AND date <'$start_date', quantity, 0))  as inventarioinicial,
                   sum(if(t='1' AND movement ='IN' AND date  <='$end_date', quantity, 0)) - sum(if(t='1' AND movement ='OUT' AND date <='$end_date', quantity, 0)) as inventariofinal,
                    records.pid, products.description, products.category, products.storecode
                FROM 
                   records
                inner join 
                        products products on records.pid = products.id
                WHERE
                   products.category ='$category'
                group by products.id;");
                echo '<div class="gittip center alert alert-info">
                    <strong>Movimientos De </strong> '.$category.' de '. $start_date. ' a '.$end_date. '</div><pre> <code>';
                echo '<table><th>codigo</th><th>producto</th><th>inventario inicial</th><th>entradas</th><th>salidas</th><th>   inventario final</th>';
                $STH->setFetchMode(PDO::FETCH_ASSOC); 
                while($row = $STH->fetch()) {
                    echo '<tr><td>'.$row['storecode'] . "</td>";
                    echo '<td>'.$row['description'] . "</td>";
                    echo '<td  ALIGN="Center">'.$row['inventarioinicial'] . "</td> ";
                    echo '<td ALIGN="Center">'.$row['entradas'] . "</td> ";
                    echo '<td ALIGN="Center">'.$row['salidas'] . "</td> ";
                    echo '<td ALIGN="Center">'.$row['inventariofinal'] . "</td></tr>";
                }
            }

echo '</table></code></pre>
            </div>
            <footer class="site-footer">
                <p class="credits">
                    Released under the <a href="/license">MIT Public License</a>.<br/>
                    &copy; 2013, <a href="https://github.com/angeltduran" target="_blank">.</a>.
                </p>
            </footer>
        </div>
    </body>
</html>';

}
else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }
