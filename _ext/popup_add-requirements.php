	<div class="popup" id="addrequirement" pd-popup="addrequirement" style="display:none;">
		<div class="popup-inner">
		<div id="addreqloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span7">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Lets add some requirements to your job</h3>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form class="form-horizontal" id="skillpost" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
							  <fieldset>
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="degree">M. Qualification</label>
									<div class="controls">
									  <select name="degree" id="degree">
										<option Selected value="" disabled></option>
										<option value="Diploma degree">Diploma degree</option>
										<option value="Bachelor/s degree">Bachelor's degree</option>
										<option value="Doctor of Education - EdD">Doctor of Education - EdD</option>
										<option value="Doctor of Law - JD">Doctor of Law - JD</option>
										<option value="Master/s degree">Master's degree</option>
										<option value="Engineer/s degree">Engineer's degree</option>
										<option value="Doctor of Philosophy - phD"> Doctor of Philosophy - phD</option>
										<option value="Other">Any</option>
									  </select>
									  <p class="help-block">Select minimum educational qualification for your job</p>
									</div>		
								  </div>
								 </div>
								 <div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="limit">Shortlist Limit</label>
									<div class="controls">
									  <select name="limit" id="limit">
										<option Selected value="100" disabled>Optional</option>
										<option value="10">10%</option><option value="20">20%</option><option value="30">30%</option>
										<option value="40">40%</option><option value="50">50%</option><option value="60">60%</option>
										<option value="70">70%</option><option value="80"> 80%</option>
										<option value="90">90%</option><option value="100">100%</option>
									  </select>
									  <p class="help-block"> Select the percentage of candidates you want us to shortlist</p>
									</div>		
								  </div>
								 </div>
								  <div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="skillset1">Skill</label>
									<div class="controls">
									  <select style="border:1px solid #686868;" name="skillset1" id="skillset1">
									   <option Selected value="" disabled></option>
										<option value="Data (Extraction/Entry/Verification)">Data (Extraction/Entry/Verification)</option><option value="Form Development and Processing">Form Development and Processing</option><option value="Public Speaking">Public Speaking</option>
										<option value="Photo Editing">Photo Editing</option><option value="Web Research">Web Research</option><option value="Digital survey development and administration">Digital survey development and administration</option>
										<option value="Digital Marketing & Advertising">Digital Marketing & Advertising</option><option value="Mobile Application Development">Mobile Application Development</option>
										<option value="Legal Document Review">Legal Document Review</option><option value="Business Template Review and Redevelopment">Business Template Review and Redevelopment</option>
										<option value="Business Plan development and proof reading">Business Plan development and proof reading</option><option value="Desk Feasibility Research">Desk Feasibility Research</option>
										<option value="Proposal Development">Proposal Development</option><option value="Product Research">Product Research</option><option value="Project Research">Project Research</option>
										<option value="Market Research">Market Research</option><option value="Process Development">Process Development</option><option value="Financial Templates">Financial Templates</option>
										<option value="Web Application Development">Web Application Development</option><option value="Website Development">Website Development</option><option value="Logo/3D Designs">Logo/3D Designs</option>
									  </select> 
									  <p class="help-block">Here are some suggestions you can choose from</p>
									</div>		
								  </div>
								</div>
								<div id="skill2BtnArea" class="control-flex" style="display:;">
								  <div class="control-group-max">											
									<div class="controls">
									  <button class="btn btn-small" id="skill2Btn">Add another skill</button> 
									</div>		
								  </div>
								</div>
								<div id="skill2" class="control-flex" style="display:none;">
								  <div class="control-group-max">											
									<label class="control-label" for="skillset2">Skill #2</label>
									<div class="controls">
									  <select style="border:1px solid #686868;" name="skillset2" id="skillset2">
									   <option Selected value="" disabled></option>
										<option value="Data (Extraction/Entry/Verification)">Data (Extraction/Entry/Verification)</option><option value="Form Development and Processing">Form Development and Processing</option><option value="Public Speaking">Public Speaking</option>
										<option value="Photo Editing">Photo Editing</option><option value="Web Research">Web Research</option><option value="Digital survey development and administration">Digital survey development and administration</option>
										<option value="Digital Marketing & Advertising">Digital Marketing & Advertising</option><option value="Mobile Application Development">Mobile Application Development</option>
										<option value="Legal Document Review">Legal Document Review</option><option value="Business Template Review and Redevelopment">Business Template Review and Redevelopment</option>
										<option value="Business Plan development and proof reading">Business Plan development and proof reading</option><option value="Desk Feasibility Research">Desk Feasibility Research</option>
										<option value="Proposal Development">Proposal Development</option><option value="Product Research">Product Research</option><option value="Project Research">Project Research</option>
										<option value="Market Research">Market Research</option><option value="Process Development">Process Development</option><option value="Financial Templates">Financial Templates</option>
										<option value="Web Application Development">Web Application Development</option><option value="Website Development">Website Development</option><option value="Logo/3D Designs">Logo/3D Designs</option>
									  </select> 
									</div>		
								  </div>
								</div>
								<div id="skill3BtnArea" class="control-flex" style="display:none;">
								  <div class="control-group-max">											
									<div class="controls">
									  <button class="btn btn-small" id="skill3Btn">Add another skill</button> 
									</div>		
								  </div>
								</div>
								<div id="skill3" class="control-flex" style="display:none;">
								  <div class="control-group-max">											
									<label class="control-label" for="skillset3">Skill #3</label>
									<div class="controls">
									  <select style="border:1px solid #686868;" name="skillset3" id="skillset3">
									   <option Selected value="" disabled></option>
										<option value="Data (Extraction/Entry/Verification)">Data (Extraction/Entry/Verification)</option><option value="Form Development and Processing">Form Development and Processing</option><option value="Public Speaking">Public Speaking</option>
										<option value="Photo Editing">Photo Editing</option><option value="Web Research">Web Research</option><option value="Digital survey development and administration">Digital survey development and administration</option>
										<option value="Digital Marketing & Advertising">Digital Marketing & Advertising</option><option value="Mobile Application Development">Mobile Application Development</option>
										<option value="Legal Document Review">Legal Document Review</option><option value="Business Template Review and Redevelopment">Business Template Review and Redevelopment</option>
										<option value="Business Plan development and proof reading">Business Plan development and proof reading</option><option value="Desk Feasibility Research">Desk Feasibility Research</option>
										<option value="Proposal Development">Proposal Development</option><option value="Product Research">Product Research</option><option value="Project Research">Project Research</option>
										<option value="Market Research">Market Research</option><option value="Process Development">Process Development</option><option value="Financial Templates">Financial Templates</option>
										<option value="Web Application Development">Web Application Development</option><option value="Website Development">Website Development</option><option value="Logo/3D Designs">Logo/3D Designs</option>
									  </select> 
									</div>		
								  </div>
								</div>
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-inverse" id="addRequirementBtn" type="submit">Done</button> 
									  <button class="btn" onclick="CloseAddRequirement()">Not now</button>
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
$(document).ready(function(e){
	$("#skill2Btn").click(function(){
		$("#skill2").slideDown(100);
		$("#skill3BtnArea").slideDown(200);
		$("#skill2BtnArea").fadeOut(10);
	});
	$("#skill3Btn").click(function(){
		$("#skill3").slideDown(100);
		$("#skill3BtnArea").fadeOut(10);
	});
})
function CloseAddRequirement(){
	$("#addrequirement").fadeOut(300);
	$("#skill2").fadeOut(0);
	$("#skill3").fadeOut(0);
	$("#skill3BtnArea").fadeOut(0);
	$("#skill2BtnArea").fadeIn(0);
}
function AddRequirements(jid,jobbox){
	if(jid == ""){
		return false;
	}else{
		$("#addrequirement").fadeIn(10);
	}
	$("#addRequirementBtn").click(function(){
		var degree = document.getElementById("degree").value;
		var limit = document.getElementById("limit").value;
		var skillset1 = document.getElementById("skillset1").value;
		var skillset2 = document.getElementById("skillset2").value;
		var skillset3 = document.getElementById("skillset3").value;
		if(jid == "" || degree == "" || skillset1 == ""){
			Hint.render("Please fill out all of the form data");
		}else{
			document.getElementById("addreqloader").style.display = "block";
			var ajax = ajaxObj("POST", "_parse/_all_edits.php");
			ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "req_failed"){
					return false;
					document.getElementById("addreqloader").style.display = "none";
				} else {
					document.getElementById("addreqloader").style.display = "none";
					Success.render("Job post was updated");
					$("#addrequirement").fadeOut(300);
					$("#skill2").fadeOut(0);
					$("#skill3").fadeOut(0);
					$("#skill3BtnArea").fadeOut(0);
					$("#skill2BtnArea").fadeIn(0);
					document.getElementById("degree").value = "";
					document.getElementById("skillset1").value = "";
					document.getElementById("skillset2").value = "";
					document.getElementById("skillset3").value = "";
					document.getElementById("limit").value = "";
					jid = "";
				}
			}
		}
		ajax.send("action=add_req&jid="+jid+"&degree="+degree+"&skillset1="+skillset1+"&skillset2="+skillset2+"&skillset3="+skillset3+"&limit="+limit);
		}
	});
}
</script>	