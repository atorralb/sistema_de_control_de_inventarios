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

		

		echo $elements['display-header']; 
		echo $elements['display-sidebar'];
		echo $elements['start-playground'];
        echo '<div class="one-half">
                <div class="box">
                    <div class="inner"> 
                    <span class="highlight blue">Para ver los reportes necesitas instalar Jasperreports e iReports. Nosotros te guiaremos</span>
                    <br>
                    Los reportes son generados en demanda, eso significa que solo submites un ticket, nosotros hacemos lo hacemos y en unas
                    cuantas horas lo descargas
                    </div>
                    </div>
                </div>
            ';
    } else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }


?>
