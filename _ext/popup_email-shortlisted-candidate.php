	<div class="popup" id="emailshortlistedcddt" pd-popup="emailshortlistedcddt" style="display:none;">
		<div class="popup-inner">
		<div id="escloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span10">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Email Candidate</h3>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
							  <fieldset>
								<div class="control-flex">
								  <div class="control-group-max">											
									<div class="controls" style="margin-left: 25px;">
										<p style="text-align:center;">This message can be written in a letter format.
										Aside your acceptance message, it should also contain company's precise location, contact, 
										interview schedule and any other relevant information. Your choice.</p>
									  <textarea style="height:300px;max-height:400px;"class="span9" name="e_message" id="e_message" type="text" maxlength="400"></textarea>
									</div>		
								  </div>
								</div>
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-primary" id="sendemail">Send</button> 
									  <button class="btn" pd-popup-close="emailshortlistedcddt">Cancel</button>
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
function OpenEmailCandidate(jobid,userhash){
	if(jobid == ""){
		return false;
	}else{
		$("#emailshortlistedcddt").fadeIn(10);
	}
	$("#sendemail").click(function(){
		var message = document.getElementById("e_message").value;
		if(message == ""){
			Hint.render("Please type a message for candidate");
		}else if(!message.replace(/\s/g, '').length){
			Hint.render("Please type a message for candidate");
		}else{
			emailtext = message.replace(/\r?\n/g, '<br />');
			_("escloader").style.display = "block";
			var ajax = ajaxObj("POST", "_parse/send_email_to_candidate.php");
			ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText != "email_sent"){
					return false;
					_("escloader").style.display = "none";
				} else {
					Success.render("Email was successfully sent");
					_("escloader").style.display = "none";
					$("#emailshortlistedcddt").fadeOut(200);
					jobid = "";
					userhash = "";
				}
			}
		}
		ajax.send("jobid="+jobid+"&emailtext="+encodeURIComponent(emailtext)+"&userhash="+userhash);
		}
	});
}
</script>