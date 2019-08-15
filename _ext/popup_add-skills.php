	<div class="popup" id="addskill" pd-popup="addskill" style="display:none;">
		<div class="popup-inner">
		<div id="addskloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span7">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Add skills to your profile</h3>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form class="form-horizontal" id="skillpost" style="margin: 0 0 0px;" role="form" method="post" action="_parse/_all_edits.php">
							  <fieldset>
								<div class="control-flex">
								  <div class="control-group-max-sel">											
									<label class="control-label" for="skillset">Skill set</label>
									<div class="controls">
									  <select class="multisel" style="border:1px solid #686868;" name="skillset[]" id="skillset" multiple="multiple">
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
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-inverse" type="submit">Add</button> 
									  <button class="btn" pd-popup-close="addskill">Cancel</button>
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
$("#skillpost").on('submit',(function(e) {
	document.getElementById("addskloader").style.display = 'block';
	e.preventDefault();
	$.ajax({
       	url: "_parse/_all_edits.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			document.getElementById("addskloader").style.display = 'none';
			document.getElementById("skillset").value = "";
			$("#addskill").fadeOut(100);
			$(".user_skill").html(data);
		},
		  error: function() {} 	        
	});
}));

</script>	