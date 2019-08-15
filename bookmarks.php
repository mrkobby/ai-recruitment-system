<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
mysqli_query($db_connection, "UPDATE seeker_profile SET last_check_bookmarks=now() WHERE e_hash='$log_email'");
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
$isApplied = false;
if($user_ok == true){
	$apply_check = "SELECT id FROM job_post_activity WHERE e_hash='$log_email'";
	if(mysqli_num_rows(mysqli_query($db_connection, $apply_check)) > 0){
        $isApplied = true;
    }
}
?><?php 
$bookList = "";
$sql = "SELECT * FROM seeker_bookmarks WHERE e_hash='$log_email' ORDER BY datesaved DESC";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$bid = $row["id"];
	$job_id = $row["job_id"];
	$datesaved  = $row["datesaved"];
	$sql1 = "SELECT * FROM job_post WHERE id='$job_id'";
	$query1 = mysqli_query($db_connection, $sql1);
	while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$job_type = $row["job_type"];
		$company_id = $row["company_id"];
		$created_date = $row["created_date"];
		$deadline_date = strftime("%b, %d %Y", strtotime($row["deadline_date"]));
		$job_title = $row["job_title"];
		$job_description = $row["job_description"];
		$region = $row["region"];
		$qualification = $row["qualification"];
		$is_active = $row["is_active"];	
		$bookDeleteButton = '';
		if($e == $log_email){
			$bookDeleteButton = '<div style="float: right;padding: 5px;" id="bkdb_'.$bid.'"><button class="btn btn-primary btn-small" onmousedown="deleteBookmark(\''.$bid.'\',\'bkdb_'.$bid.'\');" ><span class="fa fa-trash"></span></button></div>';
		}
		$mysql = "SELECT company_name,e_hash FROM company_profile WHERE e_hash='$company_id'";
		$_query = mysqli_query($db_connection, $mysql);
		while ($row = mysqli_fetch_array($_query, MYSQLI_ASSOC)) {
			$company_name = $row["company_name"];
			$comp_id = $row["e_hash"];
			$sql3 = "SELECT user_image FROM user_account WHERE e_hash='$comp_id'";
			$query1 = mysqli_query($db_connection, $sql3);
			while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
				$company_image = $row["user_image"];
				$company_pic = '<img src="_USER/'.$comp_id.'/'.$company_image.'" alt="User">';
				if($company_image == NULL){
						$company_pic = '<img src="_img/avatardefault.png" alt="user">';
				}
				$apply_button = '<button class="btn btn-small" id="applyBtn_" onclick="applyToggle(\'apply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Apply for this job</button>';
				if($isApplied == true){
					$apply_button = '<button class="btn btn-info btn-small" id="applyBtn_" onclick="applyToggle(\'unapply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Cancel application</button>';
				} else if($user_ok == true){
					$apply_button = '<button class="btn btn-small" id="applyBtn_" onclick="applyToggle(\'apply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Apply for this job</button>';
				}
				if($is_active == 0){
					$bookList .= '<div id="bkdb_'.$bid.'" class="job">'.$bookDeleteButton.'';	
					$bookList .= '<div class="job-user-image">'.$company_pic.'</div>';	
					$bookList .= '<div class="job-details"><h4>'.$company_name.'</h4><h4 style="margin-top:5px;"><span class="grey-out">Job title:</span> '.$job_title.'</h4>';	
					$bookList .= '<h4 style="margin-top:5px;"><span class="grey-out">Application deadline:</span> '.$deadline_date.'</h4><h4 style="margin-top:5px;">';	
					$bookList .= '<button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'bkdb_'.$job_id.'\');">Preview</button> ';	
					$bookList .= '<span id="applyBtn_'.$job_id.'">'.$apply_button.'</span> </h4></div></div>';	
				}else{
					$bookList .= '<div id="bkdb_'.$bid.'" class="job" style="background-color: #fee3e3;">'.$bookDeleteButton.'';	
					$bookList .= '<div class="job-user-image">'.$company_pic.'</div>';	
					$bookList .= '<div class="job-details"><h4>'.$company_name.'</h4><h4 style="margin-top:5px;"><span class="grey-out">Job title:</span> '.$job_title.'</h4>';	
					$bookList .= '<h4 style="margin-top:5px;"><span class="grey-out">Application deadline:</span> '.$deadline_date.'</h4><h4 style="margin-top:5px;">';	
					$bookList .= '<button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'bkdb_'.$job_id.'\');">Preview</button> ';	
					$bookList .= '</h4></div></div>';	
				}
			}		
		}		
	}	
}
?><?php 
$queueList = "";
$sql2 = "SELECT * FROM job_post_activity WHERE e_hash='$log_email' ORDER BY apply_date DESC";
$query = mysqli_query($db_connection, $sql2);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$qid = $row["id"];
	$job_post_id = $row["job_post_id"];
	$apply_date = $row["apply_date"];
	$sql = "SELECT is_active FROM job_post WHERE id='$job_post_id'";
	$query = mysqli_query($db_connection, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$is_active = $row["is_active"];
	}
	if($is_active == 0){
		$queueList .= '<div id="green_'.$job_post_id.'" onclick="OpenJobDetails(\''.$job_post_id.'\',\'green_'.$job_post_id.'\');" class="profile_widget hand" style="margin: 0px .9% 5px;border: 1px solid #7d7979;background: #8eff93;">';
		$queueList .= '<div class="profile_widget-image"><span style="font-size: 1em;color: #575757;" class="fa fa-suitcase"></span></div>';
		$queueList .= '<div class="profile_widget-details"><h5>Job ID: mtc_01'.$job_post_id.'_fbr</h5></div></div>';
	}else{
		$queueList .= '<div id="red_'.$job_post_id.'" onclick="OpenJobDetails(\''.$job_post_id.'\',\'green_'.$job_post_id.'\');" class="profile_widget hand" style="margin: 0px .9% 5px;border: 1px solid #7d7979;background: #fed5cc;">';
		$queueList .= '<div class="profile_widget-image"><span style="font-size: 1em;color: #575757;" class="fa fa-suitcase"></span></div>';
		$queueList .= '<div class="profile_widget-details"><h5>Job ID: mtc_01'.$job_post_id.'_fbr</h5></div></div>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Bookmarks</title>
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
			<li class="active"><a href="javascript:void(0);" onclick="bookmarks('<?php echo $log_email;?>')"><i class="fa fa-bookmark"></i><span>Saved</span> </a> </li>
			<?php echo $subnav_extras2;?>
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
			<div class="span8">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center">
				  <h3>Saved jobs</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="big_stats">
						<div class="savedjobs"> 
						  <div id="savedjoblogs">
							<?php echo $bookList;?>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="span4">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center" style="margin-bottom: 5px;">
				  <h3>Queued jobs</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="profile_widgets"> 
						  <div class="queued_jobs">
						     <?php echo $queueList;?>
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
<?php include_once("_ext/popup_changedp.php");?>
<?php include_once("_ext/popup_jobpost.php");?>
<?php include_once("_ext/popup_company-profile.php");?>
<?php include_once("_ext/popup_jobpost-preview.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
<script type="text/javascript">
function applyToggle(type,user,elem,jid){
	_(elem).innerHTML = '<button class="btn btn-small">...</button>';
	var ajax = ajaxObj("POST", "_parse/_system_save_apply.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "apply_ok"){
				_(elem).innerHTML = '<button class="btn btn-success btn-small" id="applyBtn_" disabled>Application sent</button>';
				Successlong.render("Your current profile details has been sent to recruiter. Any future changes you make to your profile will not affect the details with which this particular job was applied.");
			} else if(ajax.responseText == "unapply_ok"){
				_(elem).innerHTML = '<button class="btn btn-small" id="applyBtn_" disabled>Application was cancelled</button>';
			} else {
				Alert.render(ajax.responseText);
				_(elem).innerHTML = '<button class="btn btn-small" id="applyBtn_" disabled>...</button>';
			}
		}
	}
	ajax.send("type2="+type+"&user2="+user+"&jid2="+jid);
}
function deleteBookmark(bid,bkbox){
	Confirm.render("Are you sure you want to remove this bookmark?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "delete_ok"){
					_(bkbox).style.display = 'none';
				} else {
					Hint.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_bookmark&bid="+bid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>
</body>
</html>