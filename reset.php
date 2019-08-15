<?php 
include_once("_sys/check_login_status.php");
if($user_ok == true){
	header("location: sync&".$_SESSION["user_hash"]);
    exit();
}
?><?php
$e_log = "";
if(isset($_GET["e"])){
	$e_log = $_GET['e'];
	$sql = "SELECT * FROM user_account WHERE e_hash='$e_log'";
	$user_query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($user_query);
	if($numrows < 1 ){
		header("location: _msg.php?msg=That user does not exist");
		exit();	
	}
	$sql0 = "UPDATE user_account SET password='reset_fbr' WHERE e_hash='$e_log' LIMIT 1";
	$query = mysqli_query($db_connection, $sql0);
}
?><?php
if(isset($_POST["npone"])){
	$np1 = $_POST['npone'];
	$np2 = $_POST['nptwo'];
	if($np1 == "" || $np2 == ""){
		echo "Please fill all password fields";
		exit();
	} else if ($np1 != $np2) {
        echo "Your passwords do not match";
        exit(); 
    } else if (strlen($np1) < 6) {
        echo "Password is too short. Try 6 or more characters";
        exit(); 
    } else {
		$np_hash = md5($np1);
		$sql1 = "UPDATE user_account SET password='$np_hash' WHERE password='reset_fbr' LIMIT 1";
		$query = mysqli_query($db_connection, $sql1);
		echo "reset_success";
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reset password</title>
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
		<h4>You can now reset your password</h4>	
	    <span id="status"></span>
	  </div>
	  <div class="login-fields">
		<div class="field">
		  <input type="password" id="pass1" name="pass1" placeholder="New password" class="login email-field" onfocus="emptyElement('status')" />
		</div>
		<div class="field">
		  <input type="password" id="pass2" name="pass2" placeholder="Confirm password" class="login email-field" onfocus="emptyElement('status')" />
		</div>
	  </div>
	  <div class="login-actions">			
		<button class="button btn btn-inverse btn-large" onclick="resetpass()">Submit</button>
	  </div>
	</form>	
  </div>
</div>
</div>
<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
<script type="text/javascript">
function emptyElement(x){
	_(x).innerHTML = "";
}
 function resetpass(username){
	var np1 = _("pass1").value;
	var np2 = _("pass2").value;
	var status = _("status");
	if(np1 == "" || np2 == ""){
		status.innerHTML = '<h5><div class="alert">Please enter new passwords</div></h5>';
	} else if(np1 != np2){
		status.innerHTML = '<h5><div class="alert">Your new passwords do not match</div></h5>';
	} else {
		_("showloader").style.display = "block";
		var ajax = ajaxObj("POST", "reset.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText != "reset_success"){
					status.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
					_("showloader").style.display = "none";
				} else {
					_("showloader").style.display = "none";
					window.scrollTo(0,0);	
					_("forgotpassform").innerHTML = '<div class="account-container">'+
												  '<div class="content clearfix">'+
													'<form role="form" method="post" onSubmit="return false;">'+
													'<div class="register-logo">'+
													'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
													'<h4>Your password was successfully updated</h4><br /><br />'+
													'<div class="login-actions" style="margin-bottom: 0.25em;"><button class="button btn btn-inverse btn-large" onclick="login()">Login</button></div>'+
													'</div></form></div></div>';
				}
			}
		}
		ajax.send("npone="+encodeURIComponent(np1)+"&nptwo="+encodeURIComponent(np2));
	}
}
</script>
</body>
</html>