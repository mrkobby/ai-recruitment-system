<div class="popup sht_caddts" id="sht_caddts" pd-popup="sht_caddts">
	<div class="popup-inner-dp">
		<div class="row">
			<div class="span10">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<div style="float:left;margin-left: 10px;">
					  <h3>Shortlisted candidates</h3>
					</div>	
					  <div style="text-align:right;margin-right: 10px;">
					  <button class="btn btn-primary" onclick="CloseApplicants()">
						<span style="margin: 0;color: #fff;" class="fa fa-close"></span>
					  </button>
					</div>
				  </div>
					<div class="widget-content" style="max-height: 410px;overflow-y: scroll;">
					  <div class="big_stats cf">
						<div class="profile_widgets"> 
						  <div id="view_applicants">
						    <div style="display:block;" class="div-loader-cover"><div class="spinner"></div></div>	
						  </div>
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
function OpenApplicants(jobid){
	if(jobid == ""){
		return false;
	}
	var xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function(){
		if(xmlhttp2.readyState==4&&xmlhttp2.status==200){
			document.getElementById('view_applicants').innerHTML = xmlhttp2.responseText;
		}
	}
	xmlhttp2.open('GET','_parse/load_applicants.php?jid='+jobid, true);
	xmlhttp2.send();
	$("#sht_caddts").fadeIn(10);
}
function CloseApplicants(){
	$("#sht_caddts").fadeOut(500);
	document.getElementById('view_applicants').innerHTML = '<div style="display:block;" class="div-loader-cover"><div class="spinner"></div></div>';
}
</script>