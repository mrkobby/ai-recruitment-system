<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
mysqli_query($db_connection, "UPDATE company_profile SET last_checks_rjobs=now() WHERE e_hash='$log_email'");
?><?php 
include_once("_ext/dashboard_ulog.php");
if($e != $log_email){
	header("location: ../bacsyd");
    exit();
}
if($utype == "seeker"){
	header("location: ../bacsyd");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>My jobs</title>
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
			<li><a href="javascript:void(0);" onclick="notifications('<?php echo $log_email;?>')"><i class="fa fa-bell"></i><span>Notifications</span> </a><span id="quick_note_num"><?php echo $note_label;?></span> </li>
			<li class="active"><a href="javascript:void(0);" onclick="rjob('<?php echo $log_email;?>')"><i class="fa fa-briefcase"></i><span>Jobs</span> </a> </li>
			<?php echo $subnav_extras2;?>
			<?php echo $subnav_extras3;?>
			<?php echo $jobpost;?>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="main">
	  <div class="main-inner">
		<div class="container">
		  <!-------------------------------------------------------------------->
		   <div class="row">
			<div id="job1" class="span12">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center">
				  <h3>Jobs you have posted</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="big_stats" style="margin-top: 1em;">
						<div class="rjobs">
						  <div id="rjoblogs" class="rjoblogs"><div class="spinner" style="background-color: #000;"></div></div>
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
<?php include_once("_ext/popup_jobpost.php");?>
<?php include_once("_ext/popup_jobpost-edit.php");?>
<?php include_once("_ext/popup_changedp.php");?>
<?php include_once("_ext/popup_company-profile.php");?>
<?php include_once("_ext/popup_jobpost-preview.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/popup_add-requirements.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
<script src="_js/multiple-select.js"></script> 
<script type="text/javascript">
$(function() {
    $('.multisel').change(function() {
        console.log($(this).val());
    }).multipleSelect({
        width: '100%'
    });
});
$(document).ready(function(e){
	var xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function(){
		if(xmlhttp2.readyState==4&&xmlhttp2.status==200){
			document.getElementById('rjoblogs').innerHTML = xmlhttp2.responseText;
		}
	}	
	xmlhttp2.open('GET','_parse/load_rjobs.php', true);
	xmlhttp2.send();

})
</script>
</body>
</html>