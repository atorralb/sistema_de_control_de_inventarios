<?php include("../menu2.inc");?>
<head>
AGREGAR PROVEEDOR	
</head>
<TABLE>
<form action="agregarproveedor.php" method="get">
<TR><TD>CODIGO DE PROVEEDOR</TD><TD><input type="text" class=textfield name=cprov></TD></TR>
<TR><TD>NOMBRE</TD><TD><input type="text" class=tlargo name=nombre></TD></TR>
<TR><TD>TELEFONO</TD><TD><input type="text" class=tlargo name=telefono></TD></TR>
<TR><TD>FAX</TD><TD><input type="text" class=tlargo name=fax></TD></TR>
<TR><TD>DOMICILIO</TD><TD><input type="text" class=tlargo name=domicilio></TD></TD>
<TR><TD>CIUDAD</TD><TD><input type="text" class=tlargo name=ciudad></TD></TR>
<TR><TD>ENCARGADO</TD><TD><input type="text" class=tlargo name=encargado></TD></TR>
<TR><TD>RFC</TD><TD><input type="text" class=tlargo name=rfc></TD></TR>
<TR><TD><input type="submit" value="agregar"></TD></TR>
</FORM>
</TABLE>
<table>
<tr><th>CODIGO</th><th>NOMBRE</th><th>TELEFONO</th><th>FAX</th><th>DOMICILIO</th><th>CIUDAD</th><th>ENCARGADO</th><th>R.F.C</th></tr>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");


if(urlencode(@$_REQUEST['cprov']) != "")	
{
    $cprov=mysql_real_escape_string($_REQUEST['cprov']);
    $nombre=mysql_real_escape_string($_REQUEST['nombre']);
    $domicilio=mysql_real_escape_string($_REQUEST['domicilio']);
    $ciudad=mysql_real_escape_string($_REQUEST['ciudad']);
    $tel=mysql_real_escape_string($_REQUEST['telefono']);
    $fax=mysql_real_escape_string($_REQUEST['fax']);
    $encargado=mysql_real_escape_string($_REQUEST['encargado']);
    $rfc=mysql_real_escape_string($_REQUEST['rfc']);
    //this will get the maximun number of the primary key (id)  + 1 so mysql can't confuse it for entry '0'... really weird bug
    $maxid= mysql_query("SELECT MAX(id)+1 AS maximumid FROM proveedores;");
    $maxid2 = mysql_fetch_array($maxid);
    //until here



mysql_query ("insert into proveedores (id, cprov, nombre, domicilio, ciudad, tel, fax, encargado, rfc)  values (".$maxid2['maximumid'].", '$cprov', '$nombre', '$domicilio', '$ciudad', '$tel', '$fax', '$encargado', '$rfc');");
$proveedor =  mysql_query("SELECT * FROM proveedores Where cprov='$cprov';");

while($row=mysql_fetch_array($proveedor))
		{
		echo "<tr><td>".$row['cprov']."</td>";
		echo "<td>".$row['nombre']."</td>";
		echo "<td>".$row['domicilio']."</td>"; 
		echo "<td>".$row['ciudad']."</td>"; 
		echo "<td>".$row['tel']."</td>"; 
		echo "<td>".$row['fax']."</td>"; 
		echo "<td>".$row['encargado']."</td>";
		echo "<td>".$row['rfc']."</td>";
		echo "</tr>";
		echo "\n";
		}
}
?>
</table>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</html>
