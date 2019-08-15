	<div class="popup" id="addbio" pd-popup="addbio" style="display:none;">
		<div class="popup-inner">
		<div id="addbioloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span7">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Add / Edit bio</h3>
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
									  <textarea class="span9" name="bioupdate" id="bioupdate" type="text" maxlength="400"></textarea>
									</div>		
								  </div>
								</div>
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-primary" onclick="updatebio()">Add</button> 
									  <button class="btn" pd-popup-close="addbio">Cancel</button>
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
function updatebio(){
	var b = _("bioupdate").value;
	if(b == ""){
		return false;
	}else if(!b.replace(/\s/g, '').length){
		return false;
	}else{
		document.getElementById("addbioloader").style.display = 'block';
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "update_failed"){
					Alert.render("Bio update was unsuccessful");
					document.getElementById("addbioloader").style.display = 'none';
				}else {
					document.getElementById("addbioloader").style.display = 'none';
					$(".user_bio").html(ajax.responseText);
					document.getElementById("bioupdate").value = "";
					$("#addbio").hide(100);
				}
	        }
        }
		ajax.send("action=bio_update&b="+encodeURIComponent(b));
	}
}
</script>