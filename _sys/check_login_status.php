<?php
session_start();
include_once("db_connection.php");
$user_ok = false;
$log_id = "";
$log_email = "";
$log_password = "";

function evalLoggedUser($db_connection,$id,$e,$p){
	$sql = "SELECT * FROM user_account WHERE id='$id' AND e_hash='$e' AND password='$p'";
    $query = mysqli_query($db_connection, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
		return true;
	}
}

if(isset($_SESSION["userid"]) && isset($_SESSION["user_hash"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
	$log_email = $_SESSION['user_hash'];
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	
	$user_ok = evalLoggedUser($db_connection,$log_id,$log_email,$log_password);
	
} else if(isset($_COOKIE["id"]) && isset($_COOKIE["e_hash"]) && isset($_COOKIE["pass"])){
	$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['user_hash'] = $_COOKIE['e_hash'];
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
	$log_id = $_SESSION['userid'];
	$log_email = $_SESSION['user_hash'];
	$log_password = $_SESSION['password'];
	
	$user_ok = evalLoggedUser($db_connection,$log_id,$log_email,$log_password);
	if($user_ok == true){
		$sql_log = "UPDATE user_account SET last_login_date=now(), is_active='Y' WHERE id='$log_id'";
        $query = mysqli_query($db_connection, $sql_log);
	}
}
?>