<?php
if (isset($_GET['id']) && isset($_GET['e']) && isset($_GET['e_hash']) && isset($_GET['p'])) {
    include_once("_sys/db_connection.php");
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$e_hash = $_GET['e_hash'];
	$e = mysqli_real_escape_string($db_connection, $_GET['e']);
	$p = mysqli_real_escape_string($db_connection, $_GET['p']);
	if($id == "" || strlen($e) < 5 || strlen($p) == ""){
		header("location: _msg.php?msg=activation_string_length_issues");
    	exit(); 
	}
	$sql = "SELECT * FROM user_account WHERE id='$id' AND e_hash='$e_hash' AND email='$e' AND password='$p' LIMIT 1";
    $query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows == 0){
		header("location: _msg.php?msg=Your credentials are not matching anything in our system");
    	exit();
	}
	$sql = "UPDATE user_account SET activated='1' WHERE id='$id' LIMIT 1";
    $query = mysqli_query($db_connection, $sql);
	
	$checksql = "SELECT * FROM user_account WHERE id='$id' AND activated='1' LIMIT 1";
    $checkquery = mysqli_query($db_connection, $checksql);
	$numrows = mysqli_num_rows($checkquery);
    if($numrows == 0){
		header("location: _msg.php?msg=activation_failure");
    	exit();
    } else if($numrows == 1) {
		header("location: _msg.php?msg=Account activation was successful!");
    	exit();
    }
} else {
	header("location: _msg.php?msg=missing_GET_variables");
    exit(); 
}
?>