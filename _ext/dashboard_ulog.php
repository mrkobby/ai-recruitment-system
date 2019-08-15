<?php 
$e = "";
if(isset($_GET["e"])){
	$e = $_GET['e'];
} else {
    header("location: ../bacsyd");
    exit();	
}
$sql = "SELECT * FROM user_account WHERE e_hash='$log_email'";
$user_query = mysqli_query($db_connection, $sql);
$numrows = mysqli_num_rows($user_query);
if($numrows < 1 ){
	header("location: _sys/_error_msg.php?msg=That user does not exist");
    exit();	
}
	while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
		$profile_id = $row["id"];
		$ehash = $row["e_hash"];
		$email = $row["email"];
		$utype = $row["user_type"];
		$is_active = $row["is_active"];
		$contact = $row["contact_number"];
		$avatar = $row["user_image"];
		$reg_date = $row["registration_date"];
		$last_login = $row["last_login_date"];
	}
$user_pic = '<img src="_USER/'.$log_email.'/'.$avatar.'" class="img-circle" alt="User">';
if($avatar == NULL){
		$user_pic = '<img src="_img/avatardefault.png" class="img-circle" alt="User">';
}
$user_phonenumber = "";
if($contact == ""){
	$user_phonenumber = "Contact not set";
}else{
	$user_phonenumber = '<span class="fa fa-phone"></span> '.$contact.'';
}

$userhide = '';$usershow = '';$jobpost = '';$jobpost = '';$subnav_extras1 = '';$subnav_extras2 = '';$subnav_extras3 = '';$user_cv = '';
if($utype == "seeker"){
	$userhide = 'style="display:none;"';
	$jobpost = '';
	$subnav_extras1 = '<li><a href="javascript:void(0);" onclick="bookmarks(\''.$log_email.'\')"><i class="fa fa-bookmark"></i><span>Saved</span> </a><span id="quick_job_bookmark"></span> </li>';
	$subnav_extras2 = '<li><a href="javascript:void(0);" onclick="jobs(\''.$log_email.'\')"><i class="fa fa-briefcase"></i><span>View Jobs</span> </a> <span id="quick_job_num"></span></li>';
	$subnav_extras3 = '<li class="right-border"><a href="javascript:void(0);" onclick="settings(\''.$log_email.'\')"><i class="fa fa-gears"></i><span>Settings</span> </a> </li>';
	$sql = "SELECT * FROM seeker_profile WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];
		$date_of_birth = $row["date_of_birth"];
		$gender = $row["gender"];
		$seeker_bio = $row["seeker_bio"];
		$cv = $row["cv"];
		$last_job_apply_date = $row["last_job_apply_date"];
	}
	$user_cv .= '<h4><b style="color:green;font-size: 16px;">Available</b></h4>';
	$user_cv .= '<a href="_USER/'.$log_email.'/'.$cv.'">Click here to download attached file</a>';
	if($cv == NULL){
			$user_cv = '<h4><b style="color:maroon;font-size: 16px;">Not available</b></h4>';
	}
}else if($utype == "recruiter"){
	$usershow = 'style="display:none;"';
	$jobpost = '<li class="right-border"><a href="javascript:void(0);" pd-popup-open="postjob"><i class="fa fa-edit"></i><span>Post job</span></a></li>';
	$subnav_extras1 = '<li><a href="javascript:void(0);" onclick="rjob(\''.$log_email.'\')"><i class="fa fa-briefcase"></i><span>My Jobs</span> </a><span id="quick_rjob_num"></span> </li>';
	$subnav_extras2 = '';
	$subnav_extras3 = '<li><a href="javascript:void(0);" onclick="settings(\''.$log_email.'\')"><i class="fa fa-gears"></i><span>Settings</span> </a> </li>';
	$sql = "SELECT * FROM company_profile WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$company_name = $row["company_name"];
		$business_stream_name = $row["business_stream_name"];
		$company_website_url  = $row["company_website_url"];
	}
}
?>