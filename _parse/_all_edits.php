<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "add_edu"){
	if(!isset($_POST['sch']) || $_POST['sch'] == ""){
		mysqli_close($db_connection);
		echo "add_failed";
		exit();
	}
	$sch =  $_POST['sch'];
	$major =  $_POST['major'];
	$degree =  $_POST['degree'];
	$cgpa =  $_POST['cgpa'];
	$fr =  $_POST['fr'];
	$to =  $_POST['to'];
	if($fr >= $to){
		echo "add_failed";
		exit();
	}else{
		$sql_edu = "SELECT id FROM education_detail WHERE e_hash='$log_email'";
		$query_edu = mysqli_query($db_connection, $sql_edu);
		$ps_edu_num = mysqli_num_rows($query_edu);
		if($ps_edu_num > 5){
			echo "add_failed";
			exit();
		}else{
			$sql = "INSERT INTO education_detail (e_hash, certificate_degree_name ,major , institute_university_name, starting_date, completion_date, cgpa, postdate) VALUES ('$log_email','$degree','$major','$sch','$fr','$to','$cgpa',now())";
			$query = mysqli_query($db_connection, $sql);
			$sql1 = "SELECT * FROM education_detail WHERE e_hash='$log_email' ORDER BY postdate DESC";
			$query = mysqli_query($db_connection, $sql1);
			$eduList = "";
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$eid = $row["id"];
				$degree = $row["certificate_degree_name"];
				$major = $row["major"];
				$sch = $row["institute_university_name"];
				$from = $row["starting_date"];
				$to = $row["completion_date"];
				$cgpa = $row["cgpa"];
				$eduDeleteButton = '';
				if(true){
					$eduDeleteButton = '<div style="float: right;padding: 5px;" id="edb_'.$eid.'"><button class="btn btn-primary btn-small" onmousedown="deleteEdu(\''.$eid.'\',\'edb_'.$eid.'\');" ><span class="fa fa-trash"></span></button></div>';
				}
				$eduList .= '<div id="edb_'.$eid.'" class="profile_widget">'.$eduDeleteButton.'<div class="profile_widget-image"><span class="fa fa-institution"></span></div>';
				$eduList .= '<div class="profile_widget-details"><h3>'.$sch.'</h3><h4 style="margin-top:5px;">'.$degree.', '.$major.' - '.$from.' to '.$to.'</h4>';
				$eduList .= '</div></div>';		
			}
			echo $eduList;
			exit();	
		}
	}
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "add_xp"){
	if(!isset($_POST['job_nm']) || $_POST['job_nm'] == ""){
		mysqli_close($db_connection);
		echo "xp_failed";
		exit();
	}
	$job_nm =  $_POST['job_nm'];
	$job_company =  $_POST['job_company'];
	$job_spec =  $_POST['job_spec'];
	$bb_stream =  $_POST['bb_stream'];
	$from_month =  $_POST['from_month'];
	$to_month =  $_POST['to_month'];
	$to_year =  $_POST['to_year'];
	$from_year =  $_POST['from_year'];
	$description =  $_POST['description'];
	$description = str_replace("&amp;","&",$description);
	$description = stripslashes($description);
	$description = htmlspecialchars($description);
	$description = mysqli_real_escape_string($db_connection, $description);
	if($from_year > $to_year){
		echo "xp_failed";
		exit();
	}else{
		$sql_xp = "SELECT id FROM experience_detail WHERE e_hash='$log_email'";$query_xp = mysqli_query($db_connection, $sql_xp);$ps_xp_num = mysqli_num_rows($query_xp);
		if($ps_xp_num > 5){
			echo "xp_failed";
			exit();
		}else{
			$from_xp_date = ''.$from_year.'-'.$from_month.'-01';
			$to_xp_date = ''.$to_year.'-'.$to_month.'-01';
			$diff = abs(strtotime($to_xp_date) - strtotime($from_xp_date));
			$date_year_diff = floor($diff / (365*60*60*24));
			$sql = "INSERT INTO experience_detail (e_hash ,job_title ,job_specialization , company_name, business_stream, start_date, date_date, date_year_diff, description, postdate) VALUES ('$log_email','$job_nm','$job_spec','$job_company','$bb_stream','$from_xp_date','$to_xp_date','$date_year_diff','$description',now())";
			$query = mysqli_query($db_connection, $sql);
			$sql2 = "SELECT * FROM experience_detail WHERE e_hash='$log_email' ORDER BY postdate DESC";
			$query = mysqli_query($db_connection, $sql2);
			$xpList = "";
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$xid = $row["id"];
				$is_current_job = $row["is_current_job"];
				$job_title  = $row["job_title"];
				$job_specialization  = $row["job_specialization"];
				$company_name = $row["company_name"];
				$business_stream = $row["business_stream"];
				$start_date = strftime("%b %Y", strtotime($row["start_date"]));
				$date_date = strftime("%b %Y", strtotime($row["date_date"]));
				$description = $row["description"];
				$xpDeleteButton = '';
				if(true){
					$xpDeleteButton = '<div style="float: right;padding: 5px;" id="xdb_'.$xid.'"><button class="btn btn-primary btn-small" onmousedown="deleteXp(\''.$xid.'\',\'xdb_'.$xid.'\');" ><span class="fa fa-trash"></span></button></div>';
				}
				$xpList .= '<div id="xdb_'.$xid.'" class="profile_widget">'.$xpDeleteButton.'<div class="profile_widget-image"><span class="fa fa-briefcase"></span></div>';
				$xpList .= '<div class="profile_widget-details"><h3>'.$job_title.'</h3><h4 style="margin-top:5px;">'.$company_name.' - '.$business_stream.' </h4>';
				$xpList .= '<h4 style="margin-top:5px;">Job specialization - '.$job_specialization.'</h4><h4 style="margin-top:5px;color: grey;">'.$description.' </h4>';
				$xpList .= '<h4 style="margin-top:5px;">'.$start_date.' - '.$date_date.'</h4></div></div>';					
			}
			echo $xpList;
			exit();
		}
	}
}
?><?php 
if (isset($_POST['skillset'])){
	if(!isset($_POST['skillset']) || $_POST['skillset'] == ""){
		mysqli_close($db_connection);
		echo "An unknown error occurred";
		exit();
	}
	$skillset = $_POST['skillset'];	
	mysqli_query($db_connection, "DELETE FROM seeker_skill_set WHERE e_hash='$log_email'");
	foreach($skillset as $key => $skill){
		$sql = "INSERT INTO seeker_skill_set (e_hash ,skill_set_name) VALUES ('$log_email','$skill')";
		$query = mysqli_query($db_connection, $sql);
	}
	$sql3 = "SELECT * FROM seeker_skill_set WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql3);
	$skillList = "";
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$sid = $row["id"];
		$skill_set_name = $row["skill_set_name"];

		$skillList .= '<div id="" class="profile_widget" style="margin: 0 .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1em;" class="fa fa-star"></span></div>';
		$skillList .= '<div class="profile_widget-details"><h5>'.$skill_set_name.'</h5></div></div>';
						
	}
	echo $skillList;
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_education"){
	if(!isset($_POST['eid']) || $_POST['eid'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$eid = preg_replace('#[^0-9]#', '', $_POST['eid']);
	mysqli_query($db_connection, "DELETE FROM education_detail WHERE id='$eid'");
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_experience"){
	if(!isset($_POST['xid']) || $_POST['xid'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$xid = preg_replace('#[^0-9]#', '', $_POST['xid']);
	mysqli_query($db_connection, "DELETE FROM experience_detail WHERE id='$xid'");
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_rjob"){
	if(!isset($_POST['rjbid']) || $_POST['rjbid'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$rjbid = preg_replace('#[^0-9]#', '', $_POST['rjbid']);
	mysqli_query($db_connection, "DELETE FROM job_post WHERE id='$rjbid'");
	mysqli_query($db_connection, "DELETE FROM job_post_activity WHERE job_post_id='$rjbid'");
	mysqli_query($db_connection, "DELETE FROM seeker_bookmarks WHERE job_id='$rjbid'");
	mysqli_query($db_connection, "DELETE FROM job_post_skill_set WHERE job_post_id='$rjbid'");
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_bookmark"){
	if(!isset($_POST['bid']) || $_POST['bid'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$bid = preg_replace('#[^0-9]#', '', $_POST['bid']);
	mysqli_query($db_connection, "DELETE FROM seeker_bookmarks WHERE id='$bid'");
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "add_req"){
	if(!isset($_POST['jid']) || $_POST['jid'] == ""){
		mysqli_close($db_connection);
		echo "req_failed";
		exit();
	}
	$jid =  $_POST['jid'];
	$degree =  $_POST['degree'];
	$skillset1 =  $_POST['skillset1'];
	$skillset2 =  $_POST['skillset2'];
	$skillset3 =  $_POST['skillset3'];
	$limit =  $_POST['limit'];
	if($skillset1 != "" && $skillset2 == "" && $skillset3 == ""){
		$all_skills = array($skillset1);
	}else if($skillset1 != "" && $skillset2 != "" && $skillset3 == ""){
		$all_skills = array($skillset1,$skillset2);
	}else if($skillset1 != "" && $skillset2 != "" && $skillset3 != ""){
		$all_skills = array($skillset1,$skillset2,$skillset3);
	}
	if($degree == "" || $skillset1 == ""){
		echo "req_failed";
		exit();
	}else{
		mysqli_query($db_connection, "DELETE FROM job_post_skill_set WHERE job_post_id='$jid'");
		foreach($all_skills as $key => $skill){
			$sql = "INSERT INTO job_post_skill_set (job_post_id ,skill_set_name) VALUES ('$jid','$skill')";
			$query = mysqli_query($db_connection, $sql);
		}
		$query1 = mysqli_query($db_connection, "UPDATE job_post SET qualification='$degree',shortlist_limit='$limit' WHERE id='$jid' LIMIT 1");
		echo $jid;
		exit();
	}
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "edit_jobpost"){
	if(!isset($_POST['jid']) || $_POST['jid'] == ""){
		mysqli_close($db_connection);
		echo "jobedit_failed";
		exit();
	}
	$jid =  $_POST['jid'];
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
	if($jobtitle == "" || $jobtype == "" || $deadline == ""){
		echo "jobedit_failed";
		exit();
	}
	$query0 = mysqli_query($db_connection, "UPDATE job_post SET job_type='$jobtype', created_date='$date_created', deadline_date='$dead_line', deadline_mhs='$deadline', job_title='$jobtitle', region='$region' WHERE id='$jid' LIMIT 1");
	if($jobdes != ""){
		$query1 = mysqli_query($db_connection, "UPDATE job_post SET job_description='$jobdes' WHERE id='$jid' LIMIT 1");
	}
	$rjoblist = "";
	$sql1 = "SELECT * FROM job_post WHERE company_id='$log_email' ORDER BY created_date DESC LIMIT 100";
	$query = mysqli_query($db_connection, $sql1);
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
			$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date updated:</span> '.$created_date.'</h4>';
			$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4>';
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
			$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Date updated:</span> '.$created_date.'</h4>';
			$rjoblist .= '<h4 style="margin-top:5px;"><span class="grey-out">Inactive after:</span> '.$deadline_mhs.'</h4>';
			$rjoblist .= '<h4 style="margin-top:5px;"><button class="btn btn-primary btn-small" onclick="OpenJobDetails(\''.$job_id.'\',\'rjb_'.$job_id.'\');">Preview</button> ';
			$rjoblist .= ''.$rjobDeleteButton.' </h4></div></div>';
		}
	}
	echo $rjoblist;
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "pass_update"){
	if(!isset($_POST['op']) || $_POST['op'] == "" || $_POST['np2'] == ""){
		mysqli_close($db_connection);
		echo "update_failed";
		exit();
	}
	$op = md5($_POST['op']);
	$_POST['np1'] = $np1 = $_POST['np1'];
	$_POST['np2'] = $np2 = $_POST['np2'];
	
	if($op == "" || $np1 == "" || $np2 == ""){
		echo "Please fill all password fields";
        exit();
	}else if (strlen($np2) < 6) {
        echo "Password is too short. Try 6 or more characters";
        exit(); 
    } else {
		$sql = "SELECT email, password FROM user_account WHERE e_hash='$log_email' LIMIT 1";
        $query = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_row($query);
		$db_email = $row[0];
		$db_pass_str = $row[1];
		if($op != $db_pass_str){
			echo "Your old password is incorrect";
            exit();
		} else {
			$np_hash = md5($np1);
			$sql = "UPDATE user_account SET password='$np_hash' WHERE e_hash='$log_email' LIMIT 1";
			$query = mysqli_query($db_connection, $sql);
			
			/* $to = "$db_email";							 
			$from = "bacsyd-noreply@bacsyd.com";
			$subject = 'Bacsyd Account Password Changed';
			$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
			$message .= '<span style="font-size:16px;">Hey there,<br /><br />Your password was changed.<br /><br />';
			$message .= 'If you did not make this change or an authorized person has accessed your account, you should re-change your password as soon as ';
			$message .= 'possible from your Bacsyd Account page at &nbsp;<a href="http://www.bacsyd.com/reset-pass">http://www.bacsyd.com/reset-pass</a>';
			$message .= '<br /><br /><br /><b>Bacsyd Security Team</b></span></body></html>';
			$headers = "From: bacsyd-noreply@bacsyd.com\r\n";
			$headers .= "Reply-To: bacsyd-noreply@bacsyd.com\r\n";
			$headers .= "Return-Path: bacsyd-noreply@bacsyd.com\r\n";
			$headers .= "CC: bacsyd-noreply@bacsyd.com\r\n";
			$headers .= "BCC: bacsyd-noreply@bacsyd.com\r\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			mail($to, $subject, $message, $headers);	 */	
			
			echo "security_success";
			exit();
		}
	}
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "num_update"){
	if(!isset($_POST['num']) || $_POST['num'] == ""){
		mysqli_close($db_connection);
		echo "update_failed";
		exit();
	}
	$num = preg_replace('#[^0-9]#i', '', $_POST['num']);		
	$sql = "UPDATE user_account SET contact_number='$num' WHERE e_hash='$log_email' LIMIT 1";
	$query = mysqli_query($db_connection, $sql);
	echo $num;
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "fln_update"){
	if(!isset($_POST['fname']) || $_POST['fname'] == ""){
		mysqli_close($db_connection);
		echo "update_failed";
		exit();
	}
	$fname = $_POST['fname'];		
	$lname = $_POST['lname'];		
	$sql = "UPDATE seeker_profile SET firstname='$fname',lastname='$lname' WHERE e_hash='$log_email' LIMIT 1";
	$query = mysqli_query($db_connection, $sql);
	echo $fname;
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "cn_update"){
	if(!isset($_POST['cname']) || $_POST['cname'] == ""){
		mysqli_close($db_connection);
		echo "update_failed";
		exit();
	}
	$cname = $_POST['cname'];		
	$urle = $_POST['url'];		
	$sql1 = "UPDATE company_profile SET company_name='$cname', company_website_url='$urle' WHERE e_hash='$log_email' LIMIT 1";
	$query = mysqli_query($db_connection, $sql1);
	echo $cname;
	exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "bio_update"){
	if(!isset($_POST['b']) || $_POST['b'] == ""){
		mysqli_close($db_connection);
		echo "update_failed";
		exit();
	}
	$b =  $_POST['b'];
	$sql = "UPDATE seeker_profile SET seeker_bio='$b' WHERE e_hash='$log_email' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
	echo $b;
	exit();
}
?><?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_note"){
	if(!isset($_POST['noteid']) || $_POST['noteid'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$noteid = preg_replace('#[^0-9]#', '', $_POST['noteid']);
	$query = mysqli_query($db_connection, "SELECT * FROM notifications WHERE id='$noteid'");
	mysqli_query($db_connection, "DELETE FROM notifications WHERE id='$noteid'");
	mysqli_close($db_connection);
	echo "delete_ok";
	exit();
}
?>