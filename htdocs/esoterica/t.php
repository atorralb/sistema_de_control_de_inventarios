<?php
include 'config/setup_idiorm.php';
 echo '<div class="full-width" id="grid">
                <div class="box">
                    <div class="inner"> 
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Categoria</th>
                                    <th>Unidad</th>
                                    <th>Descripcion</th>
                                    <th>Costo de Compra</th>
                                    <th>Precio de venta</th>
                                    <th>Codigo de Barras</th>
                                    <th>Codigo del producto</th>
                                    <th>Stock</th>
                                    <th>accion</th>
                                </tr>
                            </thead>
                            ';   

if(isset($_REQUEST['n'])){
$limit = $_REQUEST['n']+10;
$products = ORM::for_table('products')->where_raw('(`id` >= ? AND `id` <= ?)', array($_REQUEST['n'], $limit))->find_many();
foreach ($products as $product) {
	            $sold = ORM::for_table('records')->where('pid', $product->id)->where('movement','out')->sum('quantity');
                $bought = ORM::for_table('records')->where('pid', $product->id)->where('movement','in')->sum('quantity');
     echo    '<tr class="'.$product->id.'">
                            <td><input type="text" size="5" value="'.$product->supplier.'" /></td>
                            <td><input type="text" size="5" value="'.$product->category.'" /></td>
                            <td><input type="text" size="5" value="'.$product->unit.'" /></td>
                            <td><input type="text" size="5" value="'.$product->description.'" /></td>
                            <td><input type="text" size="5" value="'.$product->cost.'" /></td>
                            <td><input type="text" size="5" value="'.$product->pfs.'" /></td>
                            <td><input type="text" size="5" value="'.$product->barcode.'" /></td>
                            <td><input type="text" size="5" value="'.$product->storecode.'" /></td>
                            <td>'.($bought - $sold).'</td>
                            <td><a href="products.php?delete&id='.$product->id.'" class="button red tiny"><span class="icon entypo minus"></span> </a> </td>
                        </tr>';
}

$p = $_REQUEST['n']-10;
echo '<a href="?p='.$p.'"><</a><a href="?n='.$limit.'">></a>';
}

if(isset($_REQUEST['p'])){
	
$limit = $_REQUEST['p']+10;

$products = ORM::for_table('products')->where_raw('(`id` >= ? AND `id` <= ?)', array($_REQUEST['p'], $limit))->find_many();
foreach ($products as $product) {
    	            $sold = ORM::for_table('records')->where('pid', $product->id)->where('movement','out')->sum('quantity');
                $bought = ORM::for_table('records')->where('pid', $product->id)->where('movement','in')->sum('quantity');
     echo    '<tr class="'.$product->id.'">
                            <td><input type="text" size="5" value="'.$product->supplier.'" /></td>
                            <td><input type="text" size="5" value="'.$product->category.'" /></td>
                            <td><input type="text" size="5" value="'.$product->unit.'" /></td>
                            <td><input type="text" size="5" value="'.$product->description.'" /></td>
                            <td><input type="text" size="5" value="'.$product->cost.'" /></td>
                            <td><input type="text" size="5" value="'.$product->pfs.'" /></td>
                            <td><input type="text" size="5" value="'.$product->barcode.'" /></td>
                            <td><input type="text" size="5" value="'.$product->storecode.'" /></td>
                            <td>'.($bought - $sold).'</td>
                            <td><a href="products.php?delete&id='.$product->id.'" class="button red tiny"><span class="icon entypo minus"></span> </a> </td>
                        </tr>';
}

$p = $_REQUEST['p']-10;
echo '<a href="?p='.$p.'"><</a><a href="?n='.$limit.'">></a>';
}

?>