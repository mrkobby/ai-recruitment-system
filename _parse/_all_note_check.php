<?php
$notification_list = "";$notification_hint = "";$noteDeleteButton = "";
$sql = "SELECT * FROM notifications WHERE e_hash LIKE BINARY '$log_email' ORDER BY date_time DESC";
$query = mysqli_query($db_connection, $sql);
$notes_numrows = mysqli_num_rows($query);
if($notes_numrows < 1){
	$notification_hint = 'You do not have any notifications now';
} else {
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$noteid = $row["id"];
		$note_type = $row["note_type"];
		$e_hash = $row["e_hash"];
		$initiator_hash = $row["initiator_hash"];
		$job_post_id = $row["job_post_id"];
		$note = $row["note"];
		$did_read = $row["did_read"];
		$_time = strftime("%b %d at %I:%M %p", strtotime($row["date_time"]));
		
		if($e == $log_email){
			$noteDeleteButton = '<span id="dt_'.$noteid.'"><div style="float: right;padding: 5px;"><button class="btn btn-primary btn-small" onmousedown="deleteNote(\''.$noteid.'\',\'delete_'.$noteid.'\');"><span class="fa fa-close"></span></button></div></span>';
		}
		$sql1 = "SELECT * FROM job_post_activity WHERE job_post_id='$job_post_id'";
		$query1 = mysqli_query($db_connection, $sql1);
		$total_num_of_applys = mysqli_num_rows($query1);
		while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$seeker_result = $row["seeker_result"];
		}

		$sql_ = "SELECT shortlist_limit FROM job_post WHERE id='$job_post_id'";
		$query_ = mysqli_query($db_connection, $sql_);
		$row_ = mysqli_fetch_row($query_);
		$shortlist_limit = $row_[0];
		$limit_num = ($shortlist_limit/100)*$total_num_of_applys;
		
		if($note_type == "a"){
			$notification_list .= '<div id="delete_'.$noteid.'" class="profile_widget" style="margin: 5px .9% 10px;"><div class="profile_widget-image" style="vertical-align: top;"><img src="_img/owlphin_gif.gif" style="width: 50px;height: auto;" alt="Owlphin"></div>';
			$notification_list .= '<div class="profile_widget-details"><h4><span class="grey-out" style="color: #606060;font-size: 12px;">'.$note.'';
			$notification_list .= '<br /><br /><span class="fa fa-lightbulb-o"></span> Tip';
			$notification_list .= '<br /> If you encounter any problems, or need help with our system, please contact our Support Team.<br /> Tel: <a href="tel://+233549112267">0549112267</a> ';
			$notification_list .= '<br /> Emial: <a href="mailto:mtckobby@gmail.com">bacsyd-noreply@bacsyd.com</a></h4></div></div>';
		}else if($note_type == "r"){
			$notification_list .= '<div id="delete_'.$noteid.'" class="profile_widget" style="margin: 5px .9% 10px;">'.$noteDeleteButton.'';
			$notification_list .= '<div class="profile_widget-image" style="vertical-align: top;"><span style="font-size: 4em;color: #a2a2a2;" class="fa fa-briefcase"></div>';
			$notification_list .= '<div class="profile_widget-details"><h4><span class="grey-out">Job ID:</span> <a href="javascript:void()" style="font-weight:bold;" onclick="OpenJobDetails(\''.$job_post_id.'\',\'delete_'.$noteid.'\');"> mtc_01'.$job_post_id.'_fbr</a></h4>';
			$notification_list .= '<h4 style="margin-top: 5px;"><span class="grey-out">Number of candidates shortlisted:</span> '.$limit_num.' / '.$total_num_of_applys.'</h4>';
			$notification_list .= '<h4 style="margin-top: 5px;"> <button class="btn btn-small" onclick="OpenApplicants(\''.$job_post_id.'\');"><span class="fa fa-file"></span> View results</button></h4>';
			$notification_list .= '</div></div>';
		}else if($note_type == "s"){
			$notification_list .= '<div id="delete_'.$noteid.'" class="profile_widget" style="margin: 5px .9% 10px;">'.$noteDeleteButton.'';
			$notification_list .= '<div class="profile_widget-image" style="vertical-align: top;"><span style="font-size: 4em;color: #a2a2a2;" class="fa fa-briefcase"></div>';
			$notification_list .= '<div class="profile_widget-details"><h4><span class="grey-out">Job ID:</span> <a href="javascript:void()" style="font-weight:bold;" onclick="OpenJobDetails(\''.$job_post_id.'\',\'delete_'.$noteid.'\');"> mtc_01'.$job_post_id.'_fbr</a></h4>';
			$notification_list .= '<h4 style="margin-top: 5px;"><span class="grey-out">Number of applicants:</span> '.$total_num_of_applys.'</h4>';
			$notification_list .= '<h4 style="margin-top: 5px;"><span class="grey-out">Best candidates shortlisted:</span> 1</h4>';
			$notification_list .= ''.$note.'</div></div>';
		}
	}
}
?><?php
$note_label = '';
$sql01 = "SELECT last_notes_check FROM user_account WHERE e_hash='$log_email'";
$query = mysqli_query($db_connection, $sql01);
$row = mysqli_fetch_row($query);
$lastnotecheck = $row[0];

$sql = "SELECT COUNT(id) FROM notifications WHERE e_hash LIKE BINARY '$log_email' AND date_time > '$lastnotecheck'";
$query = mysqli_query($db_connection, $sql);
$query_count = mysqli_fetch_row($query);
$note_count = $query_count[0];
if($note_count > 0) {
	$note_label = '<span class="note__badge">'.$note_count.'</span>';
}
?>
<script type="text/javascript">
function deleteNote(noteid,notebox){
	Confirm.render("Are you sure you want to delete this notification?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText != "delete_ok"){
					Alert.render(ajax.responseText);
				}else{
					_("delete_"+noteid).style.display = 'none';
				}
			}
		}
		ajax.send("action=delete_note&noteid="+noteid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>