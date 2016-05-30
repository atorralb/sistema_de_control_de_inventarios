<STYLE type=text/css>BODY {
	FONT-FAMILY: arial, helvetica, serif
}
#nav {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; LINE-HEIGHT: 1; PADDING-TOP: 0px; LIST-STYLE-TYPE: none
}
#nav UL {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; LINE-HEIGHT: 1; PADDING-TOP: 0px; LIST-STYLE-TYPE: none
}
#nav A {
	DISPLAY: block; WIDTH: 10em
}
#nav LI {
	FLOAT: left; WIDTH: 10em
}
#nav LI UL {
	BACKGROUND: WHITE; LEFT: -999em; WIDTH: 10em; POSITION: absolute
}
#nav LI:hover UL {
	LEFT: auto
}
#nav LI.sfhover UL {
	LEFT: auto
}
#content {
	CLEAR: left; COLOR: #ccc
}
</STYLE>

<SCRIPT type=text/javascript><!--//--><![CDATA[//><!--

sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);

//--><!]]></SCRIPT>
<UL id=nav>
  <LI><A 
  href="http://www.htmldog.com/articles/suckerfish/dropdowns/example/bones1.html#">CATALOGOS</A> 

  <UL>
   <LI>
   <a class="item2" href="catalogos/proveedores.php">Proveedores</a>
   </LI>
   <LI>
   <a class="item2" href="catalogos/agregarproducto.php">Agregar producto</a>
   </LI>
   <a class="item2" href="catalogos/agregarproveedor.php">Agregar proveedor</a>
  <LI>
   <a class="item2" href="catalogos/eliminarproducto.php">Eliminar producto</a>
  <LI>
  <a class="item2" href="catalogos/eliminarproveedor.php">Eliminar proveedor</a>
  </LI>
  </UL>
</li>

  <LI>
  <A   href="movimientos/formulario.php">MOVIMIENTOS</A> 
</li>

 <LI>
<A href="http://www.htmldog.com/articles/suckerfish/dropdowns/example/bones1.html#">ADMINISTRACION</A> 

  <UL>
   <LI>
   <a class="item2" href="administracion/entradas_y_salidas.php">Entradas y/o Salidas</a>
   </LI>
   <a class="item2" href="administracion/records_por_folio.php">Records por folio</a>
   <LI>
   <a class="item2" href="administracion/anexar_records_por_folio.php">Anexar records a folio</a>
   </LI>		
  <a class="item2" href="administracion/inventario_por_proveedor.php">Inventario por proveedor</a>
  <LI>
  <a class="item2" href="administracion/bp.php">Buscar producto por su nombre</a>
  </LI>
  <LI>
  <a class="item2" href="administracion/concentrado.php">concentrado</a>
  </LI>
  </UL>
</li>


</ul>
<br>