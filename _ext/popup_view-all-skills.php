<?php
$sql4 = "SELECT * FROM seeker_skill_set WHERE e_hash='$e'";
$query = mysqli_query($db_connection, $sql4);
$allskillList = "";
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$sid = $row["id"];
	$skill_set_name = $row["skill_set_name"];

	$allskillList .= '<div id="" class="profile_widget" style="margin: 0 .9% 5px;"><div class="profile_widget-image"><span style="font-size: 1em;" class="fa fa-star"></span></div>';
	$allskillList .= '<div class="profile_widget-details"><h5>'.$skill_set_name.'</h5></div></div>';
					
}
?>
<div class="popup" id="v_allskills" pd-popup="v_allskills">
	<div class="popup-inner-dp">
		<div class="row">
			<div class="span6">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3><?php echo $firstname;?>'s skills</h3>	
				  </div>
					<div class="widget-content" style="max-height: 200px;overflow-y: scroll;">
					  <div class="big_stats cf">
						<div class="profile_widgets"> 
						  <div class="user_skill">
						     <?php echo $allskillList;?>
						  </div>
						</div>
					  </div>
					</div>
					<div style="text-align:right;padding: 4px;"><button class="btn btn-primary" pd-popup-close="v_allskills">Close</button></div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>