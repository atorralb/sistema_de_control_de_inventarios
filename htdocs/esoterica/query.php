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
    include 'ui/elements.php'; 
    include "scripts.inc";
    echo $elements['css-expandable-list'];
    echo $elements['display-header']; 
    echo $elements['display-sidebar']; 
    echo $elements['start-playground'];
    if(isset($_REQUEST['view by date'])){
        
        echo getHtmlTable($rs);
    }

    echo '<form target="_blank" action="printable.php?byproduct" method="post" name="viewbyproduct">
            <section class="full-width">
                <div class="box no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder"> </span></span>
                        </p>           
                        <div class="content">
                        <h2>Movimientos por producto </h2>
                            <div class="row">
                                <label>Movimiento</label> 
                                <div class="field-box">              
                                <select name ="movement">
                                    <option value="OUT">SALIDAS</option>
                                    <option value="IN">ENTRADAS</option>
                                </select>
                                </div>
                                <div class="clear"></div>
                            </div>                          
                            <div class="row">
                                <label>codigo del producto</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="storecode"></div>
                                <div class="clear"></div>
                            </div>
                            <input type="submit" value="buscar" >
                        </div>
                    </div>
                </div>
            </section>
        </form>';

    echo '<form target="_blank" action="printable.php?byfolio" method="post" name="viewbyfolio">
            <section class="full-width">
                <div class="box no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder"> </span></span>
                        </p>           
                        <div class="content">                        
                        <h2>Records por folio </h2>
                            <div class="row">
                                <label>Numero de folio</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="folio"></div>
                                <div class="clear"></div>
                            </div>
                            <input type="submit" value="buscar">
                        </div>
                    </div>
                </div>
            </section>
        </form>';

            echo '<form target="_blank" action="printable.php?addtofolio" method="post" name="addtofolio">
            <section class="full-width">
                <div class="box no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder"> </span></span>
                        </p>           
                        <div class="content">
                        <h2>Anexar records a folio </h2>                        
                            <div class="row">
                                <label>Numero de folio</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="folio"></div>
                                <div class="clear"></div>
                            </div>
							<div class="row">
                                <label>cantidad</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="quantity"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Codigo del producto</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="storecode"></div>
                                <div class="clear"></div>
                            </div>
                            <input type="submit" value="Anexar">
                        </div>
                    </div>
                </div>
            </section>
        </form>';
		            echo '<form target="_blank" action="printable.php?bycategory" method="post" name="addtofolio">
            <section class="full-width">
                <div class="box no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder"> </span></span>
                        </p>           
                        <div class="content">
                        <h2>Inventario Por Fecha </h2>                        
                            <div class="row">
                                <label>categoria</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="category"></div>
                                <div class="clear"></div>
                            </div>
							<div class="row">
                                <label>Desde</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="start_date" value=""></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Hasta</label> 
                                <div class="field-box">
                                <input type="text" size="10" name="end_date" value=""></div>
                                <div class="clear"></div>
                            </div>
                            <input type="submit" value="Ver">
                        </div>
                    </div>
                </div>
            </section>
        </form>';
}
else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }
?>