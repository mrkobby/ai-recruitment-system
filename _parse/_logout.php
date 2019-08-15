<?php 
include_once("../_sys/check_login_status.php");
if($user_ok == false){
    exit();
}
$sql = "UPDATE user_account SET is_active='N' WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql);
?><?php
session_start();
$_SESSION = array();
if(isset($_COOKIE["id"]) && isset($_COOKIE["e_hash"]) && isset($_COOKIE["pass"])) {
	setcookie("id", '', strtotime( '-5 days' ), '/');
    setcookie("e_hash", '', strtotime( '-5 days' ), '/');
	setcookie("pass", '', strtotime( '-5 days' ), '/');
}
session_destroy();
if(isset($_SESSION['user_hash'])){
	header("location: ../_msg.php?msg=Error:_Logout_Failed");
} else {
	header("location: ../login");
	exit();
} 
?>