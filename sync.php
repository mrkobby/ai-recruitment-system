<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
?><?php 
$sql0 = "SELECT * FROM seeker_profile";$query0 = mysqli_query($db_connection, $sql0);$seeker_num = mysqli_num_rows($query0);
$sql1 = "SELECT * FROM company_profile";$query1 = mysqli_query($db_connection, $sql1);$company_num = mysqli_num_rows($query1);
//$sql2 = "SELECT id FROM job_post";$query2 = mysqli_query($db_connection, $sql2);$jobs_num = mysqli_num_rows($query2);
$sql3 = "SELECT id FROM job_post WHERE company_id='$log_email'";$query3 = mysqli_query($db_connection, $sql3);$jobposts_num = mysqli_num_rows($query3);
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
?><?php 
include_once("_ext/dashboard_ulog.php");
if($e != $log_email){
	header("location: ../bacsyd");
    exit();
}
$stats = '';$shortcut = '';
if($utype == "seeker"){
	$stats .= '<div class="big_stats cf">';
    $stats .= '<div class="stat"><span class="value">'.$seeker_num.'</span> <p style="margin: 6px 0 9px;">Job seekers</p></div>';
    $stats .= '<div class="stat"><span class="value">'.$company_num.'</span> <p style="margin: 6px 0 9px;">Employers</p></div> ';
    //$stats .= '<div class="stat"><span class="value">'.$jobs_num.'</span> <p style="margin: 6px 0 9px;">Job posts</p></div>';
   // $stats .= '<div class="stat"><span class="value">'.$profile_stregth.'%</span> <p style="margin: 6px 0 9px;">Profile strength</p></div>';
    $stats .= '</div>';
	$shortcut .= '<a href="javascript:void(0);" onclick="bookmarks(\''.$log_email.'\')" class="shortcut">';
	$shortcut .= '<i class="shortcut-icon fa fa-bookmark"></i>';
	$shortcut .= '<span class="shortcut-label">Bookmarks</span> ';
	$shortcut .= '</a>';
	$shortcut .= '<a href="javascript:void(0);" onclick="jobs(\''.$log_email.'\')" class="shortcut">';
	$shortcut .= '<i class="shortcut-icon fa fa-briefcase"></i>';
	$shortcut .= '<span class="shortcut-label">Jobs</span> ';
	$shortcut .= '</a>';
}else if($utype == "recruiter"){
	$stats .= '<div class="big_stats cf">';
	$stats .= '<div class="stat"><span class="value">'.$seeker_num.'</span> <p style="margin: 6px 0 9px;">Job seekers</p></div>';
    $stats .= '<div class="stat"><span class="value">'.$jobposts_num.'</span> <p style="margin: 6px 0 9px;">Job posts</p></div>';
    $stats .= '</div>';
	$shortcut .= '<a href="javascript:void(0);" class="shortcut" onclick="rjob(\''.$log_email.'\')">';
	$shortcut .= '<i class="shortcut-icon fa fa-briefcase"></i>';
	$shortcut .= '<span class="shortcut-label">Jobs</span> ';
	$shortcut .= '</a>';
	$shortcut .= '<a href="javascript:void(0);" pd-popup-open="companyprofile" class="shortcut">';
	$shortcut .= '<i class="shortcut-icon fa fa-institution"></i>';
	$shortcut .= '<span class="shortcut-label">Info</span> ';
	$shortcut .= '</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bacsyd - Dashboard</title>
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
			<li class="active"><a href="javascript:void(0);" onclick="owlphinhome()"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
			<li <?php echo $usershow;?>><a href="javascript:void(0);" onclick="profile('<?php echo $log_email;?>')"><i class="fa fa-user"></i><span>Profile</span> </a> </li>
			<li><a href="javascript:void(0);" onclick="notifications('<?php echo $log_email;?>')"><i class="fa fa-bell"></i><span>Notifications</span> </a><span id="quick_note_num"><?php echo $note_label;?></span> </li>
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
			<div class="span6">
			  <div class="widget widget-nopad">
				<div class="widget-header"> <i class="fa fa-list-alt"></i>
				  <h3>Stats</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <?php echo $stats;?>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="span6 mobile-no-show">
			  <div class="widget">
				<div class="widget-header"> <i class="fa fa-bookmark"></i>
				  <h3>Shortcuts</h3>
				</div>
				<div class="widget-content">
				  <div class="shortcuts"> 
					<?php echo $shortcut;?>
					<a href="javascript:void(0);" class="shortcut" onclick="settings('<?php echo $log_email;?>')" >
					  <i class="shortcut-icon fa fa-cogs"></i>
					  <span class="shortcut-label">Settings</span> 
					</a>
					<a href="javascript:void(0);" class="shortcut" onclick="logout()"> 
					  <i class="shortcut-icon fa fa-power-off"></i>
					  <span class="shortcut-label">Logout</span> 
					</a> 
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
 <br /><br /><br />
<?php include_once("_ext/dashboard_footer.php");?>
<?php include_once("_ext/popup_changedp.php");?>
<?php include_once("_ext/popup_jobpost.php");?>
<?php include_once("_ext/popup_company-profile.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/popup_add-requirements.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
</body>
</html>