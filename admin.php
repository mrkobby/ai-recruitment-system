<?php
include_once("_sys/check_login_status.php");
if($user_ok == true){
	header("location: sync&".$_SESSION["user_hash"]);
    exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "delete_user"){
	if(!isset($_POST['userid']) || $_POST['userid'] == ""){
		mysqli_close($db_connection);
		echo "user id is missing";
		exit();
	}
	$userid = $_POST['userid'];
	$query = mysqli_query($db_connection, "SELECT e_hash FROM user_account WHERE e_hash='$userid' LIMIT 1");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$u = $row["e_hash"]; 
	}
	$userFolder = "_USER/$u";
	  if(is_dir($userFolder)) {
		deleteUserDir($userFolder);
      }
	mysqli_query($db_connection, "DELETE FROM user_account WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM seeker_skill_set WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM seeker_profile WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM seeker_bookmarks WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM notifications WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM job_post_activity WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM job_post WHERE company_id='$u'");
	mysqli_query($db_connection, "DELETE FROM experience_detail WHERE e_hash='$u'");	
	mysqli_query($db_connection, "DELETE FROM education_detail WHERE e_hash='$u'");
	mysqli_query($db_connection, "DELETE FROM company_profile WHERE e_hash='$u'");
	
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?><?php 
function deleteUserDir($dirPath){
	if(!is_dir($dirPath)){
		return unlink($dirPath);
	}
	foreach(scandir($dirPath) as $item){
		if($item == '.' || $item == '..'){
			continue;
		}
		if(!deleteUserDir($dirPath . DIRECTORY_SEPARATOR . $item)){
			return false;
		}
	}
	return rmdir($dirPath);
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "unlock"){
	if(!isset($_POST['pass']) || $_POST['pass'] == ""){
		echo "failed";
		exit();
	}
	$pass = md5($_POST['pass']);
	if($pass === "a127fd1f86e4ab650f2216f09992afa4"){
		echo "unlock_ok";
		exit();
	}else{
		echo "failed";
		exit();
	}
}
?><?php 
$userlist = ""; 
$sql = "SELECT * FROM user_account ORDER BY id DESC LIMIT 100";
$query = mysqli_query($db_connection, $sql);
$usercount = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$profile_id = $row["id"];
	$ehash = $row["e_hash"];
	$email = $row["email"];
	$utype = $row["user_type"];
	$is_active = $row["is_active"];
	$contact = $row["contact_number"];
	$avatar = $row["user_image"];
	$activated = $row["activated"];
	$reg_date = strftime("%b, %d %Y at %I:%M %p", strtotime($row["registration_date"]));
	$last_login = strftime("%b, %d %Y at %I:%M %p", strtotime($row["last_login_date"]));
	
	$profile_pic = '<img src="_USER/'.$ehash.'/'.$avatar.'" style="width: 50px;height: auto;" alt="User">';
	if($avatar == NULL){
		$profile_pic = '<img src="_img/avatardefault.png" style="width: 50px;height: auto;" alt="User">';
	}
	if($utype == "seeker"){
		$userlist .= '<div id="user_'.$ehash.'" class="profile_widgets">';
		$userlist .= '<div id="" class="profile_widget" style="margin: 5px .9% 10px;"><div id="db_'.$ehash.'" style="float: right;padding: 5px;">';
		$userlist .= '<button onmousedown="deleteUser(\''.$ehash.'\',\'user_'.$ehash.'\');" class="btn btn-primary btn-small"><span class="fa fa-trash"></span></button></div>';
		$userlist .= '<div class="profile_widget-image" style="vertical-align: top;">'.$profile_pic.'</div>';
		$userlist .= '<div class="profile_widget-details"><h4><a href="javascript:void(0)" onclick="OpenSeekerProfile(\''.$ehash.'\');" style="font-weight:bold;"> '.$ehash.'</a></h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">'.$email.'</span></h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">User type:</span> '.$utype.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Sign Up date:</span> '.$reg_date.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Last login:</span> '.$last_login.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Activation:</span> '.$activated.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><button onclick="OpenSeekerProfile(\''.$ehash.'\');" class="btn btn-small" style="line-height: 15px;"><span class="fa fa-user"></span> View details</button></h4></div></div></div>';
	}else{
		$userlist .= '<div id="user_'.$ehash.'" class="profile_widgets">';
		$userlist .= '<div id="" class="profile_widget" style="margin: 5px .9% 10px;"><div id="db_'.$ehash.'" style="float: right;padding: 5px;">';
		$userlist .= '<button onmousedown="deleteUser(\''.$ehash.'\',\'user_'.$ehash.'\');" class="btn btn-primary btn-small"><span class="fa fa-trash"></span></button></div>';
		$userlist .= '<div class="profile_widget-image" style="vertical-align: top;">'.$profile_pic.'</div>';
		$userlist .= '<div class="profile_widget-details"><h4><a href="#" style="font-weight:bold;"> '.$ehash.'</a></h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">'.$email.'</span></h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">User type:</span> '.$utype.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Sign Up date:</span> '.$reg_date.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Last login:</span> '.$last_login.' </h4>';
		$userlist .= '<h4 style="margin-top: 5px;"><span class="grey-out">Activation:</span> '.$activated.' </h4>';
		$userlist .= '</div></div></div>';
	}
}	
?><?php 
$sql0 = "SELECT * FROM feedback WHERE xp='g'";$gquery = mysqli_query($db_connection, $sql0);$gcount = mysqli_num_rows($gquery);
$sql1 = "SELECT * FROM feedback WHERE xp='a'";$aquery = mysqli_query($db_connection, $sql1);$acount = mysqli_num_rows($aquery);						
$sql2 = "SELECT * FROM feedback WHERE xp='b'";$bquery = mysqli_query($db_connection, $sql2);$bcount = mysqli_num_rows($bquery);						
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Owlphin Admin</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.dashboard.css" rel="stylesheet">
</head>
<body class="owlbody owl-gradient">
<div id="admin_cover" class="div-loader-cover" style="display:block;background: rgb(23, 23, 23);">
<br />
	<form class="lockscreen-credentials" role="form" id="logon" onsubmit="return false;">
		<div class="input-group">
			<h2 class="title"><img src="_img/owlphin_gif.gif" style="height:40px;" /></h2>
			<h1 style="margin-bottom:20px;">Administrator</h1>
			<div style="width: 100%;line-height: 1px;" id="inputB">
				<input class="form-control inputBox" id="password" name="password" style="padding: 10px;width: 50%;text-align: center;font-size: 18px;" placeholder="Password" type="password" autofocus />
			</div>
			<div id="loginBtn" style="line-height: 40px;">
			  <button class="btn" style="padding: 10px;width: 20%;" onclick="unlockAdmin()">Login</button>
			</div>
			<div class="login-extra" style="margin-bottom: 0;">
			<a style="font-size: 18px;" href="javascript:void(0)" onclick="owlphinhome()">Return to home</a> 
		  </div>
		</div>
	</form>
