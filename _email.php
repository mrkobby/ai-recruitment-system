<?php
include_once("_sys/db_connection.php");
$dets = "";
$sql = "SELECT * FROM user_account ORDER BY registration_date ASC";
$user_query = mysqli_query($db_connection, $sql);
$numrows = mysqli_num_rows($user_query);
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
	
	$dets .= ''.$profile_id.' &nbsp; | &nbsp; '.$ehash.' &nbsp; | &nbsp; '.$email.' &nbsp; | &nbsp; '.$utype.' &nbsp; 
	| &nbsp; '.$is_active.' &nbsp; | &nbsp; '.$contact.' &nbsp; | &nbsp; '.$reg_date.' <br />';
}
echo "<h1>Email Simulation</h1>";
echo $dets;

?>