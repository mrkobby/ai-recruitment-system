<?php 
include_once("_sys/check_login_status.php");
if($user_ok == true){
	header("location: sync&".$_SESSION["user_hash"]);
    exit();
}
?><?php
if(isset($_POST["e"])){	
	$_SESSION['e'] = $email = mysqli_real_escape_string($db_connection, $_POST['e']);
	$sql = "SELECT id FROM user_account WHERE email='$email'";
    $query = mysqli_query($db_connection, $sql); 
	$e_check1 = mysqli_num_rows($query);
	if($email == ""){
		echo 'Form submission is missing values';
        exit();
	} else if ($e_check1 < 1){ 
        echo 'Sorry, this email address is not in our database';
        exit();
	} else {	
		$eo_hash = md5($email);
		
		$to = "$email";							 
		$from = "bacsyd-noreply@bacsyd.com";
		$subject = 'Bacsyd Account Forgot Password';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
		$message .= '<span style="font-size:16px;">Hey there,<br /><br />too bad you\'ve forgotten your password.<br /><br />';
		$message .= 'You can go ahead and reset your password by clicking the link before.</span><br /><br />';
		$message .= '<div style="padding: 20px;background-color: rgb(217, 226, 245);"><a href="http://www.bacsyd.com/reset&'.$eo_hash.'">Click here to reset password</a></div>';
		$message .= '<br /><br /><br /><span style="font-size:16px;"><b>Bacsyd Security Team</b></span></body></html>';
		$headers = "From: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Reply-To: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Return-Path: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "CC: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "BCC: bacsyd-noreply@bacsyd.com\r\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);
	
		echo "email_success";
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Request password reset</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.login-register-reset.css" rel="stylesheet">
</head>
<body class="reset-background">
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="javascript:void(0)" onclick="owlphinhome()">
	    <img src="_img/owlphin_log.png" style="height:30px;" />
		<span></span>
      </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li><button class="btn btn-inverse" onclick="login()">Sign in</button></li>
          <li><button class="btn btn-inverse" onclick="register()">Join now</button></li>
        </ul>
      </div>
    </div>
  </div> 
</div>
<div id="forgotpassform" style="display:;">
<div class="account-container">
  <div id="showloader" class="div-loader-cover"><div class="spinner"></div></div>
  <div class="content clearfix">
	<form role="form" method="post" onSubmit="return false;">
	  <div class="register-logo">
		<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>
		<h1>We've got you</h1>	
	    <span id="status"><p style="font-size:12px;font-weight: 100;">Enter the email address that you used to register.</p></span>
	  </div>
	  <div class="login-fields">
		<div class="field">
		  <input type="email" id="email" name="email" placeholder="Email" class="login email-field" onkeyup="restrict('email')" onfocus="emptyElement('status')" />
		</div>
	  </div>
	  <div class="login-actions">			
		<button class="button btn btn-inverse btn-large" onclick="stepone()">Submit</button>
	  </div>
	</form>	
  </div>
</div>
</div>
<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
<script type="text/javascript">
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	if(x == "status"){
		_(x).innerHTML = '<p style="font-size:12px;font-weight: 100;">Enter the email address that you used to register.</p>';
	}else{
		_(x).innerHTML = "";
	}
}
function stepone(){
	var email = _("email").value;
	var status = _("status");
	if(email == ""){
		status.innerHTML = '<h5><div class="alert">Please enter email address</div></h5>';
	}else if(!email.replace(/\s/g, '').length){
		status.innerHTML = '<h5><div class="alert">Please enter email address</div></h5>';
	} else {
		_("showloader").style.display = "block";
		var ajax = ajaxObj("POST", "reset-pass.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText != "email_success"){
					status.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
					_("showloader").style.display = "none";
				}else {
					_("showloader").style.display = "none";
					window.scrollTo(0,0);	
					_("forgotpassform").innerHTML = '<div class="account-container">'+
												  '<div class="content clearfix">'+
													'<form role="form" method="post" onSubmit="return false;">'+
													  '<div class="register-logo">'+
														'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
														'<h1>Check you email</h1>'+
														'<p style="font-size:14px;font-weight: bold;">We\'ve sent you a reset link</p>'+
													  '</div></form></div></div>';
				}
	        }
        }
		ajax.send("e="+encodeURIComponent(email));
	}
}
</script>
</body>
</html>