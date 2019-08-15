<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
?><?php 
include_once("_ext/dashboard_ulog.php");
?><?php 
$sql = "SELECT * FROM user_account WHERE e_hash='$e'";
$_query = mysqli_query($db_connection, $sql);
$numrows0 = mysqli_num_rows($_query);
if($numrows0 < 1 ){
	header("location: _sys/_error_msg.php?msg=That user does not exist");
    exit();	
}
while ($row = mysqli_fetch_array($_query, MYSQLI_ASSOC)) {
	$c_id = $row["id"];
	$c_ehash = $row["e_hash"];
	$c_email = $row["email"];
	$c_utype = $row["user_type"];
	$c_is_active = $row["is_active"];
	$c_contact = $row["contact_number"];
	$c_avatar = $row["user_image"];
	$c_reg_date = $row["registration_date"];
	$c_last_login = $row["last_login_date"];
}
$c__pic = '<img src="_img/avatardefault.png" class="img-circle" alt="User">';
if($c_avatar != NULL){
	$c__pic = '<img src="_USER/'.$c_ehash.'/'.$c_avatar.'" class="img-circle" alt="User">';
}else if($c_ehash == $log_email && $c_avatar != NULL){
	$c__pic = '<img src="_USER/'.$c_ehash.'/'.$c_avatar.'" pd-popup-open="changeDp" class="img-circle" alt="User">';
}else if($c_ehash == $log_email && $c_avatar == NULL){
	$c__pic = '<img src="_img/avatardefault.png" pd-popup-open="changeDp" class="img-circle" alt="User">';
}
$c_phonenumber = "";if($c_contact == ""){$c_phonenumber = "Contact not set";}else{$c_phonenumber = '<span class="fa fa-phone"></span> '.$c_contact.'';}
$sql = "SELECT * FROM company_profile WHERE e_hash='$c_ehash'";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$c_name = $row["company_name"];
	$b_stream_name = $row["business_stream_name"];
	$c_website_url  = $row["company_website_url"];
}
if($c_ehash == $log_email){
	$sql = "SELECT avatartemp FROM user_account WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$row = mysqli_fetch_row($query);
	$old_dp = $row[0];
	if($old_dp != ""){
		$picurl = "_USER/$log_email/$old_dp"; 
		if (file_exists($picurl)) { unlink($picurl); }
	}
	mysqli_query($db_connection, "UPDATE user_account SET avatartemp=NULL WHERE e_hash='$log_email'");
}
?><?php 
$rjoblist = "";$editjob = "";$addreq = "";$is_a_no_no = "display:;";
$sql = "SELECT * FROM job_post WHERE company_id='$c_ehash' ORDER BY created_date DESC LIMIT 100";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$job_id = $row["id"];
	$job_type = $row["job_type"];
	$company_id = $row["company_id"];
	$created_date = strftime("%b %d, %Y at %I:%M %p", strtotime($row["created_date"]));
	$deadline_date = $row["deadline_date"];
	$deadline_mhs = $row["deadline_mhs"];
	$job_title = $row["job_title"];
	$job_description = $row["job_description"];
	$region = $row["region"];
	$qualification = $row["qualification"];
	$is_active = $row["is_active"];
	$shortlist_limit = $row["shortlist_limit"];
	$edit_elapsed = $row["edit_elapsed"];
	$rjobDeleteButton = '';
	if($company_id == $log_email){
		$rjobDeleteButton = '<span id="rjb_'.$job_id.'"><button class="btn btn-small" onmousedown="deleteRJob(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Delete</button> </span>';
	}
	$sql1 = "SELECT id FROM job_post_activity WHERE job_post_id='$job_id'";
	$query1 = mysqli_query($db_connection, $sql1);
	$num_of_apply = mysqli_num_rows($query1);
	
	if($edit_elapsed == 0 && $c_ehash == $log_email){
		$editjob = '<button class="btn btn-small" onclick="EditJobPost(\''.$job_id.'\');">Edit</button>';
		$addreq = '<button class="btn btn-small" onclick="AddRequirements(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Add requirements</button>';
	}else{
		$editjob = '';
		$addreq = '';
		$is_a_no_no = "display:none;";
	}
	
	if($is_active == 0){
		$rjoblist .= '<div id="rjb_'.$job_id.'" class="rjob" style="*background: #dafed0;">';
		$rjoblist .= '<div style="float:right;padding:8px;'.$is_a_no_no.'"><span style="font-size:1em;color: #7c7d7d;" class="fa fa-group"> '.$num_of_apply.'</span></div>';
		$rjoblist .= '<div class="rjob-user-image"><span class="fa fa-institution"></span></div>';
		$rjoblist .= '<div class="rjob-details"><h3>Title : '.$job_title.'</h3><h4 style="margin-top:5px;"><span class="grey-out">Job location:</span> '.$region.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date created:</span> '.$created_date.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Number of applicants:</span> '.$num_of_apply.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Shortlist limit:</span> '.$shortlist_limit.'%</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Preview</button> ';
		$rjoblist .= ''.$editjob.' ';
		$rjoblist .= ''.$addreq.' ';
		$rjoblist .= ''.$rjobDeleteButton.' </h4></div></div>';
	}else{
		$rjoblist .= '<div id="rjb_'.$job_id.'" class="rjob" style="background-color: #fee3e3;">';
		$rjoblist .= '<div style="float:right;padding:8px;'.$is_a_no_no.'"><span style="font-size:1em;color: #7c7d7d;" class="fa fa-group"> '.$num_of_apply.'</span></div>';
		$rjoblist .= '<div class="rjob-user-image"><span class="fa fa-institution"></span></div>';
		$rjoblist .= '<div class="rjob-details"><h3>Title : '.$job_title.'</h3><h4 style="margin-top:5px;"><span class="grey-out">Job location:</span> '.$region.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date created:</span> '.$created_date.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Status:</span> Job Ad has elapsed</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Number of applicants:</span> '.$num_of_apply.'</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Shortlist limit:</span> '.$shortlist_limit.'%</h4>';
		$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Preview</button> ';
		$rjoblist .= ''.$rjobDeleteButton.' </h4></div></div>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Profile</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.dashboard.css" rel="stylesheet">
</head>
<body>
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<?php include_once("_ext/dashboard_navbar.php");?>
<?php include_once("_ext/dashboard_dialog-searchlayer.php");?>
<?php include_once("_parse/_all_note_check.php");?>
  <div class="everything-everything">
	<div class="subnavbar">
	  <div class="subnavbar-inner">
		<div class="container">
		  <ul class="mainnav">
			<li><a href="javascript:void(0);" onclick="owlphinhome()"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
			<li <?php echo $usershow;?>><a href="javascript:void(0);" onclick="profile('<?php echo $log_email;?>')"><i class="fa fa-user"></i><span>Profile</span> </a> </li>
			<li><a href="javascript:void(0);" onclick="notifications('<?php echo $log_email;?>')"><i class="fa fa-bell"></i><span>Notifications</span> </a><span id="quick_note_num"><?php echo $note_label;?></span> </li>
			<?php echo $subnav_extras1;?>
			<?php echo $subnav_extras2;?>
			<?php echo $subnav_extras3;?>
			<?php echo $jobpost;?>
			<li class="active right-border"><a href="javascript:void(0);"><i class="fa fa-institution"></i><span><?php echo $c_name;?></span> </a> </li>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="main">
	  <div class="main-inner">
		<div class="container">
		  <div class="row">
			<div class="span12">
			  <div class="box box-widget widget-user profile-gradient">
				<div style="text-align: center;"><div class="widget-user-header bg-profile"></div></div>	
				<div id="targetDpLayer" class="widget-user-image hand targetDpLayer"><?php echo $c__pic;?></div>
				<div class="banner-user text-center" style="padding-bottom: 0px;">
				  <h2 class="profile-user text-center" style="font-weight:600;"><?php echo $c_name;?></h2>
				  <h3  style="font-size:24px;font-weight: lighter;"> <?php echo $b_stream_name;?></h3>
				  <h3><span style="font-size:14px;"><span style="margin: 0;color: #777;" class="fa fa-envelope"></span> <?php echo $c_email;?></span></h3>
				  <h3><span style="font-size:14px;"><span style="margin: 0;color: #777;font-size:14px;" class="fa fa-phone"></span> <?php echo $c_contact;?></span></h3>
				  <h3><span style="font-size:12px;"><span style="margin: 0;color: #777;font-size:14px;" class="fa fa-globe"></span> <a href="http://<?php echo $c_website_url?>" target="blank"><?php echo $c_website_url;?></a></span></h3><br>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="row" style="margin-bottom: 15px;">
		    <div class="span12">
			  <div class="widget widget-nopad">
				<div class="widget-header"> <i class="fa fa-briefcase"></i>&nbsp;
				  <h3>Job Ads</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="big_stats cf">
						<div class="rjobs">
						  <div id="rjoblogs" class="rjoblogs"><?php echo $rjoblist;?></div>
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
  <br /><br /><br />
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
<script type="text/javascript">

</script>
</body>
</html>