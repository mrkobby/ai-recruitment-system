<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
if (isset($_GET['jid'])){
	$jid = preg_replace('#[^0-9]#', '', $_GET['jid']);
} else {
	exit();
}
?><?php
$rjoblist = "";$show_qualification = "";$show_skills = '<div style="padding:0px 10px 5px 30px;">Not specified</div></div>';$array_1 = array();
$sql = "SELECT * FROM job_post WHERE id='$jid'";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$job_id = $row["id"];
	$job_type = $row["job_type"];
	$company_id = $row["company_id"];
	$created_date = strftime("%b, %d %Y", strtotime($row["created_date"]));
	$deadline_date = strftime("%b, %d %Y at %I:%M %p", strtotime($row["deadline_date"]));
	$job_title = $row["job_title"];
	$job_description = $row["job_description"];
	$job_description = html_entity_decode($job_description);
	$region = $row["region"];
	$qualification = $row["qualification"];
	$is_active = $row["is_active"];
	
	if($qualification == ""){
		$show_qualification = "";
	}else{
		$show_qualification = '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Minimum qualification -</span> '.$qualification.'</h3></div></div>';
	}
	$sql2 = "SELECT * FROM job_post_skill_set WHERE job_post_id='$job_id'";
	$query2 = mysqli_query($db_connection, $sql2);
	$numrows = mysqli_num_rows($query2);
	while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
		array_push($array_1, $row["skill_set_name"]);
		$orLogic = '';
		foreach($array_1 as $key => $skill){
				$orLogic .= "$skill, ";
		}
		$show_skills =  '<div style="padding:0px 10px 5px 30px;">'.$orLogic.'</div></div>';
	}
	
	
	$sql0 = "SELECT * FROM company_profile WHERE e_hash='$company_id'";
	$query0 = mysqli_query($db_connection, $sql0);
	while ($row = mysqli_fetch_array($query0, MYSQLI_ASSOC)) {
		$company_name = $row["company_name"];
		$comp_id = $row["e_hash"];
		$business_stream_name = $row["business_stream_name"];
		$company_website_url = $row["company_website_url"];
		
		$sql3 = "SELECT user_image FROM user_account WHERE e_hash='$comp_id'";
		$query1 = mysqli_query($db_connection, $sql3);
		while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$company_image = $row["user_image"];
			$company_pic = '<img style="width: 56px;" src="_USER/'.$comp_id.'/'.$company_image.'" alt="User">';
			if($company_image == NULL){
					$company_pic = '<img style="width: 56px;" src="_img/avatardefault.png" alt="user">';
			}
			$rjoblist .= '<div id="jbd_'.$job_id.'"><div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image">'.$company_pic.'</div><div class="profile_widget-details"><h4>'.$company_name.'</h3><h4 class="grey-out" style="margin-top: 5px;">'.$business_stream_name.'</h4>';
			$rjoblist .= '<h4 style="margin-top: 5px;"><a href="http://'.$company_website_url.'" target="blank">'.$company_website_url.'</a></h4>';
			$rjoblist .= '<h4 style="font-size: 12px;margin-top: 5px;color: #0d6868;">Job ID: mtc_01'.$job_id.'_fbr</h4></div></div>';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Job title -</span> '.$job_title.'</h3></div></div>';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Job type -</span> '.$job_type.'</h3></div></div>';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Job location -</span> '.$region.' region</h3></div></div>';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Application deadline -</span> <b style="font-weight: bold;">'.$deadline_date.'</b></h3></div></div>';
			$rjoblist .= ''.$show_qualification.'';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Required skills</span> </h3></div>';
			$rjoblist .= ''.$show_skills.'';
			$rjoblist .= '<div id="" class="profile_widget" style="margin: 5px .9% 5px;overflow-y: scroll;max-height: 95px"><div class="profile_widget-image"><span style="font-size: 1.5em;" class="fa fa-check"></span></div><div class="profile_widget-details"><h3 style="font-size: 14px;"><span class="grey-out">Job description</span> </h3></div>';
			$rjoblist .= '<div style="padding:0px 10px 5px 30px;">'.$job_description.'</div></div></div>';	
		}
	}				  
}
echo $rjoblist;
?>
