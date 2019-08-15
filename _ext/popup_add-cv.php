<div class="popup" id="addcv" pd-popup="addcv">
	<div class="popup-inner-dp">
	<div id="cvAddDiv" class="div-loader-cover"><div class="spinner"></div></div>
		<div class="row">
			<div class="span6">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Upload your CV</h3>	
				  </div>
				  <div class="widget-content" style="padding-bottom: 10px;">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form id="uploadCv" action="_parse/upload_cv.php" method="post" enctype="multipart/form-data">
								<div style="margin-bottom: 5px;">
									<div class="input-group" style="margin:15px auto;">
										<label id="cvBtn" for="cvfile" class="btn btn-primary btn-block" style="width:auto;"><span id="fileCaptionCv">Please select file &nbsp;</span><span class="fa fa-file"></span></label>
										<input name="cvfile" id="cvfile" style="width:0%;visibility:hidden;display: none;" type="file" required />
									</div>
								</div>
								<div style="width: 90%;margin: auto;">
									<input type="submit" value="Upload" class="btn btn-primary pull-right"></input>
									<a id="cvCancel" pd-popup-close="addcv" href="#" class="btn btn-default pull-left" style="margin-right: 5px;">Cancel</a>
									<a href="javascript:void(0)" onmousedown="deleteCv()" class="btn btn-info pull-left" style="margin-right: 40px;color:#fff;">Remove</a>
								</div>
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
<script src="_js/_query.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#cvfile").change(function(){
		$("#fileCaptionCv").hide(200);
		$("#cvBtn").removeClass('btn-primary').addClass('btn-inverse');
	});
	$("#uploadCv").on('submit',(function(e) {
		document.getElementById("cvAddDiv").style.display = 'block';
		e.preventDefault();
		$.ajax({
        	url: "_parse/upload_cv.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			   $("#targetCvLayer").html(data);
			   document.getElementById("cvfile").value = "";
			   $('#addcv').fadeOut(100);
			   document.getElementById("cvAddDiv").style.display = 'none';
		    },
		  	error: function() {} 	        
	   });
	}));
	$('#cvCancel').on('click', function(e)  {
		document.getElementById("cvfile").value = "";
		$("#fileCaptionCv").show(200);
		$("#cvBtn").removeClass('btn-inverse').addClass('btn-primary');
    });
});
function deleteCv(){
	Confirm.render("Do you really want to remove your reference CV?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		document.getElementById("cvAddDiv").style.display = 'block';
		var ajax = ajaxObj("POST", "_parse/upload_cv.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "remove_ok"){
					$("#targetCvLayer").html('<h4><b style="color:maroon;font-size: 16px;">CV was removed</b></h4>');
				   document.getElementById("cvfile").value = "";
				   $("#fileCaptionCv").show(200);
					$("#cvBtn").removeClass('btn-inverse').addClass('btn-primary');
				   $('#addcv').fadeOut(100);
				   document.getElementById("cvAddDiv").style.display = 'none';
				} else {
					Alert.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_cv");
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>