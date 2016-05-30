<?php
/* 
------------------
elements
------------------
*/

$elements = array();
$elements['css-files'] = '<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
                         <link rel="stylesheet" href="css/icons.css" type="text/css" />
                         <link rel="stylesheet" href="css/forms.css" type="text/css" />
                         <link rel="stylesheet" href="css/tables.css" type="text/css" />
                         <link rel="stylesheet" href="css/ui.css" type="text/css" />
                         <link rel="stylesheet" href="css/style.css" type="text/css" />
                        <link rel="stylesheet" href="css/responsiveness.css" type="text/css" />
                        <link rel="stylesheet" type="text/css" href="css/token-input.css" />';
$elements['css-expandable-list'] = '<style type="text/css">
                                    .layer1 {
                                    margin: 0;
                                    padding: 0;
                                    }
                                    .heading {
                                    margin: 1px;
                                    color: #fff;
                                    padding: 3px 10px;
                                    cursor: pointer;
                                    position: relative;
                                    }
                                    .content {
                                    padding: 5px 10px;

                                    }
                                    p { padding: 5px 0; }
                                    </style>'; 
$elements['display-header'] = '
      <!-- Header -->
        <header id="header">
            <figure id="logo"><a href="dashboard.html" class="logo"></a></figure>
            <!--
            <section id="general-options">
                <a href="users.php" class="users tipsy-header" title="Usuarios"></a>

            </section>
            -->
            <section id="userinfo">
                <span class="welcome">bienvenido <strong>'.$_SESSION['user_name'].'</strong> </span>
                <!--<span class="last-login">Tu ultima entrada fue en June 1st at 11:24hs</span>-->
                <div class="profile">
                    <div class="links">
                        <a href="login.php?logout" class="logout">Salir</a>
                    </div>
                    <img src="img/profile-pict.jpg" alt="'.$_SESSION['user_name'].'">
                </div>
            </section>
            <section id="responsive-nav">
                <select id="nav_select" ONCHANGE="location = this.options[this.selectedIndex].value;">
                    <option value="dashboard.html">Tablero</option>
                    <option value="products.php?n=0">Productos</option>
                    <option value="c1.php">Capturas</option>
                    <option value="query.php">Query</option>
                    
                    
                </select>
            </section>
        </header> <!-- /Header -->
        <div class="clear"></div>  ';
$elements['display-sidebar'] = '
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-top"></div>
            
            <h3>Navegador</h3>
            
            <!-- Nav menu -->
            <ul class="nav">
                <li><a href="dashboard.php">Tablero</a></li>
                <li ><a href="products.php?n=0">Productos</a></li>
                <li><a href="c1.php">Captura</a>
                </li>
                <li><a href="query.php">Query</a>
                </li>
            </ul> <!-- /Nav menu -->
            
            <div class="blocks-separator"></div>
        </nav> <!-- Sidebar -->';
$elements['start-products-captured'] ='<section class="one-half">
             <div class="box">
                    <div class="inner">
                         <div class="bar-big">
                            <input type="Submit" value="eliminar" name="delete">
                        </div>    
                        <div class="contents">';
$elements['end-products-captured'] =  '</div>
                                    </div>       
                                </div>
                            </form>  
                        </section>';
$elements['start-playground']= '<section id="playground">
            <div class="clear"></div>';   
$elements['end-playground']='</section>                
                    <div class="clear"></div> 
            <div class="clear"></div>
        </body> 
    </html>';

function getHtmlTable($result){
    $out = '<section class="one-half">
                    <div class="box">
                        <div class="inner">
                            <div class="bar-big">
                                <input type="Submit" value="Finalizar" name="end">
                                <input type="Submit" value="eliminar" name="delete">
                            </div>    
                            <div class="contents">';
                                foreach ($result as $record){ 
                                    $out .= "<div class='row'><input type='hidden' name='user' value='".$record->user."'><input name='checkbox[]' type='checkbox' id='checkbox[]' value='".$record->id."'/>" .$record->quantity." ".$record->product." $".$record->quantity*$record->pfs."</div>" ;
                                }
                $out .=     '</div>
            </div>       
        </div>
    </form>  
</section>';
    
return $out;
}
?>