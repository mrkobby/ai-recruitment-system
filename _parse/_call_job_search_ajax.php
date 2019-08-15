<?php 
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php 
$j1=$_REQUEST["n"];
$select_query = "SELECT * FROM job_post WHERE job_title LIKE '%".$j1."%' OR region LIKE '%".$j1."%' OR qualification LIKE '%".$j1."%' OR job_type LIKE '%".$j1."%' LIMIT 20";
$job_query = mysqli_query($db_connection, $select_query) or die (mysqli_error());
$rjoblist="";

while($row = mysqli_fetch_array($job_query)){
	$job_id = $row["id"];
	$job_type = $row["job_type"];
	$company_id = $row["company_id"];
	$created_date = strftime("%b %d, %Y at %I:%M %p", strtotime($row["created_date"]));
	$deadline_date = $row["deadline_date"];
	$deadline_mhs = $row["deadline_mhs"];
	$job_title = $row["job_title"];
	$job_description = $row["job_description"];
	$region = $row["region"];
	$qualification = $row["qualification"];
	$is_active = $row["is_active"];
	$edit_elapsed = $row["edit_elapsed"];
	
	$isSaved = false;
	$isApplied = false;
	if($user_ok == true){
		$bookmark_check = "SELECT id FROM seeker_bookmarks WHERE e_hash='$log_email' AND job_id='$job_id'";
		if(mysqli_num_rows(mysqli_query($db_connection, $bookmark_check)) > 0){
			$isSaved = true;
		}
		$apply_check = "SELECT id FROM job_post_activity WHERE e_hash='$log_email' AND job_post_id='$job_id'";
		if(mysqli_num_rows(mysqli_query($db_connection, $apply_check)) > 0){
			$isApplied = true;
		}
	}
	
	$mysql = "SELECT * FROM company_profile WHERE e_hash='$company_id'";
	$_query = mysqli_query($db_connection, $mysql);
	while ($row = mysqli_fetch_array($_query, MYSQLI_ASSOC)) {
		$company_account_id = $row["company_account_id"];
		$comp_id = $row["e_hash"];
		$company_name = $row["company_name"];
		
		$sql3 = "SELECT user_image FROM user_account WHERE e_hash='$comp_id'";
		$query1 = mysqli_query($db_connection, $sql3);
		while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$company_image = $row["user_image"];
			$company_pic = '<img src="_USER/'.$comp_id.'/'.$company_image.'" alt="User">';
			if($company_image == NULL){
					$company_pic = '<img src="_img/avatardefault.png" alt="user">';
			}
			$save_button = '<button class="btn btn-primary btn-small" id="sBtn_'.$job_id.'" onclick="saveToggle(\'save\',\''.$log_email.'\',\'saveBtn_'.$job_id.'\',\''.$job_id.'\')">Save to bookmarks</button>';
			$apply_button = '<button class="btn btn-info btn-small" id="applyBtn_" onclick="applyToggle(\'apply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Apply for this job</button>';
			if($isSaved == true){
				$save_button = '<button class="btn btn-small" id="sBtn_'.$job_id.'" onclick="saveToggle(\'unsave\',\''.$log_email.'\',\'saveBtn_'.$job_id.'\',\''.$job_id.'\')">Saved <span class="fa fa-check-circle"></span></button>';
			} else{
				$save_button = '<button class="btn btn-default btn-small" id="sBtn_'.$job_id.'" onclick="saveToggle(\'save\',\''.$log_email.'\',\'saveBtn_'.$job_id.'\',\''.$job_id.'\')">Save to bookmarks</button>';
			}if($isApplied == true){
				$apply_button = '<button class="btn btn-warning btn-small" id="applyBtn_" onclick="applyToggle(\'unapply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Cancel application</button>';
			} else{
				$apply_button = '<button class="btn btn-info btn-small" id="applyBtn_" onclick="applyToggle(\'apply\',\''.$log_email.'\',\'applyBtn_'.$job_id.'\',\''.$job_id.'\')">Apply for this job</button>';
			}
			
			if($is_active == 0){
				$rjoblist .= '<div id="jb_'.$job_id.'" class="job jb_'.$job_id.'"><div class="job-user-image hand" onclick="recruiter(\''.$comp_id.'\')" style="vertical-align: inherit;">'.$company_pic.'</div>';
				$rjoblist .= '<div class="job-details"><h3><a href="javascript:void(0)" onclick="recruiter(\''.$comp_id.'\')"><h3>'.$company_name.'</h3></a></h3>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job title:</span> '.$job_title.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Posted on:</span> '.$created_date.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'jb_'.$job_id.'\');">Preview</button> ';
				$rjoblist .= '<span id="saveBtn_'.$job_id.'" class="saveBtn_'.$job_id.'">'.$save_button.'</span> ';	
				$rjoblist .= '<span id="applyBtn_'.$job_id.'" class="applyBtn_'.$job_id.'">'.$apply_button.'</span></h4></div></div>';	
			}else{
				$rjoblist .= '<div id="jb_'.$job_id.'" class="job jb_'.$job_id.'" style="background-color: #fee3e3;"><div class="job-user-image hand" onclick="recruiter(\''.$comp_id.'\')" style="vertical-align: inherit;">'.$company_pic.'</div>';
				$rjoblist .= '<div class="job-details"><h3><a href="javascript:void(0)" onclick="recruiter(\''.$comp_id.'\')"><h3>'.$company_name.'</h3></a></h3>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job title:</span> '.$job_title.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Posted on:</span> '.$created_date.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4> ';
				$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'jb_'.$job_id.'\');">Preview</button> ';
				$rjoblist .= '';	
				$rjoblist .= '</h4></div></div>';	
			}
		}
	}
}
echo $rjoblist;
?>
