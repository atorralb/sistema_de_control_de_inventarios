<?php include("../menu2.inc");?>
 <body>   
<TABLE>
<TH>CODIGO</TH><th>NOMBRE</th><th>DOMICILIO</th><th>CIUDAD</th><th>TEL</th><th>FAX</th><th>RFC</th>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");
if(!isset($_GET['page'])){  $page = 1; } else { $page = $_GET['page'];} $max_results = 30;  $from = (($page * $max_results) - $max_results); 
function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}
$query = "SELECT * FROM proveedores ORDER BY cprov ASC LIMIT $from, $max_results;";
$result = mysql_query($query);
while( $row = mysql_fetch_array($result))
{
echo  
'<tr><td>',$row['cprov'], 
'</td><td>',$row['nombre'],
'</td><td>', $row['domicilio'],
'</td><td>', $row['ciudad'],
'</td><td>',$row['tel'],
'</td><td>',$row['fax'],
'</td><td>',$row['rfc'],
'</td><td><a href="productosxproveedor.php?cprov=',$row['cprov'],'">productos</a></td></tr>';
echo "\n";
}
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM proveedores"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>seleccionar pagina<br />"; 
if($page > 1)
{    
$prev = ($page - 1); 
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\"><<Previa</a>&nbsp;"; 
} 
for($i = 1; $i <= $total_pages; $i++){   if(($page) == $i){ echo "$i&nbsp;"; } else { echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a>&nbsp;"; } } 
if($page < $total_pages){ $next = ($page + 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">siguiente>></a>"; } 
echo "</center>"; 

?>
</TABLE>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</body>
</html>