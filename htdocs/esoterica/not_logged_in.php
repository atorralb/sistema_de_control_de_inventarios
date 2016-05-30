
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" dir="ltr" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html dir="ltr" lang="en-US"> <!--<![endif]-->
<head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 

<title>Login :: Caffeine Admin Template</title>

<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/icons.css" type="text/css" />
<link rel="stylesheet" href="css/forms.css" type="text/css" />
<link rel="stylesheet" href="css/tables.css" type="text/css" />
<link rel="stylesheet" href="css/ui.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/responsiveness.css" type="text/css" />

<!-- jQuery -->
<script src="js/jquery.1.8.min.js"></script>
<script src="js/jquery-ui.1.8.23.min.js"></script>

<!-- Validation engine -->
<script type="text/javascript" src="js/languages/jquery.validationEngine-en.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>


<!-- Caffeine custom JS -->
<script type="text/javascript" src="js/custom.js"></script>

<!--[if IE]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]--> 
<!--[if lte IE 7]> <script src="js/IE8.js" type="text/javascript"></script> <![endif]--> 
<!--[if lt IE 7]> <link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/> <![endif]--> 

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#login_form").validationEngine();
	});
</script>

</head>

<body id="index" class="home">
  
    
    <section id="login-container">
        <div id="login_header"></div>
            <?php
    			if ($login->errors) {
        			foreach ($login->errors as $error) { 
    		?>              
    				<div class="login_message error">
        				<?php echo $error; ?>
    				</div>            
    				<?php
    
        			}
    			}
    
    			if ($login->messages) {
        			foreach ($login->messages as $message) {
    			?>
    			<div class="login_message success">
        			<?php echo $message; ?>
    				</div>              
    				<?php
        		}
    		}

    ?>  
		
	<form method="post" action="login.php" name="loginform" id="loginform">

			<div id="login_wrapper">
				<div class="login_wrapper_container">
					<div class="float_center_box">
						
						<div class="one-half logo-box">
							<img src="img/login-logo.png" alt="Caffeine">
						</div>
						
						<div class="clear"></div>
						<div class="box">
							<div class="inner">
								<div class="contents">

									<div class="one-half username-half">
										<label>demo@demo.com</label>
										<div class="field-box">
											<span class="icon awesome user for-input"></span>
											<input type="text" class="w-icon validate[required]" name="user_email" /> 
										</div>
										<div class="clear"></div>
									</div>
									<div class="one-half password-half">
										<label>Password: demo</label>
										<div class="field-box"><span class="icon awesome lock for-input"></span>
										<input type="password" name="user_password"  class="w-icon validate[required]"></div>
										<div class="clear"></div>
									</div>
									
									<div class="clear"></div>
									<div class="line-separator"></div>
									
									<div class="one-half">
										<a href="#">Forgot your password?</a>
									</div>
									<div class="one-half right">
										<input type="submit" value="Login" name="login" class="button blue tiny">
									</div>
									
									<div class="clear"></div>
									
								</div>
								<div class="clear"></div>
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		
        <div id="login_footer">
        </div>
    </section>
    
</body> 
</html>