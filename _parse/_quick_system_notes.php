<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
$note_label = '';
$sql01 = "SELECT last_notes_check FROM user_account WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql01);
$row = mysqli_fetch_row($query);
$lastnotecheck = $row[0];

$sql = "SELECT COUNT(id) FROM notifications WHERE e_hash LIKE BINARY '$log_email' AND date_time > '$lastnotecheck'";
$query = mysqli_query($db_connection, $sql);
$query_count = mysqli_fetch_row($query);
$note_count = $query_count[0];
if($note_count > 0) {
	$note_label = '<span class="note__badge">'.$note_count.'</span>';
}
echo $note_label;
?>