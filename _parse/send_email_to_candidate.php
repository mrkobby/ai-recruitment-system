<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
if(isset($_POST['jobid']) && isset($_POST['userhash'])){
	$jobid =  $_POST['jobid'];
	$userhash = $_POST['userhash'];
	$emailtext = $_POST['emailtext'];
	$emailtext = str_replace("&amp;","&",$emailtext);
	$emailtext = stripslashes($emailtext);
	$emailtext = htmlspecialchars($emailtext);
	$emailtext = mysqli_real_escape_string($db_connection, $emailtext);
	$email_text = html_entity_decode($emailtext);
	
	$mysql = "SELECT email FROM user_account WHERE e_hash='$userhash' LIMIT 1";
	$_query = mysqli_query($db_connection, $mysql);
	while ($row = mysqli_fetch_array($_query, MYSQLI_ASSOC)) {
		$email = $row["email"];
	}
	$to = "$email";							 
	$from = "bacsyd-noreply@bacsyd.com";
	$subject = 'Bacsyd Candidate Acceptance Letter';
	$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
	$message .= '<p style="padding:10px;background-color: rgb(217, 226, 245);">'.$email_text.'</p>';
	$message .= '</body></html>';
	$headers = "From: bacsyd-noreply@bacsyd.com\r\n";
	$headers .= "Reply-To: bacsyd-noreply@bacsyd.com\r\n";
	$headers .= "Return-Path: bacsyd-noreply@bacsyd.com\r\n";
	$headers .= "CC: bacsyd-noreply@bacsyd.com\r\n";
	$headers .= "BCC: bacsyd-noreply@bacsyd.com\r\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	mail($to, $subject, $message, $headers);	
	
	echo "email_sent";	
}
?>