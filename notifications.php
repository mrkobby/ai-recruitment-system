<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
mysqli_query($db_connection, "UPDATE user_account SET last_notes_check=now() WHERE e_hash='$log_email'");
?><?php 
include_once("_ext/dashboard_ulog.php");
if($e != $log_email){
	header("location: ../bacsyd");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Notifications</title>
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
			<li class="active"><a href="javascript:void(0);"><i class="fa fa-bell"></i><span>Notifications</span> </a> </li>
			<?php echo $subnav_extras1;?>
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
		   <div class="row">
			<div class="span12">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center">
				  <h3>You have a total of <?php echo $notes_numrows?> notifications</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="cf big_stats">
						<div class="widget-content">
						  <div class="cf">
						   <div class="profile_widgets"> 
							 <div id="load_r_notes">
							   <?php echo $notification_list;?>	
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
	</div>
  </div>
<br /><br /><br /><br />
<?php include_once("_ext/dashboard_footer.php");?>
<?php include_once("_ext/popup_changedp.php");?>
<?php include_once("_ext/popup_jobpost.php");?>
<?php include_once("_ext/popup_jobpost-preview.php");?>
<?php include_once("_ext/popup_company-profile.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<?php include_once("_ext/popup_view-shortlist-candidates.php");?>
<?php include_once("_ext/popup_email-shortlisted-candidate.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/popup_add-requirements.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
</body>
</html>