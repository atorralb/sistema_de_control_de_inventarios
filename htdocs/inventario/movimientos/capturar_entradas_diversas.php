<?php
session_start();
?>
<HTML>
<head>
<a href = "capturar_entradas_diversas.php?accion=fin" >finalizar sesion</a>
<?php	
$accion = urlencode(@$_REQUEST['accion']);
if($accion == "fin"){
	session_destroy();
	echo "<br><b>SESION FINALIZADA</b> <br><a href ='formulario.php'>empezar nuevo folio de devolucion de proveedores</a>";
	}
?>	
</head>
<STYLE>
@import url(../gui.css);
</STYLE>
<TABLE >
<th>FOLIO</th><th>FECHA</th><th>FACTURA</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th>
<tr>
<?php
print_r($_SESSION);
?>
<p>
</tr>
<table>
<p>
</head>
<BODY>
<form action=capturar_entradas_diversas.php method=get>
<table>
<tr><td>CANTIDAD:</td><td><input type=text  id="textbox" class=textfield name="cantidad">
		<script>document.getElementById('textbox').focus()</script></td></tr>
<tr><td>PROVEEDOR:</td><td><input type=text  class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td><input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit border=0 value="insertar"></td></tr>
</table>
</form>
<TABLE>
<th>C.</th><th>PROV.</th><th>COD.</th><th>DESCRIPCION</th><th>S.P.C.C</th><th>S.P.P.V</th><th>C.C</th><th>P.V</th><th>COMANDO</th>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");
function error_report (){
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}
$cprov = urlencode(@$_REQUEST['cprov']);
$cprod = urlencode(@$_REQUEST['cprod']);
$cantidad = urlencode(@$_REQUEST['cantidad']);
$id = urlencode(@$_REQUEST['id']);
$accion = urlencode(@$_REQUEST['accion']);

if($accion=="eliminar"){
		mysql_query("DELETE FROM entradas_y_salidas WHERE id=$id;");
	}	

if($cprov != "" && $cprod != "" && $cantidad != ""){
	$result = mysql_query("SELECT * FROM productos WHERE cprov='$cprov' and cprod='$cprod'");
	$num_rows = mysql_num_rows($result);
	if ($num_rows > 0) {
		mysql_query("INSERT INTO entradas_y_salidas 
		(folio,			fecha,	
		movimiento,		almacen1,	
		almacen2,		concepto,	
		ne,				nr,	
		na,				factura,
		f,				cprov, 			
		cprod, 			cantidad,		
		fecha_capturado)
		VALUES 
		('$_SESSION[folio]','$_SESSION[fecha]',
		'5',				'$_SESSION[almacen_de_entrada]',	
		'0',				'$_SESSION[concepto]', 	
		'$_SESSION[ne]', 	'$_SESSION[nr]',
		'$_SESSION[na]', 	'$_SESSION[factura]',
		'$_SESSION[folio]',	'$cprov',
		'$cprod',			'$cantidad', 
		NOW() );");
		}
		else{echo "<FONT COLOR='RED'>ESE PRODUCTO NO EXISTE</FONT>";}
	}
	$result=mysql_query("SELECT  
				if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,
				entradas_y_salidas.cantidad*productos.costodecompra AS spcc,  
				entradas_y_salidas.id, 
				entradas_y_salidas.cprov, 
				entradas_y_salidas.cprod, 
				entradas_y_salidas.cantidad, productos.descripcion, productos.costodecompra
				FROM 
				entradas_y_salidas, productos 
			    WHERE 
				entradas_y_salidas.cprov = productos.cprov 
			     AND 
				entradas_y_salidas.cprod = productos.cprod 
			     AND 
				entradas_y_salidas.f= '$_SESSION[folio]'
				ORDER BY id DESC;");	
	
	while( $row=mysql_fetch_array($result))
		{
		extract($row);
		$sppv = $pv *$cantidad;
		echo "<tr><td>".$cantidad."</td>
		<td>".$cprov."</td>
		<td>".$cprod."</td>
		<td>$".$spcc."</td>
		<td>$ $sppv</td><td>".$descripcion."</td>
		<td>$".$costodecompra."</td>
		<td>$".$pv."</td>
		<td><a href=capturar_entradas_diversas.php?accion=eliminar&id=".$id.">eliminar</a></td></tr>";
		echo "\n";
		}			
?>
</TABLE>
</BODY>
</HTML>