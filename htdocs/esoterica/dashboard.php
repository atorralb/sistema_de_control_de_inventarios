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
		include "scripts.inc";

		$logs = ORM::for_table('user_records')->order_by_desc('id')->find_many();

		echo $elements['display-header']; 
		echo $elements['display-sidebar'];
		echo $elements['start-playground'];
        echo '<div class="one-half">
                <div class="box">
                    <div class="inner"> 
                        <div class="titlebar">Base de Datos:<span class="w-icon"></span></div>
                        <div class="contents">
                            <div class="row">
                            <h2><span class="highlight yellow">Direccion IP:</span>unhe.info <span class="highlight yellow">Puerto:</span> 3306</h2>
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                            <h2><span class="highlight yellow">Nombre de la base de datos</span> TuNegocio</h2>
                            <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        echo '<div class="one-half">
                <div class="box">
                    <div class="inner"> 
                        <div class="titlebar">actividad<span class="w-icon"></span></div>
                        <div class="contents">
                            <div class="row">
                            <h2><span class="highlight yellow">usuario:</span>unhe.info 
                            <div class="clear"></div>
                            </div>
                            <div class="row">
                            <h2><span class="highlight yellow">Nombre de la base de datos</span> TuNegocio</h2>
                            <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        echo '<div class="full-width">
                <div class="box">
                    <div class="inner"> 
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Accion</th>
                                    <th>Descripcion</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            ';   
                     	foreach ($logs as $log) {

    					   echo    '<tr>
                                    <td><span class="highlight green">'.$log->who.'</span></td>
                                    <td><span class="highlight blue">'.$log->action.'</span></td>
                                    <td><span class="highlight blue">'.$log->what.'</span></td>
                                    <td>'.$log->date.' </td>
                                    </tr>';
						}  
           
        echo        '</table>
                    </div>
                    </div>
                </div>
                </form>
            </div>';
    } else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }


?>
