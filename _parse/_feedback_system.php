<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
if (isset($_GET['type']) && isset($_GET['person'])){
	$person = $_GET['person'];
	$xp = $_GET['type'];
	$sql = "SELECT COUNT(id) FROM user_account WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($db_connection);
		echo "User does not exist.";
		exit();
	}
	$feedback = mysqli_query($db_connection, "SELECT id FROM feedback WHERE e_hash ='$person'");
	$numrows = mysqli_num_rows($feedback);
	if($numrows > 0){
        $query = mysqli_query($db_connection, "UPDATE feedback SET xp='$xp' WHERE e_hash='$person' LIMIT 1");
		mysqli_close($db_connection);
		echo $xp;
	    exit();
	} else{
		$sql1 = "INSERT INTO feedback(e_hash, xp) VALUES('$person','$xp')";
		$query = mysqli_query($db_connection, $sql1);
		mysqli_close($db_connection);
		echo $xp;
		exit();
	}
}
?>