<?php
$sql = "SELECT * FROM job_post WHERE company_id='$log_email'";
$query = mysqli_query($db_connection, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$job_id = $row["id"];
	$job_type = $row["job_type"];
	$company_id = $row["company_id"];
	$created_date = strftime("%b %d, %Y at %I:%M %p", strtotime($row["created_date"]) - 60 * 60 * 2);
	$deadline_date = $row["deadline_date"];
	$deadline_mhs = $row["deadline_mhs"];
	$job_title = $row["job_title"];
	$job_description = $row["job_description"];
	$region = $row["region"];
	$qualification = $row["qualification"];
	$is_active = $row["is_active"];
	$rjobDeleteButton = '';
}
?>
<div class="popup" id="editpostjob" pd-popup="editpostjob" style="display:none;">
	<div class="popup-inner">
	<div id="editjobloader" class="div-loader-cover"><div class="spinner"></div></div>
	  <div class="row">
		<div class="span12">
          <div class="widget widget-nopad" style="margin-bottom: 0em;">
            <div class="widget-header text-center">
              <h3>Edit job post</h3>
            </div>
            <div class="widget-content">
              <div class="widget big-stats-container" style="margin-bottom: 0;">
                <div class="widget-content">
                  <div class="cf">
                    <form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
					  <fieldset>
						<div class="control-flex">
						  <div class="control-group">											
						    <label class="control-label" for="ejobtitle">Job title</label>
						    <div class="controls">
							  <input class="span6" name="ejobtitle" id="ejobtitle" type="text" value="<?php echo $job_title;?>">
						    </div>			
						  </div>
						  <div class="control-group">											
						    <label class="control-label" for="ejobtype">Job type</label>
						    <div class="controls">
							  <select name="ejobtype" id="ejobtype">
							    <option value="<?php echo $job_type;?>" Selected disabled><?php echo $job_type;?></option>
								<option value="Fulltime">Full-time</option><option value="Part-time">Part-time</option><option value="Contract">Contract</option>
								<option value="Temporary">Temporary</option><option value="Volunteer">Volunteer</option><option value="Internship">Internship</option>
							  </select> 
						    </div>		
						  </div>
						</div>
						<div class="control-flex">	
						  <div class="control-group">											
						    <label class="control-label" for="eregion">Region</label>
						    <div class="controls">
							  <select name="eregion" id="eregion">
							    <option value="<?php echo $region;?>" Selected disabled><?php echo $region;?></option>
								<option value="Ashanti">Ashanti</option><option value="Brong-Ahafo">Brong-Ahafo</option><option value="Greater Accra">Greater Accra</option>
								<option value="Central">Central</option><option value="Eastern">Eastern</option><option value="Northern">Northern</option>
								<option value="Western">Western</option><option value="Upper East">Upper East</option><option value="Upper West">Upper West</option>
								<option value="Volta">Volta</option>
							  </select> 
						    </div>		
						  </div>
						  <div class="control-group">											
						    <label class="control-label" for="edeadline">Deadline</label>
						    <div class="controls">
							  <select name="edeadline" id="edeadline">
							    <option value="<?php echo $deadline_mhs;?>" Selected disabled><?php echo $deadline_mhs;?></option>
								<option value="1 minute">1 minute</option><option value="5 minutes">5 minutes</option><option value="1 hour">1 hour</option>
								<option value="5 hours">5 hours</option><option value="12 hours">12 hours</option>
								<option value="1 day">1 day</option><option value="7 days">7 days</option>
							  </select> 
								 <p class="help-block">You can reset when we should close this job vacancy</p>
						    </div>		
						  </div>	
						</div>	
						<div class="control-flex">
						  <div class="control-group-max">											
						    <label class="control-label" for="ejobdes">Job description</label>
						    <div class="controls">
							  <textarea class="span9" onkeyup="statusMax(this,400)" name="ejobdes" id="ejobdes" type="text" placeholder="<?php echo $job_description;?>"></textarea>
						    </div>		
						  </div>		
						</div>	
						<div class="form-actions">
						  <div class="control-group" style="margin-bottom: 0px;">											
							<div class="controls" style="margin-right: 30px;"> 
							  <button class="btn btn-inverse" id="editpostjobBtn">Done</button>
							  <button class="btn" pd-popup-close="editpostjob">Cancel</button>							  
						    </div>		
						  </div>	
						</div>
					  </fieldset>
					</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
function EditJobPost(jid){
	if(jid == ""){
		return false;
	}else{
		$("#editpostjob").fadeIn(10);
	}
	$("#editpostjobBtn").click(function(){
		var jobtitle = document.getElementById("ejobtitle").value;
		var jobtype = document.getElementById("ejobtype").value;
		var jobdes = document.getElementById("ejobdes").value;
		var region = document.getElementById("eregion").value;
		var deadline = document.getElementById("edeadline").value;
		if(jobtitle == "" || jobtype == "" || region == "" || deadline == ""){
			Hint.render("Please fill out all of the form data");
		}else if(!jobtitle.replace(/\s/g, '').length){
			Hint.render("Please fill out all of the form data");
		}else{
			etext = jobdes.replace(/\r?\n/g, '<br />');
			_("editjobloader").style.display = "block";
			var ajax = ajaxObj("POST", "_parse/_all_edits.php");
			ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "jobedit_failed"){
					return false;
					_("editjobloader").style.display = "none";
				} else {
					$(".rjoblogs").html(ajax.responseText);
					Success.render("Job post was updated");
					_("editjobloader").style.display = "none";
					$("#editpostjob").fadeOut(200);
					jid = "";
				}
			}
		}
		ajax.send("action=edit_jobpost&jid="+jid+"&jobtitle="+encodeURIComponent(jobtitle)+"&jobtype="+jobtype+"&jobdes="+encodeURIComponent(etext)+"&region="+region+"&deadline="+deadline);
		}
	});
}
</script>