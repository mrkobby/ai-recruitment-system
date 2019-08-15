<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
$rjob_label = '';
$sql01 = "SELECT last_checks_rjobs FROM company_profile WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql01);
$row = mysqli_fetch_row($query);
$last_checks_rjobs = $row[0];

$sql = "SELECT COUNT(id) FROM job_post WHERE created_date > '$last_checks_rjobs' AND company_id='$log_email'";
$query = mysqli_query($db_connection, $sql);
$query_count = mysqli_fetch_row($query);
$rjob_count = $query_count[0];
if($rjob_count > 0) {
	$rjob_label = '<span class="note__badge">'.$rjob_count.'</span>';
}
echo $rjob_label;
?>