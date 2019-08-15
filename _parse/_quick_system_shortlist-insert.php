<?php
include_once("../_sys/check_login_status.php");
if($user_ok != true || $log_email == "") {
	exit();
}
?><?php
mysqli_query($db_connection, "UPDATE job_post SET is_active='1' WHERE deadline_date < NOW()");
$job_shortlist_note = "";$rej_note = "";$acpt_note = "";
$sql = "SELECT * FROM job_post WHERE is_active='1'";
$queryx = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($queryx, MYSQLI_ASSOC)) {
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
	
	$j_sql = "SELECT * FROM notifications WHERE job_post_id='$job_id'";
	$j_query = mysqli_query($db_connection, $j_sql);
	$numrows = mysqli_num_rows($j_query);
	if($numrows < 1){
		$sql1 = "SELECT * FROM job_post_activity WHERE job_post_id='$job_id'";
		$query1 = mysqli_query($db_connection, $sql1);
		$numrows1 = mysqli_num_rows($query1);
		while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$e_hash = $row["e_hash"];
			$job_post_id = $row["job_post_id"];
			$seeker_profile_strength = $row["seeker_profile_strength"];
			$skill_match = $row["skill_match"];
			$degree_match = $row["degree_match"];
			$seeker_result = $row["seeker_result"];	
			$rej_note = '<h4 style="margin-top: 5px;color: #e16b6b;"> This message is to inform you that the system has selected the best candidate for the job. You were not matched with this job.  We suggest you try applying for other jobs. We appreciate you taking the time to apply for employment with our company and wish you the best of luck in your future endeavors. </h4>';
			
			$sql0 = "INSERT INTO notifications (note_type , e_hash, initiator_hash, job_post_id, note, date_time) VALUES ('s','$e_hash','$company_id','$job_post_id','$rej_note',now())";
			$query0 = mysqli_query($db_connection, $sql0);
		}
		$sql2 = "SELECT e_hash,job_post_id FROM job_post_activity WHERE job_post_id='$job_id' ORDER BY seeker_result DESC LIMIT 1";
		$query2 = mysqli_query($db_connection, $sql2);
		$numrows2 = mysqli_num_rows($query2);
		while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
			$job_p_id = $row["job_post_id"];
			$accepted_user = $row["e_hash"];
			$acpt_note = '<h4 style="margin-top: 5px;color: #3d983e;">Congratulations! You have been shortlisted as the best candidate for this job. You will receive an email with more information, once the company approves this selection. Until then, keep your head up.</h4>';
			$query = mysqli_query($db_connection, "UPDATE notifications SET note='$acpt_note' WHERE e_hash='$accepted_user' AND job_post_id='$job_p_id' LIMIT 1");
			$sql3 = "INSERT INTO notifications (note_type , e_hash, initiator_hash, job_post_id, date_time) VALUES ('r','$company_id','$company_id','$job_p_id',now())";
			$query3 = mysqli_query($db_connection, $sql3);
		}
	}
}
echo $job_shortlist_note;
?>