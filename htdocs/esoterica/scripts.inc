<!DOCTYPE html>
<html dir="ltr" lang="en-US"> 
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 
<title>APP.A.COLADA :: Cafeina ERP</title>

<?php 
require_once 'ui/elements.php';
echo $elements['css-files'];
echo $elements['css-expandable-list'];
?>

 
<!-- jQuery -->
<script type="text/javascript" src="js/jquery.1.8.min.js"></script>

<script type="text/javascript" src="js/jquery.tokeninput.js"></script>

<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>


<!-- Validation engine -->
<script type="text/javascript" src="js/languages/jquery.validationEngine-en.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<!-- scrollTo -->
<script type="text/javascript" src="js/jquery.scrollto.js"></script>
<script type="text/javascript" src="js/sugar-1.3.9.min.js"></script>
<!-- Masked inputs -->
<script type="text/javascript" src="js/jquery.masked-inputs.js"></script>
<!-- Chosen -->
<script type="text/javascript" src="js/jquery.chosen.js"></script>
<!-- Draggable Slider -->
<script type="text/javascript" src="js/jquery.slider.js"></script>
<!-- iPhone Style Checkbox -->
<script type="text/javascript" src="js/jquery.iphonecheckbox.js"></script>
<!-- Caffeine custom JS -->
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.autosave.min.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        // Form validate
        jQuery("#demo-form-val").validationEngine();
    });
</script>
<script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#product').addClass('load');
            $.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#product').removeClass('load');
                }
            });
        }
    }
 
    function fill(thisValue) {
        $('#product').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }
  </script>
  <script type="text/javascript">
$(document).ready(function () {
    $("#product").tokenInput("autosuggest.php",
    {   

            resultsFormatter: function(item){ 
                return "<li>" + "<div style='display: inline-block; padding-left: 10px;'>" + item.id+ " " + item.storecode+ "<div class='description'>$ " + item.pfs + " "+ item.name + "</div></div></li>" },

            tokenFormatter: function(item) { return "<li><p>" + item.storecode + "  " + item.name + " $" + item.pfs + "</p></li>" },
          });

});
</script>  

<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery(".content").hide();
  //toggle the componenet with class msg_body
  jQuery(".heading").click(function()
  {
    jQuery(this).next(".content").slideToggle(500);
  });
});
</script>
<script type="text/javascript">
      $(document).ready(function() {
        var textBefore = '';
        $('#grid').find('li input').hover(function() {
          textBefore = $(this).val();
          $(this).focus();
        }, function() {
          var $field = $(this),
            text = $field.val();
          $(this).blur();
          // Set back previous value if empty
          if (text.length <= 0) {
            $field.html(textBefore);
          } else if (textBefore !== text) {
            // Text has been changed make query
            var value = {
              'row': parseInt(getRowData($field)),
              'column': parseInt($field.closest('ul').children().find(':input').index(this)),
              'text': text
            };
            $.post('ajax_products.php', value)
            .error(function() {
              $('#message')
                .html('Make sure you inserted correct data')
                .fadeOut(3000)
                .html('&nbsp');
              $field.val(textBefore);
            })
            .success(function() {
              $field.val(text);
            });
          } else {
            $field.val(text);
          }

        });

        // Get the id number from row
        function getRowData($li) {
          return $li.closest('ul').prop('class').match(/\d+/)[0];
        }
      });
    </script>

    
</head>
<body id="index" class="home" OnLoad="document.c1.quantity.focus();">
    <!-- Container -->
    <div id="container">