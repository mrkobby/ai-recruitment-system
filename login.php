<?php 
include_once("_sys/check_login_status.php");
if($user_ok == true){
	header("location: sync&".$_SESSION["user_hash"]);
    exit();
}
?><?php
if(isset($_POST["email"])){
	$email = $_POST['email'];
	$p = md5($_POST['p']);
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

	if($email == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
		$sql = "SELECT id, e_hash, password FROM user_account WHERE BINARY email = BINARY '$email' AND activated='1' LIMIT 1";
        $query = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_ehash = $row[1];
        $db_pass_str = $row[2];
		if($p != $db_pass_str){
			echo "login_failed";
            exit();
		} else {
			$_SESSION['userid'] = $db_id;
			$_SESSION['user_hash'] = $db_ehash;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("e_hash", $db_ehash, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE);

			$sql = "UPDATE user_account SET ip='$ip', last_login_date=now() WHERE e_hash='$db_ehash' LIMIT 1";
            $query = mysqli_query($db_connection, $sql);
			echo $db_ehash;
		    exit();
		}
	}
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sign in to Bacsyd</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.login-register-reset.css" rel="stylesheet">
</head>
<body class="login-background">
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
		<form class="navbar-search" role="form" method="post" onSubmit="return false;">
		  <ul class="nav pull-right mobile-no-show">
		   <li><button class="btn btn-inverse" onclick="register()">No account? Join now</button></li>
	      </ul>
	    </form>
      </div>
    </div>
  </div> 
</div>
<div class="account-container">
  <div class="content clearfix">
    <div id="showloader" class="div-loader-cover"><div class="spinner"></div></div>
	<form role="form" method="post" onSubmit="return false;">
	  <div class="register-logo">
		<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>
		<h2>Sign in</h2>	
		<span id="status"></span>
	  </div>
	  <div class="login-fields">
		<div class="field">
		  <input type="text" id="email" name="email" value="" placeholder="Email" class="login email-field" onfocus="emptyElement('status')" onkeyup="restrict('email')" />
		</div>
		<div class="field">
		  <input type="password" id="password" name="password" value="" placeholder="Password" onfocus="emptyElement('status')" class="login password-field"/>
		</div>
	  </div>
	  <div class="login-actions">			
		<button class="button btn btn-inverse btn-large" onclick="signin()">Sign In</button>
	  </div>
	  <div class="login-extra" style="margin-bottom: 0;">
		<a  href="javascript:void(0)" onclick="resetpass()">Forgot password?</a> 
	  </div>
	  <div class="login-extra" style="margin-top: 0.5em;">
		<a  href="javascript:void(0)" onclick="register()">No account? Register now</a>
	  </div>
	</form>	
  </div>
</div>
<div class="footer mobile-no-show" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
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
	_(x).innerHTML = "";
	_("password").style.borderColor = "black";
	_("email").style.borderColor = "black";
}
function signin(){
	var email = _("email").value;
	var p = _("password").value;
	var status = _("status");
	if(email == ""){
		status.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
		_("email").style.borderColor = "red";
	} else if(p == ""){
		status.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
		_("password").style.borderColor = "red";
	}else {
		_("showloader").style.display = "block";
		var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText == "login_failed"){
					status.innerHTML = '<h5><div class="alert">Wrong email or password</div></h5>';
					_("showloader").style.display = "none";
				} else {
					window.location = "sync&"+ajax.responseText;
				}
	        }
        }
        ajax.send("email="+email+"&p="+encodeURIComponent(p));
	}
}
</script>
</body>
</html>