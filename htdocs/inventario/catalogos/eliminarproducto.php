<?php include("../menu2.inc");?>
ELIMINAR PRODUCTO
<p>
<TABLE>
<form action="eliminarproducto.php?accion=preguntar" method=POST>
<TR><TD>CODIGO DEL PROVEEDOR</TD><TD><input type="text" class=textfield name="cprov"></TD></TR>
<TR><TD># DEL PRODUCTO</TD><TD><input type="text" class=textfield name="cprod"></TD></TR>
<TR><TD><input type="submit" value="buscar"></TD></TR>
</form>
</TABLE>
<TABLE>
<TR>
<?php
mysql_connect("localhost","root","");
mysql_select_db("inventario");



if(urlencode(@$_REQUEST['accion']) == "seguro"){
     $cprov=mysql_real_escape_string($_REQUEST['cprov']);
     $cprod=mysql_real_escape_string($_REQUEST['cprod']);
     mysql_query("DELETE  FROM PRODUCTOS	WHERE CPROV='$cprov' AND CPROD='$cprod';");
}

if(urlencode(@$_REQUEST['cprov']) != "" && urlencode(@$_REQUEST['cprod'])!= "" && urlencode(@$_REQUEST['accion'])=="preguntar")	{
        $cprov=mysql_real_escape_string($_REQUEST['cprov']);
        $cprod=mysql_real_escape_string($_REQUEST['cprod']);
        $seleccion = mysql_query ("select * from productos where cprov='$cprov' and cprod='$cprod';");
        
        while($s= mysql_fetch_array($seleccion)){
        echo '<td>'.$s['cprov'],'</td><td>'.$s['cprod'],'</td><td>'.$s['descripcion'],'</td><td><a href="eliminarproducto.php?accion=seguro&cprov='.$s['cprov'],'&cprod='.$s['cprod'],'">eliminar</A></td>';
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
</HTML>