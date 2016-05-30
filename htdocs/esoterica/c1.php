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
date_default_timezone_set('America/Mexico_City');
$today = date("Y-m-d H:i:s");

if ($login->isUserLoggedIn()) {
    include 'config/setup_idiorm.php';
    include 'ui/elements.php'; 
    include "scripts.inc";

        if(isset($_REQUEST['insert'])){//if the submit button is clicked
            $_SESSION['movement'] = $_REQUEST['movement'];
            $_SESSION['date'] = $_REQUEST['date'];
            $_SESSION['client_name'] = $_REQUEST['client_name'];
            $_SESSION['client_agent'] = $_REQUEST['client_agent'];
            $_SESSION['client_address'] = $_REQUEST['client_address'];
            $_SESSION['client_city'] = $_REQUEST['client_city'];
            $_SESSION['client_zipcode'] = $_REQUEST['client_zipcode'];
            $_SESSION['client_rfc'] = $_REQUEST['client_rfc'];
            $_SESSION['concept'] = $_REQUEST['concept'];
            
            $products = explode(',', $_REQUEST['product']);
            foreach ($products as &$product) {
                $p = ORM::for_table('products')->where('id',$product)->find_one();
                $record = ORM::for_table('records')->create();
                $record->folio =$_SESSION['folio'];
                $record->t ='1';
                $record->pid =$product;
                $record->product = $p->description;
                $record->quantity = $_REQUEST['quantity'];
                $record->price=$p->cost;
                $record->pfs=$p->pfs;
                $record->movement=$_REQUEST['movement'];
                $record->date=$_SESSION['date'];
                $record->user=$_SESSION['user_name'];
                $record->client_name= $_REQUEST['client_name'];
                $record->client_agent= $_REQUEST['client_agent'];
                $record->client_address= $_REQUEST['client_address'];
                $record->client_city= $_REQUEST['client_city'];
                $record->client_zipcode= $_REQUEST['client_zipcode'];
                $record->client_rfc= $_REQUEST['client_rfc'];
                $record->concept= $_REQUEST['concept'];
               $record->save();
            }
        }

if (isset($_REQUEST['end'])){

         $record = ORM::for_table('folio')->create();
         $record->number =$_SESSION['folio'];
         $record->save();
        unset($_SESSION['movement']);
        unset($_SESSION['inASale']);
        unset($_SESSION['date']);
        unset($_SESSION['client_name']);
        unset($_SESSION['client_agent']);
        unset($_SESSION['client_address']);
        unset($_SESSION['client_city']);
        unset($_SESSION['client_zipcode']);
        unset($_SESSION['client_rfc']);
        unset($_SESSION['concept']);
    }
if (!isset($_SESSION['inASale'])) {
        $_SESSION['inASale'] = 'TRUE';
         $max = ORM::for_table('folio')->max('number');
        $_SESSION['folio'] = $max+1;
        } 
    echo $elements['display-header']; 
    echo $elements['display-sidebar']; 
    echo $elements['start-playground'];
    echo '<form action="c1.php" method="post" name="c1">
            <section class="full-width">
                <div class="box no-bg grid-demo">
                    <div class="layer1" >
                        <p class="heading"><span class="button green tiny"><span class="icon awesome reorder"></span></span>
                        <a href="folio.php?id='.$_SESSION['folio'].'" target="_blank" class="button green tiny"><span class="icon entypo plus"></span> html</a>  
                        </p>           
                        <div class="content">
                            <div class="row">
                                <div class="field-box">
                                <select name ="movement"> ';
                                if (isset($_SESSION['movement'])){echo '<option value="'.$_SESSION['movement'].'"></option>';}  
                                else {  echo '<option value="OUT">SALIDAS</option>
                                                <option value="IN">ENTRADAS</option>';}
                                echo '</select>
                                </div>
                                <div class="clear"></div>
                            </div>  

                            <div class="row">
                                <div class="field-box">
                                <input type="text" size="10" name="date" 
                                value="'; 
                                if (isset($_SESSION['date'])){echo $_SESSION['date'];}  else {echo $today;}
                                 echo '"></div>
                                <div class="clear"></div>
                            </div>                            

                            <div class="row">
                                <div class="field-box">
                                <input type="text" size="10" name="client_name" 
                                value="'; 
                                if (isset($_SESSION['client_name'])){echo $_SESSION['client_name'];}  else {echo 'cliente';}
                                 echo '"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                
                                <div class="field-box">
                                <input type="text" size="10" name="client_agent" value="';
                                if (isset($_SESSION['client_agent'])){echo $_SESSION['client_agent'];} else{ echo 'agente';}
                                echo'"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                 
                                <div class="field-box">
                                <input type="text" size="10" name="client_address" value="';
                                if (isset($_SESSION['client_address'])){echo $_SESSION['client_address'];} else{ echo 'direcccion';}
                                echo'"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                 
                                <div class="field-box">
                                <input type="text"  size="10" name="client_city" value="';
                                if (isset($_SESSION['client_city'])){echo $_SESSION['client_city'];} else{ echo 'ciudad';}
                                echo '"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                
                                 <div class="field-box">
                                <input type="text"  size="10" name="client_zipcode" value="';
                                if (isset($_SESSION['client_zipcode'])){echo $_SESSION['client_zipcode'];} else{ echo '000000';}
                                echo '"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                 
                                 <div class="field-box">
                                <input type="text" size="10" name="client_rfc" value="';
                                if (isset($_SESSION['client_rfc'])){echo $_SESSION['client_rfc'];} else{ echo '000000';}
                                echo '"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                 <div class="field-box">
                                <input type="text"  name="concept" value="';
                                if (isset($_SESSION['concept'])){echo $_SESSION['concept'];} else{ echo 'Concepto';}
                                echo '"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
    if (isset($_SESSION['inASale'])){




        if(isset($_REQUEST['delete'])){
            $checkbox = $_POST['checkbox'];
            //if user has no privileges, ask for password, else dont delete
            
            $user = ORM::for_table('users')->where('user_name',$_REQUEST['user']);
            if ($user->can_delete_records='SI'){
                for($i=0;$i<count($_POST['checkbox']);$i++){
                    $del_id = $checkbox[$i];
                    $record = ORM::for_table('records')->where('id',$del_id);
                    $record->delete_many();
                    echo "record deleted";
                }
            
            }

            else{echo "cant";}
        }

        echo '
            <div class="one-half">
                <div class="box">
                    <div class="inner">
                        <div class="titlebar">'.$_SESSION['folio'].'<span class="w-icon">
                        </span></div>
                        <div class="contents">
                            <div class="row">
                                <label>Cantidad</label> <div class="field-box">
                                <input type="text"  size="10" name="quantity"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row last">
                                <label>Producto</label> 
                                <div class="field-box">
                                    <input id="product" size="25" type="text" name="product" />
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="bar-big">
                            <input type="Submit" value="Enviar" name="insert">
                        </div>
                        
                    </div>
                </div>
            </div>';
        $rs = ORM::for_table('records')->where('folio',$_SESSION['folio'])->order_by_desc('id')->find_many();
        echo getHtmlTable($rs);
}
echo $elements['end-playground'];
}
else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }
?>
</div>
</body> 
</html>
