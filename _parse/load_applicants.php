<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
if (isset($_GET['jid'])){
	$jid = preg_replace('#[^0-9]#', '', $_GET['jid']);
} else {
	exit();
}
?><?php
$view_applicants = "";$counter = 1;

$sql1 = "SELECT id FROM job_post_activity WHERE job_post_id='$jid'";
$query1 = mysqli_query($db_connection, $sql1);
$jobsCount = mysqli_num_rows($query1);

$sql_ = "SELECT shortlist_limit FROM job_post WHERE id='$jid'";
$query_ = mysqli_query($db_connection, $sql_);
$row_ = mysqli_fetch_row($query_);
$shortlist_limit = $row_[0];
$limit_num = ($shortlist_limit/100)*$jobsCount;

$sql0 = "SELECT * FROM job_post_activity WHERE job_post_id='$jid' ORDER BY seeker_result DESC LIMIT $limit_num";
$query0 = mysqli_query($db_connection, $sql0);
while ($row = mysqli_fetch_array($query0, MYSQLI_ASSOC)) {
	$job_post_id = $row["job_post_id"];
	$e_hash = $row["e_hash"];
	$seeker_profile_strength = $row["seeker_profile_strength"];

	$sql1 = "SELECT * FROM seeker_profile WHERE e_hash='$e_hash'";
	$query1 = mysqli_query($db_connection, $sql1);
	while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];
		$profile_strength = $row["profile_strength"];
		
		$view_applicants .= '<div id="" class="profile_widget" style="margin: 0 .9% 10px;"><div style="float: right;padding: 2px;">';
		$view_applicants .= '<span><span class="fa fa-user"></span> '.$profile_strength.'%</span> &nbsp; <button style="" class="btn btn-default btn-small" onclick="OpenEmailCandidate(\''.$job_post_id.'\',\''.$e_hash.'\');"><span class="fa fa-envelope"></span> Get in touch</button></div>';	
		$view_applicants .= '<div class="profile_widget-image"><span style="font-size: 1em;" class="fa fa-user"> '.$counter.'</span></div>';	
		$view_applicants .= '<div class="profile_widget-details"><h5><a href="javascript:void()" onclick="OpenSeekerProfile(\''.$e_hash.'\');"> '.$firstname.' '.$lastname.'</a></h5></div></div>';	
	}
$counter++;	
}
echo $view_applicants;
?>