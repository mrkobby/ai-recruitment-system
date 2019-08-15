<?php 
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php 
$s1=$_REQUEST["n"];
$select_query = "SELECT * FROM seeker_profile WHERE firstname LIKE '%".$s1."%' OR lastname LIKE '%".$s1."%' LIMIT 10";
$user_query = mysqli_query($db_connection, $select_query) or die (mysqli_error());
$s="";

while($row = mysqli_fetch_array($user_query)){
	$ehash = $row["e_hash"];
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
	$sql = "SELECT * FROM user_account WHERE e_hash='$ehash'";
	$_query = mysqli_query($db_connection, $sql);
	while ($row = mysqli_fetch_array($_query)) {
		$email = $row["email"];
		$picture = $row["user_image"];
	}
	$image = "<img class='img-circle' src='_USER/".$ehash."/".$picture."' alt=".$firstname."/>";
	if($picture == NULL){
		$image = "<img class='img-circle' src='_img/avatardefault.png' />";
	}
	
	$s=$s.'
	<a class="link-p-colr" href="javascript:void(0)" onclick="OpenSeekerProfile(\''.$ehash.'\');">
		<div class="live-outer">
			<div class="live-im">
                '.$image.'
            </div>
            <div class="live-user-det">
                <div class="live-user-name">
                    <p>'.$firstname.' '.$lastname.'</p>
                </div>
                <div class="live-user-email">
					<div class="live-user-email-text"><p>'.$email.'</p></div>
                </div>
            </div>
        </div>
	</a>
	'	;
}
echo $s;
?>
