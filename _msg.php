<?php
$message = "No message";
if(isset($_GET["msg"])){
	$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
}else {
    header("location: ../bacsyd/login");
    exit();	
}
if($msg == "activation_failure"){
	$message = 'Sorry, we are having trouble activating your account at this time. We will analyze this issue and get back to you via email.';
} else if($msg == "missing_GET_variables"){
	$message = 'Unable to get some variables. Please try again';
} else {
	$message = $msg;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Message</title>
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
		<h3><?php echo $message; ?></h3>	
	  </div>
	  <div class="login-actions">			
		<button class="button btn btn-inverse btn-large" onclick="login()">Okay</button>
	  </div>
	</form>	
  </div>
</div>
</div>
<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
</body>
</html>