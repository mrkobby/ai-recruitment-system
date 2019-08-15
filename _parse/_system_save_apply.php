<?php
include_once("../_sys/check_login_status.php");
if($user_ok == false){
    exit();
}
?><?php
if (isset($_POST['type1']) && isset($_POST['user1'])){
	$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user1']);
	$jid = preg_replace('#[^0-9]#i', '', $_POST['jid1']);
	$sql = "SELECT COUNT(id) FROM user_account WHERE e_hash='$user'";
	$query = mysqli_query($db_connection, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($db_connection);
		echo "$user does not exist.";
		exit();
	}
	$sql = "SELECT id FROM seeker_bookmarks WHERE e_hash='$user' AND job_id='$jid'";
	$query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($query);
	if($_POST['type1'] == "save"){
	    if ($numrows > 0) {
			mysqli_close($db_connection);
	        echo "You've already saved this job.";
	        exit();
	    }else {		
			$sql = "INSERT INTO seeker_bookmarks(e_hash, job_id, datesaved ) VALUES('$user','$jid',now())";
			$query = mysqli_query($db_connection, $sql);
			mysqli_close($db_connection);
	        echo "save_ok";
	        exit();
		}
	} else if($_POST['type1'] == "unsave"){
	    if ($numrows == 0) {
		    mysqli_close($db_connection);
	        echo "You can't unsave this job.";
	        exit();
	    } else {
			$sql = "DELETE FROM seeker_bookmarks WHERE e_hash='$user' AND job_id='$jid'";
			$query = mysqli_query($db_connection, $sql);
			mysqli_close($db_connection);
	        echo "unsave_ok";
	        exit();
		}
	}
}
?><?php
if (isset($_POST['type2']) && isset($_POST['user2'])){
	$user = $_POST['user2'];
	$jid = preg_replace('#[^0-9]#i', '', $_POST['jid2']);
	$sql = "SELECT COUNT(id) FROM user_account WHERE e_hash='$user'";
	$query = mysqli_query($db_connection, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($db_connection);
		echo "$user does not exist.";
		exit();
	}
	$sql = "SELECT id FROM job_post_activity WHERE e_hash='$user' AND job_post_id='$jid'";
	$query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($query);
	if($_POST['type2'] == "apply"){
	    if ($numrows > 0) {
			mysqli_close($db_connection);
	        echo "You've already applied for this job.";
	        exit();
	    }else {		
			$sql0 = "SELECT profile_strength FROM seeker_profile WHERE e_hash='$user' LIMIT 1";
			$query0 = mysqli_query($db_connection, $sql0);
			while ($row = mysqli_fetch_array($query0, MYSQLI_ASSOC)) {
				$profile_strength = $row["profile_strength"];
			}
			//----------------01------------------//
			$array_1 = array();$array_2 = array();
			$sql1 = "SELECT skill_set_name FROM job_post_skill_set WHERE job_post_id='$jid'";
			$query1 = mysqli_query($db_connection, $sql1);
			while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
				array_push($array_1, $row["skill_set_name"]);
			}
			$sql2 = "SELECT skill_set_name FROM seeker_skill_set WHERE e_hash='$user'";
			$query2 = mysqli_query($db_connection, $sql2);
			while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
				array_push($array_2, $row["skill_set_name"]);
			}
			$matches_2 = array_intersect($array_1,$array_2);
			$a2 = round(count($matches_2));$b2 = count($array_1);
			if($b2 != 0){
				$skill_similarity = $a2/$b2*60;
			}else{
				$skill_similarity = $a2/1*60;
			}
			//-------------------02--------------------//
			$array_3 = array();$array_4 = array();
			$sql3 = "SELECT certificate_degree_name FROM education_detail WHERE e_hash='$user'";
			$query3 = mysqli_query($db_connection, $sql3);
			while ($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
				array_push($array_3, $row["certificate_degree_name"]);
			}
			$sql4 = "SELECT qualification FROM job_post WHERE id='$jid'";
			$query4 = mysqli_query($db_connection, $sql4);
			while ($row = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
				array_push($array_4, $row["qualification"]);
			}
			$matches_3 = array_intersect($array_3,$array_4);
			$degree_similarity = round(count($matches_3));
			if($degree_similarity != 0){
				$degree_result = 20;
			}else{
				$degree_result = 0;
			}
			//-------------------03--------------------//
			$array_5 = array();$array_6 = array();$array_7 = array();
			$sql5 = "SELECT company_id FROM job_post WHERE id='$jid'";
			$query5 = mysqli_query($db_connection, $sql5);
			while ($row = mysqli_fetch_array($query5, MYSQLI_ASSOC)) {
				$company_id = $row["company_id"];
				$sql6 = "SELECT business_stream_name FROM company_profile WHERE e_hash='$company_id'";
				$query6 = mysqli_query($db_connection, $sql6);
				while ($row2 = mysqli_fetch_array($query6, MYSQLI_ASSOC)) {
					array_push($array_5, $row2["business_stream_name"]);
				}
			}
			$sql7 = "SELECT business_stream FROM experience_detail WHERE e_hash='$user'";
			$query7 = mysqli_query($db_connection, $sql7);
			while ($row = mysqli_fetch_array($query7, MYSQLI_ASSOC)) {
				array_push($array_6, $row["business_stream"]);
			}
			$matches_4 = array_intersect($array_5,$array_6);
			$xp_similarity = round(count($matches_4));
			foreach($matches_4 as $row){
				  $matched_xp = $row;
			}
			if($xp_similarity != 0){
				$sql8 = "SELECT date_year_diff FROM experience_detail WHERE business_stream='$matched_xp' AND e_hash='$user'";
				$query8 = mysqli_query($db_connection, $sql8);
				while ($row = mysqli_fetch_array($query8, MYSQLI_ASSOC)) {
					array_push($array_7, $row["date_year_diff"]);
				}
				$xp_years = array_sum($array_7);
				$xp_result = 100/60 * $xp_years;
			}else{
				$xp_result = 0;
			}
			//--------------------------------------------------------------------------//
			$seeker_result = $profile_strength + $skill_similarity + $degree_result + $xp_result;
			//---------------------------------------------------------------------------//
			$sql = "INSERT INTO job_post_activity(e_hash, job_post_id, apply_date, seeker_profile_strength, skill_match, degree_match, industry_xp, seeker_result) 
											VALUES('$user','$jid',now(),'$profile_strength','$skill_similarity','$degree_result','$xp_result','$seeker_result')";
			$query = mysqli_query($db_connection, $sql);
			$sql_ = "UPDATE seeker_profile SET last_job_apply_date=now() WHERE e_hash='$user'";
			$query_ = mysqli_query($db_connection, $sql_);
			mysqli_close($db_connection);
	        echo "apply_ok";
	        exit();
		}
	} else if($_POST['type2'] == "unapply"){
	    if ($numrows == 0) {
		    mysqli_close($db_connection);
	        echo "You can't cancel an application you've not sent";
	        exit();
	    } else {
			$sql = "DELETE FROM job_post_activity WHERE e_hash='$user' AND job_post_id='$jid'";
			$query = mysqli_query($db_connection, $sql);
			mysqli_close($db_connection);
	        echo "unapply_ok";
	        exit();
		}
	}
}
?>