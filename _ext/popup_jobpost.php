<div class="popup" id="postjob" pd-popup="postjob" style="display:none;">
	<div class="popup-inner">
	<div id="jobloader" class="div-loader-cover"><div class="spinner"></div></div>
	  <div class="row">
		<div class="span12">
          <div class="widget widget-nopad" style="margin-bottom: 0em;">
            <div class="widget-header text-center">
              <h3>Tell us about the job</h3>
            </div>
            <div class="widget-content">
              <div class="widget big-stats-container" style="margin-bottom: 0;">
                <div class="widget-content">
                  <div class="cf">
                    <form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
					  <fieldset>
						<div class="control-flex">
						  <div class="control-group">											
						    <label class="control-label" for="jobtitle">Job title</label>
						    <div class="controls">
							  <input class="span6" name="jobtitle" id="jobtitle" type="text">
						    </div>			
						  </div>
						  <div class="control-group">											
						    <label class="control-label" for="jobtype">Job type</label>
						    <div class="controls">
							  <select name="jobtype" id="jobtype">
							    <option value="" Selected disabled></option>
								<option value="Fulltime">Full-time</option><option value="Part-time">Part-time</option><option value="Contract">Contract</option>
								<option value="Temporary">Temporary</option><option value="Volunteer">Volunteer</option><option value="Internship">Internship</option>
							  </select> 
						    </div>		
						  </div>
						</div>
						<div class="control-flex">	
						  <div class="control-group">											
						    <label class="control-label" for="region">Region</label>
						    <div class="controls">
							  <select name="region" id="region">
							    <option value="" Selected disabled></option>
								<option value="Ashanti">Ashanti</option><option value="Brong-Ahafo">Brong-Ahafo</option><option value="Greater Accra">Greater Accra</option>
								<option value="Central">Central</option><option value="Eastern">Eastern</option><option value="Northern">Northern</option>
								<option value="Western">Western</option><option value="Upper East">Upper East</option><option value="Upper West">Upper West</option>
								<option value="Volta">Volta</option>
							  </select> 
						    </div>		
						  </div>
						  <div class="control-group">											
						    <label class="control-label" for="deadline">Deadline</label>
						    <div class="controls">
							  <select name="deadline" id="deadline">
							    <option value="" Selected disabled></option>
								<option value="1 minute">1 minute</option><option value="5 minutes">5 minutes</option>
								<option value="15 minutes">15 minutes</option><option value="1 hour">1 hour</option>
								<option value="5 hours">5 hours</option><option value="12 hours">12 hours</option>
								<option value="1 day">1 day</option><option value="7 days">7 days</option>
							  </select> 
								 <p class="help-block">Set when we should close this job vacancy</p>
						    </div>		
						  </div>	
						</div>	
						<div class="control-flex">
						  <div class="control-group-max">											
						    <label class="control-label" for="jobdes">Job description</label>
						    <div class="controls">
							  <textarea class="span9" onkeyup="statusMax(this,400)" name="jobdes" id="jobdes" type="text" maxlength="400"></textarea>
						    </div>		
						  </div>		
						</div>	
						<div class="form-actions">
						  <div class="control-group" style="margin-bottom: 0px;">											
						    <div class="controls" style="margin-left: 30px;float: left;"> 
							   <button class="btn" pd-popup-close="postjob">Cancel</button>
						    </div>	
							<div class="controls" style="margin-right: 30px;"> 
							  <button class="btn btn-inverse" onclick="submitJob()">Continue</button> 

							  <button class="btn btn-primary" onclick="rjob('<?php echo $log_email;?>')">View my jobs</button> 
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
function statusMax(field, maxlimit) {
	if (field.value.length > maxlimit){
		Hint.render(maxlimit+" maximum character limit reached");
		field.value = field.value.substring(0, maxlimit);
	}
}	
function submitJob(){
	var jobtitle = _("jobtitle").value;
	var jobtype = _("jobtype").value;
	var jobdes = _("jobdes").value;
	var region = _("region").value;
	var deadline = _("deadline").value;
	if(jobtitle == "" || jobtype == "" || jobdes == "" || region == "" || deadline == ""){
		Hint.render("Please fill out all of the form data");
	}else if(!jobtitle.replace(/\s/g, '').length || !jobdes.replace(/\s/g, '').length){
		Hint.render("Please fill out all of the form data");
	}else{
		text = jobdes.replace(/\r?\n/g, '<br />');
		_("jobloader").style.display = "block";
		var ajax = ajaxObj("POST", "_parse/_post_job.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "jobpost_failed"){
					_("jobloader").style.display = "none";
					Hint.render("Job post failed for some strange reason. Please try again");
				}else {
					var ustring = ajax.responseText.split("|||");
					for (var i = 0; i < ustring.length; i++){
						var string = ustring[i].split("|");		
					}	
					var rjoblist = string[0];
					var jid = string[1];
					var jobbox = string[2];
					
					_("jobloader").style.display = "none";
					document.getElementById("jobtitle").value = "";
					document.getElementById("jobtype").value = "";
					document.getElementById("jobdes").value = "";
					document.getElementById("deadline").value = "";
					document.getElementById("region").value = "";
					$("#postjob").hide(0);
					Success.render("Job was posted");
					$(".rjoblogs").html(rjoblist);
					AddRequirements(jid,jobbox);
				}
	        }
        }
		ajax.send("jobtitle="+encodeURIComponent(jobtitle)+"&jobtype="+jobtype+"&jobdes="+encodeURIComponent(text)+"&region="+region+"&deadline="+deadline);
	
	}
}
</script>