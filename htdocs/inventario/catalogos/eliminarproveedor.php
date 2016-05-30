<?php include("../menu2.inc");?>
ELIMINAR PROVEEDOR
<br>
<form action="eliminarproveedor.php" method=get>
<input type="text" class=textfield  name="cprov">
<br>
<input type="submit" value="eliminar">
</form>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");

if(urlencode(@$_REQUEST['cprov']) != ""){
    $cprov=mysql_real_escape_string($_REQUEST['cprov']);
    mysql_query ("delete from proveedores where cprov='$cprov';");
	mysql_query ("delete from entradas_y_salidas where cprov='$cprov';");
    echo "<br>proveedor $cprov y productos eliminados. los productos fueron eliminados de las entradas y salidas";
}
?>

<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>	