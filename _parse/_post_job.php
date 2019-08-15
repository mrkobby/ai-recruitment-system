<?php
include_once("../_sys/check_login_status.php");
if($user_ok == false){
    exit();
}
?><?php
if(isset($_POST["jobtitle"]) && isset($_POST["jobtype"]) ){	
	$jobtitle = $_POST['jobtitle'];
	$jobtype = $_POST['jobtype'];
	$jobdes = nl2br($_POST['jobdes']);
	$jobdes = str_replace("&amp;","&",$jobdes);
	$jobdes = stripslashes($jobdes);
	$jobdes = htmlspecialchars($jobdes);
	$jobdes = mysqli_real_escape_string($db_connection, $jobdes);
	$region = $_POST['region'];
	$date_created = date("Y-m-d H:i:s", strtotime("now") - 60 * 60 * 2);
	$deadline = $_POST['deadline'];
	$dead_line = date("Y-m-d H:i:s", strtotime("+ $deadline") - 60 * 60 * 2);
	$userstring = "";
	if($jobtitle == "" || $jobtype == "" || $jobdes == "" || $deadline == ""){
		echo 'jobpost_failed';
        exit();
	}else {
		$sql = "INSERT INTO job_post (company_id, job_type ,created_date, deadline_date, deadline_mhs, job_title, job_description, region)       
		        VALUES('$log_email','$jobtype','$date_created','$dead_line','$deadline','$jobtitle','$jobdes','$region')";
		$query = mysqli_query($db_connection, $sql); 
		$postid = mysqli_insert_id($db_connection);
		$query_ = mysqli_query($db_connection, "UPDATE job_post SET shortlist_limit='100' WHERE id='$postid' LIMIT 1");
		$rjoblist = "";
		$sql = "SELECT * FROM job_post WHERE company_id='$log_email' ORDER BY created_date DESC LIMIT 100";
		$query = mysqli_query($db_connection, $sql);
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
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
			$shortlist_limit = $row["shortlist_limit"];
			$edit_elapsed = $row["edit_elapsed"];
			$rjobDeleteButton = '';
			if($company_id == $log_email){
				$rjobDeleteButton = '<span id="rjb_'.$job_id.'"><button class="btn btn-primary btn-small" onmousedown="deleteRJob(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Delete</button> </span>';
			}
			$sql1 = "SELECT id FROM job_post_activity WHERE job_post_id='$job_id'";
			$query1 = mysqli_query($db_connection, $sql1);
			$num_of_apply = mysqli_num_rows($query1);

			if($edit_elapsed == 0){
				$editjob = '<button class="btn btn-small" onclick="EditJobPost(\''.$job_id.'\');">Edit</button>';
				$addreq = '<button class="btn btn-small" onclick="AddRequirements(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Add requirements</button>';
			}else{
				$editjob = '<button class="btn btn-small disabled" disabled>Edit</button>';
				$addreq = '<button class="btn btn-small disabled" disabled>Add requirements</button>';
			}
					
			if($is_active == 0){
				$rjoblist .= '<div id="rjb_'.$job_id.'" class="rjob" style="*background: #dafed0;">';
				$rjoblist .= '<div style="float:right;padding:8px;"><span style="font-size:1em;color: #7c7d7d;" class="fa fa-group"> '.$num_of_apply.'</span></div>';
				$rjoblist .= '<div class="rjob-user-image"><span class="fa fa-institution"></span></div>';
				$rjoblist .= '<div class="rjob-details"><h3>Title : '.$job_title.'</h3><h4 style="margin-top:5px;"><span class="grey-out">Job location:</span> '.$region.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date created:</span> '.$created_date.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Number of applicants:</span> '.$num_of_apply.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Shortlist limit:</span> '.$shortlist_limit.'%</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Preview</button> ';
				$rjoblist .= ''.$editjob.' ';
				$rjoblist .= ''.$addreq.' ';
				$rjoblist .= ''.$rjobDeleteButton.' </h4></div></div>';
			}else{
				$rjoblist .= '<div id="rjb_'.$job_id.'" class="rjob" style="background-color: #fee3e3;">';
				$rjoblist .= '<div style="float:right;padding:8px;"><span style="font-size:1em;color: #7c7d7d;" class="fa fa-group"> '.$num_of_apply.'</span></div>';
				$rjoblist .= '<div class="rjob-user-image"><span class="fa fa-institution"></span></div>';
				$rjoblist .= '<div class="rjob-details"><h3>Title : '.$job_title.'</h3><h4 style="margin-top:5px;"><span class="grey-out">Job location:</span> '.$region.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Job type:</span> '.$job_type.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date created:</span> '.$created_date.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Status:</span> Job Ad has elapsed</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Number of applicants:</span> '.$num_of_apply.'</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Shortlist limit:</span> '.$shortlist_limit.'%</h4>';
				$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Preview</button> ';
				$rjoblist .= ''.$rjobDeleteButton.' </h4></div></div>';
			}
		}
		$userstring .= "$rjoblist|$postid|rjb_$postid|||";
		$userstring = trim($userstring, "|||");
		echo $userstring;
		exit();
	}
}
?>