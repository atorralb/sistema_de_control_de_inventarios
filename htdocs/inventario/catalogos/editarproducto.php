<?php include("../menu2.inc");?>
<body>
<form action="productosxproveedor.php?accion=actualizarproducto" method="post">
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");
$id= $_SERVER['QUERY_STRING'];
$pyc = explode("&", $id);

function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}

$result = mysql_query("SELECT * FROM productos where cprov = '$pyc[0]' AND cprod = '$pyc[1]';");

while($row = mysql_fetch_array($result))
{
echo ' <input type ="text" value="'.$row['cprov'].'" name="cprov">cprov 		
	 <br><input type="text" value="'.$row['cprod'].'" name="cprod">cprod		
	 <br><input type="text" value="'.$row['descripcion'].'" name="descripcion">descripcion	
	 <br><input type="text" value="'.$row['costodecompra'].'" name="costodecompra">costodecompra	
	  <br><input type="text" value="'.$row['pv2'].'" name="pv2">precio de venta deseado	
	 <br><input type="text" value="'.$row['tasa15'].'" name="tasa15">tasa15		
	 <br><input type="text" value="'.$row['tasa0'].'" name="tasa0">tasa0		
	 <br><input type="text" value="'.$row['unidad'].'"	name="unidad">unidad
	<br><input type="text" value="'.$row['precio_mayoreo'].'" name="precio_mayoreo">precio de mayoreo<br>';
	 echo "\n";
}
?>
<input type="submit" value="aplicar cambios">
</form>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</body>

</html>
