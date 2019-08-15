<div class="popup" id="companyprofile" pd-popup="companyprofile">
	<div class="popup-inner-dp">
	<div id="dpPostDiv" class="div-loader-cover"><div class="spinner"></div></div>
		<div class="row">
			<div class="span6">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<div style="float:left;margin-left: 10px;">
					  <h3>Company info</h3>
					</div>	
					  <div style="text-align:right;margin-right: 10px;">
					  <button class="btn btn-primary" pd-popup-close="companyprofile">
						<span style="margin: 0;color: #fff;" class="fa fa-close"></span>
					  </button>
					</div>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;background: #f4f4f4;">
					  <div class="widget-content">
						<div class="cf">
						  <div class="box box-widget widget-user" style="margin-bottom: 0px;">
						  <div style="text-align: center;"><div class="widget-user-header bg-profile profile-gradient"></div></div>	
						  <div id="cpchangelogo" class="widget-user-image hand targetDpLayer" style="left: 45%;" pd-popup-open="changeDp"><?php echo $user_pic;?></div>
							<div class="banner-user text-center" style="padding-bottom: 20px;">
							<h3 class="profile-user text-center"><?php echo $company_name;?> <br>
								<span style="font-size:14px;"><?php echo $business_stream_name;?></span></h3>
								<h3> <span style="font-size:14px;"><?php echo $company_website_url;?></span></h3>
								<h3><button class="btn btn-primary" onclick="recruiter('<?php echo $log_email;?>')">View profile</button></h3>
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
</div>
<script type="text/javascript">
$("#cpchangelogo").click(function(){
	$("#companyprofile").fadeOut(100);
});
</script>