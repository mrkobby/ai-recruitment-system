<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
mysqli_query($db_connection, "UPDATE seeker_profile SET last_checks_jobs=now() WHERE e_hash='$log_email'");
?><?php 
include_once("_ext/dashboard_ulog.php");
if($e != $log_email){
	header("location: ../bacsyd");
    exit();
}
if($utype == "recruiter"){
	header("location: ../bacsyd");
    exit();
}
?><?php 
$profile_stregth = 0;
$sql_dp = "SELECT * FROM user_account WHERE e_hash='$log_email'";$query_dp = mysqli_query($db_connection, $sql_dp);
while ($row = mysqli_fetch_array($query_dp, MYSQLI_ASSOC)) {$ps_avatar = $row["user_image"];}
if($ps_avatar == NULL){$profile_stregth = $profile_stregth + 0;}else{$profile_stregth = $profile_stregth + 3;}
$ps_seeker_bio = "";$sql_bio = "SELECT * FROM seeker_profile WHERE e_hash='$log_email'";$query_bio = mysqli_query($db_connection, $sql_bio);
while ($row = mysqli_fetch_array($query_bio, MYSQLI_ASSOC)) {$ps_seeker_bio = $row["seeker_bio"];}
if($ps_seeker_bio == " "){$profile_stregth = $profile_stregth + 0;}else if($ps_seeker_bio != " " && (strlen($ps_seeker_bio)) < 39 ){$profile_stregth = $profile_stregth + 4;}else{$profile_stregth = $profile_stregth + 10;}
$sql_edu = "SELECT id FROM education_detail WHERE e_hash='$log_email'";$query_edu = mysqli_query($db_connection, $sql_edu);$ps_edu_num = mysqli_num_rows($query_edu);
if($query_edu == true){$profile_stregth = $profile_stregth + ($ps_edu_num * 4);}
$sql_xp = "SELECT id FROM experience_detail WHERE e_hash='$log_email'";$query_xp = mysqli_query($db_connection, $sql_xp);$ps_xp_num = mysqli_num_rows($query_xp);
if($query_xp == true){$profile_stregth = $profile_stregth + ($ps_xp_num * 5);}
$sql_skill = "SELECT id FROM seeker_skill_set WHERE e_hash='$log_email'";$query_skill = mysqli_query($db_connection, $sql_skill);$ps_skill_num = mysqli_num_rows($query_skill);
if($query_skill == true && $ps_skill_num < 7){$profile_stregth = $profile_stregth + ($ps_skill_num * 3);}else if($ps_skill_num > 7){$profile_stregth = $profile_stregth + 18;}
mysqli_query($db_connection, "UPDATE seeker_profile SET profile_strength='$profile_stregth' WHERE e_hash='$log_email'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Jobs</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.dashboard.css" rel="stylesheet">
</head>
<body>
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<?php include_once("_ext/dashboard_navbar.php");?>
<?php include_once("_ext/dashboard_dialog-searchlayer.php");?>
<?php include_once("_parse/_all_note_check.php");?>
  <div class="everything-everything"> <!--style="filter:blur(3px)" -->
	<div class="subnavbar">
	  <div class="subnavbar-inner">
		<div class="container">
		  <ul class="mainnav">
			<li><a href="javascript:void(0);" onclick="owlphinhome()"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
			<li <?php echo $usershow;?>><a href="javascript:void(0);" onclick="profile('<?php echo $log_email;?>')"><i class="fa fa-user"></i><span>Profile</span> </a> </li>
			<li><a href="javascript:void(0);" onclick="notifications('<?php echo $log_email;?>')"><i class="fa fa-bell"></i><span>Notifications</span> </a><span id="quick_note_num"><?php echo $note_label;?></span> </li>
			<?php echo $subnav_extras1;?>
			<li class="active"><a href="javascript:void(0);" onclick="jobs('<?php echo $log_email;?>')"><i class="fa fa-briefcase"></i><span>View Jobs</span> </a> </li>
			<?php echo $subnav_extras3;?>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="main">
	  <div class="main-inner">
		<div class="container">
		  <!-------------------------------------------------------------------->
		   <div class="row">
			<div class="span12">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center">
				  <h3>Jobs you may be interested in </h3>
				</div>
				<div class="text-center mobile-no-show" >
				<form class="navbar-search text-center mobile-no-show" style="margin-top: 0px;margin-left: 35px;">
				  <input type="text" name="qy" id="qy" onKeyUp="fy(this.value)" onBlur="hideLiveJobs(this)" class="span11 text-center" 
				  style="background: linear-gradient(to right, #fff, #c1c1c1 25%, #c1c1c1 75%, #fff 100%);font-size: 16px;border: 0px;" placeholder="Search job title or qualification or job type or keywords">
				</form>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="big_stats" style="margin-top: 1em;">
						<div class="jobs"> 
						  <div id="joblogs"><div class="spinner" style="background-color: #000;"></div></div>
						  <div id="joblivesearch"></div>
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
 <div id="shortlist_initiator"></div>
 <br /><br /><br /><br />
<?php include_once("_ext/dashboard_footer.php");?>
<?php include_once("_ext/popup_jobpost-preview.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
<script type="text/javascript">
function fy(str){
	var j1=document.getElementById("qy").value;
	var xmlhttp;
	if (str.length==0) {
		document.getElementById("joblivesearch").innerHTML="";
		document.getElementById("joblivesearch").style.border="0px";
		document.getElementById("joblivesearch").style.display="block";
		$("#joblogs").show(500);
		return;
	  }
	if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();
	  }else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("joblivesearch").innerHTML=xmlhttp.responseText;
		document.getElementById("joblivesearch").style.display="block";
		$("#joblogs").hide(500);
		}
	  }
	xmlhttp.open("GET","_parse/_call_job_search_ajax.php?n="+encodeURIComponent(j1),true);
	xmlhttp.send();	
}
function hideLiveJobs(search){
	//document.getElementById("livesearch").style.display="none";
}
</script>
<script type="text/javascript">
$(document).ready(function(e){
	var xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function(){
		if(xmlhttp2.readyState==4&&xmlhttp2.status==200){
			document.getElementById('joblogs').innerHTML = xmlhttp2.responseText;
		}
	}	
	xmlhttp2.open('GET','_parse/load_jobs.php', true);
	xmlhttp2.send();

})
function saveToggle(type,user,elem,jid){
	_(elem).innerHTML = '<button class="btn btn-small">...</button>';
	var ajax = ajaxObj("POST", "_parse/_system_save_apply.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "save_ok"){
				_(elem).innerHTML = '<button class="btn btn-small" id="saveBtn_" disabled>Saved <span class="fa fa-check-circle"></span></button>';
				$('.'+ elem).html('<button class="btn btn-small" id="saveBtn_" disabled>Saved <span class="fa fa-check-circle"></span></button>');
			} else if(ajax.responseText == "unsave_ok"){
				_(elem).innerHTML = '<button class="btn btn-small" id="saveBtn_" disabled>Bookmark removed</button>';
				$('.'+ elem).html('<button class="btn btn-small" id="saveBtn_" disabled>Bookmark removed</button>');
			} else {
				Alert.render(ajax.responseText);
				_(elem).innerHTML = '<button class="btn btn-small" id="saveBtn_" disabled>...</button>';
				$('.'+ elem).html('<button class="btn btn-small" id="saveBtn_" disabled>...</button>');
			}
		}
	}
	ajax.send("type1="+type+"&user1="+user+"&jid1="+jid);
}
function applyToggle(type,user,elem,jid){
	_(elem).innerHTML = '<button class="btn btn-small">...</button>';
	var ajax = ajaxObj("POST", "_parse/_system_save_apply.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "apply_ok"){
				_(elem).innerHTML = '<button class="btn btn-success btn-small" id="applyBtn_" disabled>Application sent</button>';
				$('.'+ elem).html('<button class="btn btn-success btn-small" id="applyBtn_" disabled>Application sent</button>');
				Successlong.render("Your current profile details has been sent to recruiter. Any future changes you make to your profile will not affect the details with which this particular job was applied.");
			} else if(ajax.responseText == "unapply_ok"){
				_(elem).innerHTML = '<button class="btn btn-warning btn-small" id="applyBtn_" disabled>Cancelled</button>';
				$('.'+ elem).html('<button class="btn btn-warning btn-small" id="applyBtn_" disabled>Cancelled</button>');
			} else {
				Alert.render(ajax.responseText);
				_(elem).innerHTML = '<button class="btn btn-small" id="applyBtn_" disabled>...</button>';
				$('.'+ elem).html('<button class="btn btn-small" id="applyBtn_" disabled>...</button>');
			}
		}
	}
	ajax.send("type2="+type+"&user2="+user+"&jid2="+jid);
}
</script>
</body>
</html>