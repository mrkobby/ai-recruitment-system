<?php
include_once("../_sys/check_login_status.php");

if (isset($_FILES["cvfile"]["name"]) && $_FILES["cvfile"]["tmp_name"] != ""){
	$fileName = $_FILES["cvfile"]["name"];
    $fileTmpLoc = $_FILES["cvfile"]["tmp_name"];
	$fileSize = $_FILES["cvfile"]["size"];
	$fileErrorMsg = $_FILES["cvfile"]["error"];
	$kaboom = explode(".", $fileName);
	$fileExt = end($kaboom);

	$db_file_name = "cv".rand(10000,99999).".".$fileExt;
	if($fileSize > 3048576) {
		echo "File size was larger than 3mb";
		exit();	
	} else if (!preg_match("/\.(doc|docx|pdf|txt)$/i", $fileName) ) {
		echo "Cv file was not doc, docx, pdf or txt type";
		exit();
	} else if ($fileErrorMsg == 1) {
		echo "An unknown error occurred";
		exit();
	}
	$sql = "SELECT cv FROM seeker_profile WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$row = mysqli_fetch_row($query);
	$cv = $row[0];
	if($cv != ""){
		$picurl = "../_USER/$log_email/$cv"; 
	    if (file_exists($picurl)) { unlink($picurl); }
	}
	$moveResult = move_uploaded_file($fileTmpLoc, "../_USER/$log_email/$db_file_name");
	if ($moveResult != true) {
		echo "File upload failed";
		exit();
	}
	$sql2 = "UPDATE seeker_profile SET cv='$db_file_name' WHERE e_hash='$log_email'";
	$query2 = mysqli_query($db_connection, $sql2);
	mysqli_close($db_connection);
	$returnfile = "";
	if($moveResult) {
		$targetDisplay = "_USER/$log_email/$db_file_name";
		$returnfile .= '<h4><b style="color:green;font-size: 16px;">Available</b></h4>';
		$returnfile .= '<a href="'.$targetDisplay.'">Click here to download attached file</a>';
	}
	echo $returnfile;
	exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "delete_cv"){
	$sql = "SELECT cv FROM seeker_profile WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$row = mysqli_fetch_row($query);
	$old_cv = $row[0];
	if($old_cv != ""){
		$picurl = "../_USER/$log_email/$old_cv"; 
		if (file_exists($picurl)) { unlink($picurl); }
	}
	$sql2 = "UPDATE seeker_profile SET cv=NULL WHERE e_hash='$log_email'";
	$query2 = mysqli_query($db_connection, $sql2);
	mysqli_close($db_connection);
	echo "remove_ok";
	exit();
}
?>