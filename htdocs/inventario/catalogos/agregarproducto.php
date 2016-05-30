<?php include("../menu2.inc");?>
<table>
<form action=agregarproducto.php method=GET>
<TR><TD>CODIGO DE PROVEEDOR</TD><TD><input type="text" class=textfield  name=cprov></TD></TR>
<TR><TD># PRODUCTO</TD><TD><input type="text" class=textfield name=cprod></TD></TR>
<TR><TD>DESCRIPCION</TD><TD><input type="text" class=tlargo name=descripcion></TD></TR>
<TR><TD>COSTO DE COMPRA</TD><TD><input type="text" class=textfield name=costodecompra></TD>
<TR><TD>PRECIO DE VENTA DESEADO</TD><TD><input type="text" class=textfield name=pv2 value=0.00></TD>
<TR><TD>TASA 0</TD><TD><input type="text" class=textfield name=tasa0 value=0.65></TD></TR>
<TR><TD>TASA 15</TD><TD><input type="text" class=textfield name=tasa15 value=0.00 ></TD></TR>
<TR><TD>UNIDAD</TD><TD><input type="text" class=tlargo name=unidad></TD></TR>
<TR><TD><input type="submit" value="agregar"></TD></TR>
</form>
</table>
<P>
<TABLE><th>PROVEEDOR</th><th>CODIGO</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>TASA 0</th><th>TASA 15</th><th>UNIDAD</th>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");

if(urlencode(@$_REQUEST['cprov']) != "" && urlencode(@$_REQUEST['cprod']) !="")	
{  
    $cprov=mysql_real_escape_string($_REQUEST['cprov']);
    $cprod=mysql_real_escape_string($_REQUEST['cprod']);
    $descripcion=mysql_real_escape_string($_REQUEST['descripcion']);
    $costodecompra=mysql_real_escape_string($_REQUEST['costodecompra']);
    $tasa15=mysql_real_escape_string($_REQUEST['tasa15']);
    $tasa0=mysql_real_escape_string($_REQUEST['tasa0']);
    $unidad=mysql_real_escape_string($_REQUEST['unidad']);
    $pv2=mysql_real_escape_string($_REQUEST['pv2']);
    $precio_mayoreo=mysql_real_escape_string($_REQUEST['precio_mayoreo']);
    
    mysql_query ("insert into productos (cprov, cprod,  descripcion, costodecompra, tasa15, tasa0, unidad, pv2, precio_mayoreo)values 
        ('$cprov',  '$cprod', '$descripcion', '$costodecompra', '$tasa15', '$tasa0', '$unidad', '$pv2','$precio_mayoreo' );");
    
   $result=mysql_query
        ("SELECT if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,  
           productos.descripcion, productos.costodecompra, productos.cprov, productos.cprod, productos.tasa0, productos.tasa15, productos.unidad 
           FROM  productos WHERE cprov = '$cprov' and cprod='$cprod';");
    	

     while( $row=mysql_fetch_array($result))
		{
		echo "<tr><td>".$row['cprov']."</td>";
		echo "<td>".$row['cprod']."</td>";
		echo "<td>".$row['descripcion']."</td>"; 
		echo "<td>$".$row['costodecompra']."</td>"; 
		echo "<td>$".$row['pv']."</td>"; 
		echo "<td>$".$row['tasa0']."</td>"; 
		echo "<td>$".$row['tasa15']."</td>";
		echo "<td>".$row['unidad']."</td>"; 		
		echo "</tr>";
		echo "\n";
		}
   
   
}
echo "<tr valign=bottom>";
echo "<td bgcolor=#fb7922 colspan=6><img src=img/blank.gif width=1 height=8></td>";
echo "</tr>";
?>	
</TABLE>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</html>