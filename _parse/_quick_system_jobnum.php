<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
$job_label = '';
$sql01 = "SELECT last_checks_jobs FROM seeker_profile WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql01);
$row = mysqli_fetch_row($query);
$lastnotecheck = $row[0];

$sql = "SELECT COUNT(id) FROM job_post WHERE created_date > '$lastnotecheck'";
$query = mysqli_query($db_connection, $sql);
$query_count = mysqli_fetch_row($query);
$job_count = $query_count[0];
if($job_count > 0) {
	$job_label = '<span class="note__badge">'.$job_count.'</span>';
}
echo $job_label;
?>