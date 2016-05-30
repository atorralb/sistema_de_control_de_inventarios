<!DOCTYPE HTML>
<!-------------------------------------------/*
 *  Fancy Input
 *
 *  Copyright 2013, Yair Even Or
 *  https://dropthebit.com
 *
 *  Licensed under the MIT license:
 *  http://www.opensource.org/licenses/MIT
 */------------------------------------------>
<html lang="en">
<head>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta charset="utf-8">
	<title>Fancy Input - CSS3 text typing effects for input fields</title>
	<meta name="description" content="Makes HTML input field typing fun with some CSS3 effects">
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="fancyInput.css">
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script src="../js/jquery.1.8.min.js"></script>
	<!--<script src="jquery.min.js"></script>-->
</head>
<body>
	<div id='wrap'>
		<form action="newuser.php">

		<header>
			<menu class='radio'>
				<label><input type='radio' value='email' name='type' /><span>email</span></label>
				<label><input type='radio' value='password' name='type' /><span>password</span></label>
				<label><input type='submit' value='textarea' name='type' /><span>crear</span></label>
				<div></div>
			</menu>
		</header>
		
		<div id='content'>
				<section class='input'>
					<div>
						<input type='text' name="email" id="email"/>
					</div>
					<span id="availability_status"></span>
					<span class="check" ></span>
				</section>
				<section class='input'>
					<div>
						<input type='text' name="password" id="email"/>
					</div>
				</section>
		</div>
		</form>
	<script src='fancyInput.js'></script>
	<script>
		$('section :input').val('').fancyInput()[0].focus();

		// Everything below is only for the DEMO
		function init(str){
			var input = $('section input').val('')[0],
				s = 'escribe tu corrreo@.com... ✌'.split('').reverse(),
				len = s.length-1,
				e = $.Event('keypress');
			
			var	initInterval = setInterval(function(){
					if( s.length ){
						var c = s.pop();
						fancyInput.writer(c, input, len-s.length).setCaret(input);
						input.value += c;
						//e.charCode = c.charCodeAt(0);
						//input.trigger(e);
						
					}
					else clearInterval(initInterval);
			},150);
		}
		
		init();
		
		$('menu').on('click', 'button', toggleEffect);
		$('menu.radio').on('change', 'input', changeForm).find('input:first').prop('checked',true).trigger('change');
		
		// change effects
		function toggleEffect(num){
			var className = '';
				idx = $(this).index() + 1,
				$fancyInput = $('.fancyInput');

			if( idx > 1 )
				className = 'effect' + idx;

			$('#content').prop('class', className);
			$fancyInput.find(':input')[0].focus();
			
			$(this).addClass('active').siblings().removeClass('active');
		}
		
		function changeForm(e){
			// radio buttons stuff
			var page = this.value,
				highlight = $(e.delegateTarget).find('> div'),
				label = $(this.parentNode),
				marginLeft = parseInt( label.css('margin-left') , 10 ),
				xPos;
				
			highlight.css({'left':label.position().left + marginLeft, 'width':label.width() });
			
			// page change stuff
			xPos = '-' + label.index() * 50;
			$('#content').css( 'transform', 'translateX(' + xPos + '%)' );
			
			setTimeout(function(){
				$('#content').find('.' + page  + ' :input')[0].focus();
			}, 100);
		}
	</script>

<script type="text/javascript">
$(document).ready(function()//When the dom is ready
{
$("#email").change(function()
{ //if theres a change in the username textbox

var email = $("#email").val();//Get the value in the username textbox
if(email.length > 3)//if the lenght greater than 3 characters
{
$("#availability_status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');
//Add a loading image in the span id="availability_status"

$.ajax({  //Make the Ajax Request
 type: "POST",
 url: "check_email.php",  //file name
 data: "email="+ email,  //data
 success: function(server_response){

 $("#availability_status").ajaxComplete(function(event, request){

 if(server_response == '0')//if ajax_check_username.php return value "0"
 {
 $("#availability_status").html('<font color="Green"> Available </font>  ');
 //add this image to the span with id "availability_status"
 }
 else  if(server_response == '1')//if it returns "1"
 {
 $("#availability_status").html('No esta Disponible');
 }

 });
 }

 });

}
else
{

$("#availability_status").html('<font color="#cc0000">Correo Demasiado Corto</font>');
//if in case the username is less than or equal 3 characters only
}
return false;
});
});
	</script>
</body> 
</html>
