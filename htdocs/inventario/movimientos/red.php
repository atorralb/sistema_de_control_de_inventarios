<?
session_start();
?>
<HTML>
<head>
<TABLE>
<th>FOLIO</th><th>FECHA</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th><tr>
<?echo "<td>$folio</td><td>$fecha</td><td>$concepto</td><td>$ne</td><td>$nr</td><td>$na</td>"?>   
</tr>
</table>
</head>
<STYLE>
@import url(../gui.css);
</STYLE>
<BODY>
<form action=red.php method=get>
<table>
<tr><td>CANTIDAD:</td><td><input type=text class=textfield name="cantidad"></td></tr>
<tr><td>PROVEEDOR</td><td> <input type=text class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td> <input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit value="insertar"></td></tr>
</table>
</form>
<TABLE>
<th>CANTIDAD</th><th>PROVEEDOR</th><th>CODIGO</th><th>S.P.C.C</th><th>S.P.P.V</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>COMANDO</th>
<?
mysql_connect("localhost","root","");
mysql_select_db("inventario");
function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}
if($action=="del"){mysql_query("DELETE FROM red WHERE id=$id;");}
//codigo para no introducir productos no existentes
$buscarproducto = mysql_query("select * from productos where cprov ='$cprov' and cprod = '$cprod';"); 
$existeproducto = mysql_fetch_array($buscarproducto);
if($cprov != "" && $cprod != "" && $cantidad != "") { mysql_query("INSERT INTO red (f, cprov, cprod, cantidad) VALUES ('$folio', '".$existeproducto['cprov']."', '".$existeproducto['cprod']."', '$cantidad' );");}

$result=mysql_query("SELECT  
if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv, 
red.cantidad*productos.costodecompra AS spcc,  red.id, red.cprov, red.cprod, red.cantidad, productos.descripcion, productos.costodecompra
FROM 
red, productos 
WHERE 
red.cprov = productos.cprov 
AND 
red.cprod = productos.cprod 
AND 
red.f = $folio
ORDER BY id DESC LIMIT 10;");	
	
while( $row=mysql_fetch_array($result))
	{
		$sppv = $row['pv'] *$row['cantidad'];
		echo "<tr><td>".$row['cantidad']."</td><td>".$row['cprov']."</td><td>".$row['cprod']."</td><td>$".$row['spcc']."</td><td>$ $sppv</td><td>".$row['descripcion']."</td><td>$".$row['costodecompra']."</td><td>$".$row['pv']."</td><td><a href=red.php?action=del&id=".$row['id'].">eliminar</a></td></tr>";
		echo "\n";
	}					
?>
</TABLE>
<a href='red.php?action=fin'>finalizar sesion</a>
<?if($action == "fin") { session_destroy();
mysql_query("delete from red where f = $folio and cprov ='' and cprod =0;");
 echo "<br><b>SESION FINALIZADA</b> <br><a href ='edi.php'>empezar nuevo folio</a><p>";}?>
</BODY>
</HTML>