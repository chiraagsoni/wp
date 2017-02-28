
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Register</title>
<!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>


<style>
body {

	font-family:Arial, Helvetica, sans-serif;
	font-size: 10px;
	color:#999;
	margin:0;
	background-color:#fff;
}
a {
	text-decoration:none;
	color:#666;	
}

#signupDiv {
	background-color:#FFF;	
}

#signupDiv ul {
	list-style-type:none;
	padding:0;
	margin:0 30px 0 30px;
	overflow:hidden;
	border:#000 0px solid;

}

#signupDiv ul li{
	clear:both;
	overflow:hidden;
	border:#CCC 0px solid;
	padding:0 0 3px 0;

}
#signupDiv ul li label{
	display:block;
	display:inline-block;
	width:130px;
	border:#666 0px solid;
	vertical-align:top;
}
#signupDiv input, textarea, select{
	font-family:Arial, Helvetica, sans-serif;
	width:150px;
	border:#CCC 1px solid;
	font-size:11px;
	color:#666;
}
input, textarea {
	padding:2px;	
}
select{
	width:155px;	
}

#alert {
	position:absolute;
	top:20%;
	left:20%;
	width:175px;
	height:60px;
	background-color:#333;
	color:#FFF;
	display:none;
	text-align:center;
	padding:20px;
	font-size:1.2em;
	
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px; /* future proofing */
	-khtml-border-radius: 10px; /* for old Konqueror browsers */
}

#successDiv, #preloader {
	position:absolute;
	top:0;
	bottom:0;
	left:0;
	right:0;
	background-color:#fff;	
	color:#333;
}



/* JQUERY TOOLS */

/* error message */
.error {
  /* supply height to ensure consistent positioning for every browser */
  height:12px;
  background-color:#9F9F98;
  border:1px solid #fff;
  font-size:11px;
  color:#fff;
  padding:4px;
  margin:0px;
 

  /* CSS3 spicing for mozilla and webkit */
  -moz-border-radius:4px;
  -webkit-border-radius:4px;
  -moz-border-radius-bottomleft:0;
  -moz-border-radius-topleft:0;
  -webkit-border-bottom-left-radius:0;
  -webkit-border-top-left-radius:0;
 
/*  -moz-box-shadow:0 0 6px #ddd;
  -webkit-box-shadow:0 0 6px #ddd;*/
}

.error p {
	display:inline;	
	
}

/* JQ TOOLS ENDS */


</style>

<script>
$(document).ready( function (){

	var msg = ''
	if(msg){alert(msg)};

	$('#user_type').val('');
	$('#user_other').val('');	

	$('#user_type').change( function(){
			if($(this).val() == 'other'){
				$('.user_other').css('display','block');
				$('.user_other input').attr('required','required');
			}else{
				$('.user_other').css('display','none');
				$('.user_other input').removeAttr('required');
			}
	});
	
	
	$('#signupForm').find('[required]').live('blur', function() {
		$(this).css('background-color','#FFF');				
	});
	

	$('#signupForm').submit( function(event) {
		event.preventDefault();
		submitform = 1;		
		$('#signupForm').find('[required]').each(function(index){
			if($(this).val() == ''){
				$(this).css('background-color','#FFCCCD');
				submitform = 0;
			}
		});

		if(submitform == 0){
			alert("Please fill in all the required fields");
			return false;
		}
		
		if($('#agree').prop('checked') == false){
			alert('You must agree to the Terms & Conditions');
			$('#agree').css('background-color','#F00');
			return false;
		}

		
		$('#preloader').fadeIn('slow', function(){if (jQuery.browser.msie) this.style.removeAttribute('filter');});
		
		$.post("signup_ac.php", $("#signupForm").serialize(),
			 function(data){
		 		$('#preloader').fadeOut('slow');
				 if(data != 'success'){
					 showalert(data);
					// $('input[name=password]').val('');
					 return false;
				 }else{
					console.log(data); // John
					if(data == 'success'){ 
					//alert(data);
						$('#emailaddress').html($('#email').val());
						$('#successDiv').css('display','block');
						$( "form" )[ 0 ].reset();						
					}
					$('#loginDiv').fadeOut('slow');
//					$('#user_menu').css('display','block');
				 }
			 });
			 		
	});
	
});

function showalert(msg){
	$('#alert').html(msg);
	$('#alert').fadeIn('slow').delay(3000).fadeOut('slow');	
}

function closeDialog(){
	$(this).closest('iframe').parent().fadeOut();	
	window.parent.hideDialog();
	
}
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5683997-29']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="signupDiv" style="border:#390 0px solid; margin:0 auto; padding-bottom:10px; position:relative">
<a href="javascript:void(0)" style="float:right; text-align:center; padding:0px 3px; background-color:#666; color:#FFF" onclick="closeDialog()">CLOSE</a>
<div id="alert"></div>
<div id="preloader" style="display:none"><table height="400" width="100%"><tr><td align="center" valign="middle">Please wait...</td></tr></table></div>
<div id="successDiv" style="display:none">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Almost Done!</strong></td>
    </tr>
    <tr>
      <td class="style1">An email confirmation has been sent to <span id="emailaddress"></span>. </td>
    </tr>
    <tr>
      <td><span class="style1">Please follow the instructions  in the mail to complete your registration.</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><a href="javascript://" style="display:block; width:100px; text-align:center; padding:5px 10px; background-color:#666; color:#FFF" onclick="closeDialog()">CLOSE</a></td>
    </tr>
    <tr>
      <td><p>&nbsp;</p></td>
    </tr>
    <tr>
      <td><span class="style4">Problems?</span><br />
        <span class="problemq">Check your spam folder.<br />
You can login and resend the confirmation email.<br />
Send us an email at webmaster@jehangirartgallery.com </span></td>
    </tr>
      <td>&nbsp;</td>
    </tr>
      <td align="center">&nbsp;</td>
    </tr>    
  </table>


</div>
<div style="text-align:center; color:#999; padding:15px 0 5px 0; margin-bottom:5px; font-size:12px;">NEW USER REGISTRATION</div>
	<form action="" method="post" id="signupForm" name="signupForm" style="margin:0; padding:0">
      <ul>
        <li><label>EMAIL/ USERNAME:</label><input type="email" id="email" name="email" value="" required="required"  ></li>
        <li><label>CONFIRM EMAIL:</label><input type="email" name="confirm_email" value="" required="required"  ></li> 
        <li>
          <label>NEW PASSWORD:</label><input type="password" name="password" value="" required="required"  ></li>                
        <li><label>FIRST NAME:</label><input name="first_name" type="text"  value="" maxlength="25" required="required"></li>
        <li><label>LAST NAME:</label><input name="last_name" type="text"  value="" maxlength="25" required="required"></li>
            
        <li><label>GENDER:</label><select name="gender" style="width:100px" required="required" >
          <option selected="selected" value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
</select></li><br>     
        <li><div style="width:200px"><input id="agree" name="agree" type="checkbox" value="yes" style="margin:0; width:auto; vertical-align:middle; border:none" required="required" /> I agree to the Terms & Conditions</div></li>                
        <li style="margin-top:10px;"><label></label><input type="submit" value="SIGN UP" style=" width:100px; font-size:9px; letter-spacing:0.05em; padding:3px 0; background-color:#9F9F98; color:#FFF">
        </li>                
      </ul>
      </form>    
</div>


</body>
</html>
