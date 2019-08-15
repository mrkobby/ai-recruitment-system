<div class="popup" id="jobdetails" pd-popup="jobdetails" style="display:none;">
	<div class="popup-inner">
	<div id="jobdetailsLoader" class="div-loader-cover"><div class="spinner"></div></div>
		<div class="row">
		  <div class="span8">
            <div class="widget widget-nopad">
              <div class="widget-header text-center">
				<div style="float:left;margin-left: 10px;">
				  <h3>Job details</h3>
				</div>	
				<div style="text-align:right;margin-right: 10px;">
				  <button class="btn btn-primary" onclick="CloseJobDetails()">
					<span style="margin: 0;color: #fff;" class="fa fa-close"></span>
				  </button>
				</div>
              </div>
              <div class="widget-content">
                <div class="widget big-stats-container" style="margin-bottom: 0;">
                  <div class="widget-content">
                    <div class="cf">
					  <div class="profile_widgets"> 
						 <div id="jobdets">
					     <div style="display:block;" class="div-loader-cover"><div class="spinner"></div></div>	
						</div>
					  </div>
                    </div>
                  </div>
				 <!-- <div style="text-align:right;padding: 4px;"><button class="btn btn-primary" onclick="CloseJobDetails()">Close</button></div>-->
                </div>
              </div>
            </div>
          </div>
		</div>
	</div>
</div>
<script type="text/javascript">
function OpenJobDetails(jid,jobbox){
	if(jid == ""){
		return false;
	}
	var xmlhttp7 = new XMLHttpRequest();
	xmlhttp7.onreadystatechange = function(){
		if(xmlhttp7.readyState==4&&xmlhttp7.status==200){
			document.getElementById('jobdets').innerHTML = xmlhttp7.responseText;
		}
	}
	xmlhttp7.open('GET','_parse/load_job-details.php?jid='+jid, true);
	xmlhttp7.send();
	$("#jobdetails").fadeIn(10);
}
function CloseJobDetails(){
	$("#jobdetails").fadeOut(500);
	document.getElementById('jobdets').innerHTML = '<div style="display:block;" class="div-loader-cover"><div class="spinner"></div></div>';
}
function deleteRJob(rjbid,rjbox){
	Confirm.render("Are you sure you want to delete this job?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "delete_ok"){
					_(rjbox).style.display = 'none';
				} else {
					Hint.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_rjob&rjbid="+rjbid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>