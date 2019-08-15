<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
$bk_label = '';
$sql01 = "SELECT last_check_bookmarks FROM seeker_profile WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql01);
$row = mysqli_fetch_row($query);
$lastnotecheck = $row[0];

$sql = "SELECT COUNT(id) FROM seeker_bookmarks WHERE datesaved > '$lastnotecheck'";
$query = mysqli_query($db_connection, $sql);
$query_count = mysqli_fetch_row($query);
$bk_count = $query_count[0];
if($bk_count > 0) {
	$bk_label = '<span class="note__badge">'.$bk_count.'</span>';
}
echo $bk_label;
?>