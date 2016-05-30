<?php 
require_once("config/db.php");
require_once("classes/Database.class.php");
require_once("classes/Login.class.php");

$db    = new Database();

$login = new Login($db);


if ($login->isUserLoggedIn()) {
    include 'config/setup_idiorm.php';
    include 'ui/elements.php'; 
    include "scripts.inc";
    echo $elements['display-header']; 
    echo $elements['display-sidebar']; 
    echo $elements['start-playground'];
    $next_user_id = ORM::for_table('users')->max('user_id');
    
        ?>
            <div class="two-thirds">
                <div class="box">
                    <div class="inner">
                        <div class="titlebar">

                            <span class="w-icon">
                            
                                <a href="#" class="button first blue tiny tipsy-trigger" original-title="Previous">
                                    <span class="icon awesome chevron-left">
                                    </span>
                                </a>
                                    <a href="#" class="button last blue tiny tipsy-trigger" original-title="Next">
                                        <span class="icon awesome chevron-right">
                                        </span>
                                    </a>
                                
                            </span>

                        </div>
                        <!--<form id="demo-form-val" action="index.php?p=form-validation" method="post"-->
                        <div class="contents">
                            <div class="row">

                                <label>Usuario</label> <div class="field-box"><span class="icon entypo user for-input"></span>
                                
                                <input type="text" class="w-icon medium validate[required]"  value="nombre de usuario"  data-user_name="set" data-new_user_id="<?php echo $next_user_id+1;?>">
                                <br>
                                <span class="alert alert-success success hide">guardado!</span>
                                <span class="alert alert-danger fail hide">Fail!</span> 
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Password</label> <div class="field-box"><span class="icon awesome key for-input"></span>
                                <input type="password" class="w-icon medium validate[required]" id="password-field" data-user_id="<?php echo $next_user_id+1;?>" data-user_password="set">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>E-mail</label> <div class="field-box"><span class="icon entypo email for-input"></span>
                                <input type="text" class="w-icon medium validate[required, custom[email]]" value="original value"  data-user_id="<?php echo $next_user_id+1;?>"  data-user_email="set"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Puede eliminar records?</label> <div class="field-box"><span class="icon entypo email for-input"></span>
                                <input type="text" class="w-icon medium" value="Escribe SI o NO"  data-user_id="<?php echo $next_user_id+1;?>"  data-user_can_delete_records="set"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Tel</label> 
                                <div class="field-box">
                                    <span class="icon entypo phone for-input"></span>
                                    <input type="text" class="w-icon medium validate[required, custom[phone]]" value="1234567890"  data-user_id="<?php echo $next_user_id+1;?>"  data-phone="set">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Cel</label> <div class="field-box">
                                <span class="icon entypo mobile for-input"></span>
                                <input type="text" class="w-icon medium  validate[required, custom[phone]]" value="1234567890"  data-user_id="<?php echo $next_user_id+1;?>" data-cel="set"></div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Fecha De Nacimiento</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required, custom[date],past[2010/01/01]]" value="AAAA-MM-DD"  data-user_id="<?php echo $next_user_id+1;?>" data-birthdate="set">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Puesto</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="cajero"  data-user_id="<?php echo $next_user_id+1;?>" data-position="set">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>RFC</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="cajero"  data-user_id="<?php echo $next_user_id+1;?>" data-rfc="set">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>IMSS</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="No. Imss"  data-user_imss="<?php echo $next_user_id+1;?>" >
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>CURP</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="curp"  data-user_curp="<?php echo $next_user_id+1;?>" >
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Direccion</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="Calle o Avenida"  data-user_street_name="<?php echo $next_user_id+1;?>" >
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row">
                                <label>Numero u Andador</label> 
                                <div class="field-box">
                                    <span class="icon entypo calendar for-input"></span>
                                    <input type="text" class="w-icon medium validate[required custom[position]]" value="Andador D #11"  data-user_address_number="<?php echo $next_user_id+1;?>">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row last">
                                <div class="clear"></div>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
                <script type="text/javascript">
    $("input").autosave(); 
   function successCallback(data,$jq){
     $jq.find("~.success").fadeIn();
    }
    function errorCallback(error,$jq){
      $jq.find("~.fail").fadeIn();
    }
    function beforeCallback($jq){
      console.log(this);
     $jq.siblings(".success,.fail").fadeOut();
    }

    $("input").autosave({url:"autosave.php",success:successCallback,error:errorCallback,before:beforeCallback});
  </script>

           
            <div class="clear"></div>
            
            <div class="full-width right">

            </div>
        </section>    
    </div>
    <?php  


        // further stuff here
    } else {
        // not logged in, showing the login form
        include("not_logged_in.php");
    }

?>
   

    
</body> 
</html>