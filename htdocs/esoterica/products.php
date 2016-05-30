<?php 
require_once("config/db.php");
require_once("classes/Database.class.php");
require_once("classes/Login.class.php");
$db    = new Database();
// start this baby and give it the database connection
$login = new Login($db);
if ($login->isUserLoggedIn()) {
        
		include 'config/setup_idiorm.php';
		include 'ui/elements.php'; 
		include 'scripts.inc';
		
		echo $elements['display-header']; 
		echo $elements['display-sidebar'];
		echo $elements['start-playground'];
        
        if(isset($_REQUEST['insert'])){//if the submit button is clicked
            $product_exists = count(ORM::for_table('products')->where_raw('(`storecode` = ?)', array($_REQUEST['storecode']))->find_result_set());
            if ($product_exists < 1 ){
                    $supplier = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode(strtoupper($_REQUEST['supplier']))));
                    $category = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode(strtoupper($_REQUEST['category']))));
                    $unit = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode(strtoupper($_REQUEST['unit']))));
                    $description = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode(strtoupper($_REQUEST['description']))));
                    $storecode = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode(strtoupper($_REQUEST['storecode']))));

                    $max = ORM::for_table('products')->max('id');
                    $id = $max + 1;
                    $product = ORM::for_table('products')->create();
                    $product->id =$id;
                    $product->supplier =$supplier;
                    $product->category =$category;
                    $product->unit =$unit;
    				$product->description =$description;
                    $product->cost =$_REQUEST['cost'];
                    $product->pfs = $_REQUEST['pfs'];
                    $product->pfw = $_REQUEST['pfw'];
                    $product->storecode= $storecode;
                    $product->barcode= $_REQUEST['barcode'];
                    $product->save();

                    echo '<h2><span class="highlight yellow">'.$_REQUEST['storecode'].'</span></h2>';

                    $record = ORM::for_table('user_records')->create();
                    $record->action= 'ENTRADA';
                    $record->who= $_SESSION['user_name'];
                    $record->what= $description;
                    $record->save();
            }
            else { 
                echo '<h2><span class="highlight yellow">'.$_REQUEST['storecode'].' ESE CODIGO YA EXISTE, CAMBIALO POR OTRO</span></h2>';
            }
        }

		echo '<form action="products.php?insert=true" method="post">
            <section class="full-width">
                <div class="box  no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder">AGREGAR PRODUCTO</span></span> 
                        </p>           
                        <div class="content">
                            <div class="box">
                                <div class="inner"> 
                        <div class="titlebar">Agrega tu producto<span class="w-icon"></span></div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="PROVEEDOR" name="supplier">
                                <p class="info">Puedes escribir cualquier proveedor</p>
                                </div>
                                 <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="CATEGORIA" name="category">
                                <p class="info">Puedes escribir cualquier categoria, pero escribelas igual</p>
                                </div>
                                 <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="UNIDAD" name="unit">
                                <p class="info">Puedes escribir cualquier unidad, pero escribelas igual para futuras referencias</p>
                                </div>
                                 <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="DESCRIPCION" name="description">
                                <p class="info">ejemplo: Aceitunas Enlatadas la Costeña</p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="COSTO DE COMPRA" name="cost">
                                <p class="info">ejemplo: 15.25</p>
                                </div>
                                <div class="clear"></div>
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="PRECIO DE VENTA" name="pfs">
                                <p class="info">ejemplo: 100.25</p>
                                </div>
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="PRECIO DE VENTA MAYOREO" name="pfw">
                                <p class="info">ejemplo: 100.25</p>
                                </div>
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="CODIGO" name="storecode">
                                <p class="info">ejemplo: C1</p>
                                </div>
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                                <div class="field-box"><span class="icon entypo user for-input"></span>
                                <input type="text" class="w-icon" placeholder="CODIGO DE BARRAS" name="barcode">
                                </div>
                            <div class="clear"></div>
                            </div>
                        <div class="bar-big">
                        	<input type="submit" value="agregar">
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>';

        $logs = ORM::for_table('products')->order_by_desc('id')->find_many();

        echo '<section class="full-width">
                <div class="box  no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder">LISTADO DE PRODUCTOS</span></span> 
                        </p>           
                        <div class="content">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>CATEGORIA</th>
                                        <th>UNIDAD</th>
                                        <th>DESCRIPCION</th>
                                        <th>COSTO</th>
                                    </tr>
                                </thead>';   
                        foreach ($logs as $log) {
                           echo    '<tr onclick="document.location =\'products.php?n='.$log->id.'\'">
                                    <td><span class="highlight blue">'.$log->storecode.'</span></td>
                                    <td><span >'.$log->category.'</span></td>
                                    <td><span >'.$log->unit.'</span></td>
                                    <td><span >'.$log->description.'</span></td>
                                    <td>'.$log->cost.' </td>
                                    </tr>';
                        }  
           
        echo        '           </table>
                            </div>
                        </div>
                    </div>
                </section>';
                                
        $user = ORM::for_table('users')->where('user_name',$_SESSION['user_name']);
        if (isset($_REQUEST['delete'])){
            if ($user->can_delete_records='Y'){
                $record = ORM::for_table('user_records')->create();
                $record->action= 'ELIMINO';
                $record->who= $_SESSION['user_name'];
                $record->what= $_REQUEST['id'];
                $record->save();

                $record = ORM::for_table('products')->where('id', $_REQUEST['id']);
                $record->delete_many();
                echo "record eliminado";
                }
            
            else{ echo "no estas autorizado";}
        }

        if(isset($_REQUEST['n'])){

                $products = ORM::for_table('products')->where_raw('(`id` = ?)', array($_REQUEST['n']))->find_one(); 
                $sold = ORM::for_table('records')->where('pid', $products->id)->where('movement','out')->sum('quantity');
                $bought = ORM::for_table('records')->where('pid', $products->id)->where('movement','in')->sum('quantity');
                $min = ORM::for_table('products')->min('id');
                $max = ORM::for_table('products')->max('id');
                $next_result = ORM::for_table('products')->where_raw('(`id` > ?)', array($_REQUEST['n']))->order_by_asc('id')->limit(1)->find_one();
                $previous_result = ORM::for_table('products')->where_raw('(`id` < ?)', array($_REQUEST['n']))->order_by_desc('id')->limit(1)->find_one();

                echo '<div class="full-width" id="grid">
                        <div class="box">
                            <div class="inner">
                                <a href="?n='.$min.'"><div class="icon-example"><span class="icon awesome fast-backward"></span></div></a>
                                <a href="?n='.$previous_result->id.'"><div class="icon-example"><span class="icon awesome caret-left"></span></div></a>
                                <a href="?n='.$next_result->id.'"><div class="icon-example"><span class="icon awesome caret-right"></span></div></a>
                                <a href="?n='.$max.'"><div class="icon-example"><span class="icon awesome fast-forward"></span></div></a>
                                <a href="printable.php?byproduct_all&storecode='.$products->storecode.'" class="button large">'.($bought - $sold).' EN STOCK</a>
                                <a href="products.php?delete&id='.$products->id.'" class="button red large"><span class="icon entypo minus"></span>ELIMINA ESTE PRODUCTO</a> 
                                ';

                        echo    '<p><ul class="'.$products->id.'" style="list-style: none;">
                                                <div class="row"><li></li></div><div class="clear"></div>
                                                <div class="row"><li></li></div><div class="clear"></div>
                                                <div class="row"><li><input type="text" size="50" value="'.$products->supplier.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li><input type="text" size="50" value="'.$products->category.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li><input type="text" size="50" value="'.$products->unit.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li><input type="text" size="50" value="'.$products->description.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li>costo de compra<input type="text" size="50" value="'.$products->cost.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li>Precio de Venta <input type="text" size="50" value="'.$products->pfs.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li>Mayoreo<input type="text" size="50" value="'.$products->pfw.'" /></li></div><div class="clear"></div>
												<div class="row"><li><input type="text" size="50" value="'.$products->barcode.'" /></li></div><div class="clear"></div>
                                                <div class="row"><li><input type="text" size="50" value="'.$products->storecode.'" /></li></div><div class="clear"></div>
                                            </ul>';                                
                        echo '</div></div></div>';
    }
		echo $elements['end-playground'];
	}
	else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }
?>