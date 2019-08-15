<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2018 <a href="javascript:void(0);" onclick="owlphinhome()">Bacsyd</a>. </div>
      </div>
    </div>
  </div>
  <div class="face-mini normal hand feedextra-mobile-no-visibility" pd-popup-open="feedback">
	<div class="eye-mini">
      <div class="eye-left-mini"></div>
      <div class="eye-left-mini"></div>
	</div>
  <div class="mouth-mini"></div>
  </div>
  <div class="owl-standby owlstandby-mobile-no-display">
	<span class="hand"><img src="_img/owlphin_gif.gif" style="height:25px;" />&nbsp;&nbsp; <span id="owl-text" style="font-size:14px;">How can I help?</span></span>
  </div>
</div>

	<div class="popup" id="feedback" pd-popup="feedback" style="display:none;">
		<div class="popup-inner">
		<div id="feedbackloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span6">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
				  <div style="text-align:right;margin-right: 10px;">
				  <button class="btn btn-primary" pd-popup-close="feedback">
				    <span style="margin: 0;color: #fff;" class="fa fa-close"></span>
				  </button>
				</div>
					
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content text-center" style="padding: 10px;">
					  <span id="feedback_text"><h3>How do you rate your overall experience?</h3></span>
						<div class="cf" style="display: inline-flex;">
						<div id="good_head" class="emoji-feed text-center">
						  <div class="face hand" onclick="feedbackSubmit('g','<?php echo $log_email ?>')">
						    <div class="eye">
							  <div class="eye-left"></div>
							  <div class="eye-left"></div>
						    </div>
						    <div class="mouth"></div>
						  </div>
						 <span><a href="javascript:void(0)" onclick="feedbackSubmit('g','<?php echo $log_email ?>')">Good</a></span>
						</div>
						<div id="average_head" class="emoji-feed text-center">
						  <div class="face normal hand" onclick="feedbackSubmit('a','<?php echo $log_email ?>')">
						    <div class="eye">
							  <div class="eye-left"></div>
							  <div class="eye-left"></div>
						    </div>
						    <div class="mouth"></div>
						  </div>
						  <span><a href="javascript:void(0)" onclick="feedbackSubmit('a','<?php echo $log_email ?>')">Average</a></span>
						</div>
						<div id="bad_head" class="emoji-feed text-center">
						  <div class="face down hand" onclick="feedbackSubmit('b','<?php echo $log_email ?>')">
						    <div class="eye">
							  <div class="eye-left"></div>
							  <div class="eye-left"></div>
						    </div>
						    <div class="mouth"></div>
						  </div>
						  <span><a href="javascript:void(0)" onclick="feedbackSubmit('b','<?php echo $log_email ?>')">Bad</a></span>
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
function feedbackSubmit(type,person){
	document.getElementById('feedbackloader').style.display = 'block';
	var xmlhttp5 = new XMLHttpRequest();
	xmlhttp5.onreadystatechange = function(){
		if(xmlhttp5.readyState==4&&xmlhttp5.status==200){
			document.getElementById('feedback_text').innerHTML = '<h3 style="color:green">Thanks for your feedback!</h3>';
			if(xmlhttp5.responseText == 'g'){
				$('#average_head').fadeOut(100);
				$('#bad_head').fadeOut(100);
			}else if(xmlhttp5.responseText == 'a'){
				$('#good_head').fadeOut(100);
				$('#bad_head').fadeOut(100);
			}else if(xmlhttp5.responseText == 'b'){
				$('#good_head').fadeOut(100);
				$('#average_head').fadeOut(100);
			}
			document.getElementById('feedbackloader').style.display = 'none';
		}
	}
	xmlhttp5.open('GET','_parse/_feedback_system.php?type='+type+'&person='+person, true);
	xmlhttp5.send();
}	
</script>