</div>
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<?php include_once("_ext/dashboard_dialog-searchlayer.php");?>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner owl-gradient">
		<div class="container"> 
		  <a class="brand"  href="javascript:void(0)" onclick="owlphinhome()">
			<h2 class="title"><img src="_img/owlphin_gif.gif" style="height:30px;" /></h2>
		  </a>
		  <div class="nav-collapse">
			<ul class="nav pull-right">
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp; Admin</a>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-cog"></i> Account <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
				  <li><a href="javascript:void(0);" onclick="lockAdmin()">Lockscreen</a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		</div>
	</div> 
</div>
<br />
<!-------------------------------------------------------------------->
<div class="main">
	  <div class="main-inner">
		<div class="container">
		   <div class="row">
		     <div class="span6 mobile-no-show">
				<div class="widget">
				  <div class="widget-header">
					<i class="fa fa-bar-chart"></i>
					<h3>Donut Chart of Feedback</h3>
				  </div>
				  <div class="widget-content">
					 <canvas id="donut-chart" class="chart-holder" width="400" height="180"></canvas>
				  </div>
				</div>
			</div>
			<div class="span6 mobile-no-show">
				<div class="widget">
				  <div class="widget-header">
					<i class="fa fa-gear"></i>
					<h3>System Performance</h3>
				  </div>
				  <div class="widget-content">
					<div class="spinner" style="background-color: #000;"></div>
				  </div>
				</div>
			</div>
			<div class="span12 mobile-no-show">
			  <div class="widget widget-nopad">
			  <div id="relax" class="div-loader-cover"><div class="spinner"></div></div>
				<div class="widget-header text-center">
				  <h3>There are <?php echo $usercount?> users on the system</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="cf big_stats">
						<div class="widget-content">
						  <div class="cf">
							<div id="userlist" style="display:none;">
							  <?php echo $userlist;?>	
							</div>
						  </div>
					    </div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
<div id="livesearch"></div>
<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<br /><br />
<?php include_once("_ext/popup_seeker-profile.php");?>
<?php include_once("_ext/default_js.php");?>
<script type="text/javascript">
function unlockAdmin(){
	var pass = _('password').value;
	if(pass == ""){
		_("password").style.borderColor = "rgb(251, 162, 138)";
		_("password").style.borderWidth = "thick";
		_("password").focus();
		return;
	}else{
	document.getElementById("loginBtn").innerHTML = '<button class="btn" style="padding: 10px;width: 20%;" disabled>Checking...</button>';
	var ajax = ajaxObj("POST", "admin.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "unlock_ok"){
					//document.getElementById("admin_cover").style.display = "none";
					$("#admin_cover").fadeOut(500);
					document.getElementById("userlist").style.display = "block";
					_('password').value = "";
					document.getElementById("loginBtn").innerHTML = '<button class="btn" style="padding: 10px;width: 20%;" onclick="unlockAdmin()">Login</button>';
				} else {
					_("password").style.borderColor = "rgb(251, 162, 138)";
					_("password").style.borderWidth = "medium";
					_("password").focus();
					document.getElementById("loginBtn").innerHTML = '<button class="btn" style="padding: 10px;width: 20%;" onclick="unlockAdmin()">Login</button>';
				}
			}
		}
		ajax.send("action=unlock&pass="+pass);
	}
}
function lockAdmin(){
	$("#admin_cover").fadeIn(200);
	document.getElementById("userlist").style.display = "none";
}
function deleteUser(userid,userbox){
	Confirm.render("Are you sure you want to delete this user completely?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		document.getElementById("relax").style.display = "block";
		var ajax = ajaxObj("POST", "admin.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "delete_ok"){
					_(userbox).style.display = 'none';
					document.getElementById("relax").style.display = "none";
				} else {
					Alert.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_user&userid="+userid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>
<script src="_js/chart.min.js"></script>
<script type="text/javascript">
var g = <?php echo $gcount;?>;
var a = <?php echo $acount;?>;
var b = <?php echo $bcount;?>;
var doughnutData = [
	{value: b,color: "#F7464A"},
	{value: a,color: "#46BFBD"},
	{value: g,color: "#066c24 "}
];
var myDoughnut = new Chart(document.getElementById("donut-chart").getContext("2d")).Doughnut(doughnutData);
	</script>
</body>
</html>
