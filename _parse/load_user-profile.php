<?php
include_once("../_sys/check_login_status.php");
/* if($user_ok != true || $log_email == "") {
	exit();
} */
?><?php
if (isset($_GET['userhash'])){
	$userhash = $_GET['userhash'];
} else {
	exit();
}
$userstring = "";$skillList = "";$xpList = "";
$sql = "SELECT * FROM user_account WHERE e_hash='$userhash'";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$uid = $row["id"];
	$ehash = $row["e_hash"];
	$user_type  = $row["user_type"];
	$email  = $row["email"];
	$contact_number  = $row["contact_number"];
	$user_image = $row["user_image"];
	$user_pic = '<img class="img-circle" src="_USER/'.$ehash.'/'.$user_image.'" alt="User">';
	if($user_image == NULL){
		$user_pic = '<img class="img-circle" src="_img/avatardefault.png" alt="user">';
	}
	if($contact_number == "" || $contact_number == NULL){
		$contact_number = "Phone number not set";
	}
	$sql3 = "SELECT * FROM seeker_skill_set WHERE e_hash='$ehash'";
	$query = mysqli_query($db_connection, $sql3);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$sid = $row["id"];
		$skill_set_name = $row["skill_set_name"];
		$skillList .= '<div id="" class="profile_widget" style="margin: 0 .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1em;" class="fa fa-star"></span></div>';
		$skillList .= '<div class="profile_widget-details"><h5>'.$skill_set_name.'</h5></div></div>';				
	}
	$sql2 = "SELECT * FROM experience_detail WHERE e_hash='$ehash' ORDER BY postdate DESC";
	$queryx = mysqli_query($db_connection, $sql2);
	$xp_numrows = mysqli_num_rows($queryx);
	if($xp_numrows < 1){
		$xpList = ' ';
	} else {
		while ($row = mysqli_fetch_array($queryx, MYSQLI_ASSOC)) {
			$xid = $row["id"];
			$is_current_job = $row["is_current_job"];
			$job_title  = $row["job_title"];
			$job_specialization  = $row["job_specialization"];
			$company_name = $row["company_name"];
			$business_stream = $row["business_stream"];
			$start_date = strftime("%b %Y", strtotime($row["start_date"]));
			$date_date = strftime("%b %Y", strtotime($row["date_date"]));
			$description = $row["description"];
			$end_date = "Today";if($is_current_job == '0'){$end_date = $date_date;}
			$xpList .= '<div id="xdb_'.$xid.'" class="profile_widget"><div class="profile_widget-image"><span class="fa fa-briefcase"></span></div>';
			$xpList .= '<div class="profile_widget-details"><h3>'.$job_title.'</h3><h4 style="margin-top:5px;">'.$company_name.' - '.$business_stream.' </h4>';
			$xpList .= '<h4 style="margin-top:5px;">Job specialization - '.$job_specialization.'</h4><h4 style="margin-top:5px;color: grey;">'.$description.' </h4>';
			$xpList .= '<h4 style="margin-top:5px;">'.$start_date.' - '.$end_date.'</h4></div></div>';			
		}	
	}	
	$sql1 = "SELECT * FROM education_detail WHERE e_hash='$ehash' ORDER BY postdate DESC";
	$query = mysqli_query($db_connection, $sql1);
	$eduList = "";
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$eid = $row["id"];
		$degree = $row["certificate_degree_name"];
		$major = $row["major"];
		$sch = $row["institute_university_name"];
		$from = $row["starting_date"];
		$to = $row["completion_date"];
		$cgpa = $row["cgpa"];
		$eduList .= '<div id="edb_'.$eid.'" class="profile_widget"><div class="profile_widget-image"><span class="fa fa-institution"></span></div>';
		$eduList .= '<div class="profile_widget-details"><h3>'.$sch.'</h3><h4 style="margin-top:5px;">'.$degree.', '.$major.' - '.$from.' to '.$to.'</h4>';
		$eduList .= '</div></div>';		
	}
	$sql0 = "SELECT * FROM seeker_profile WHERE e_hash='$ehash'";
	$query = mysqli_query($db_connection, $sql0);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];	
		$gender = $row["gender"];	
		$seeker_bio = $row["seeker_bio"];	
	}
}
$userstring .= "$user_pic|$skillList|$xpList|$eduList|$firstname|$lastname|$email|$seeker_bio|$contact_number|||";
$userstring = trim($userstring, "|||");
echo $userstring;
?>