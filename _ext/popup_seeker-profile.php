<div class="popup" id="seekerprofile" pd-popup="seekerprofile" style="display:none;">
	<div class="popup-inner">
	<div id="seekerprofileLoader" class="div-loader-cover"><div class="spinner"></div></div>
		<div class="row">
		  <div class="span10" style="width: 781px;">
            <div class="widget widget-nopad">
              <div class="widget-header text-center">
			  	<div style="text-align:right;margin-right: 10px;">
				  <button class="btn btn-primary" onclick="CloseSeekerProfile()">
				    <span style="margin: 0;color: #fff;" class="fa fa-close"></span>
				  </button>
				</div>
              </div>
              <div class="widget-content" style="max-height: 500px;overflow-y: scroll;padding: 5px;">
                <div class="widget big-stats-container" style="margin-bottom: 0;">
                  <div class="widget-content">
                    <div class="cf">
					  <div class="profile_widgets"> 
					  <div class="row">
						<div class="span9" style="width: 754px;">
						  <div class="box box-widget widget-user profile-gradient">
							<div style="text-align: center;"><div class="widget-user-header bg-profile"></div></div>	
							<div id="seeker_user_pic" class="widget-user-image"><div class="spinner" style="background-color: #000;margin-left: 35px;"></div></div>
							<div class="banner-user text-center" style="padding-bottom: 0px;">
							  <h2 class="profile-user text-center"><span id="seeker_user_fname"><?php echo "firstname";?></span> <span id="seeker_user_lname"><?php echo "lastname";?></span></h2>
							  <h3><span style="margin: 0;color: #777;" class="fa fa-envelope"></span> <span id="seeker_user_email" style="font-size:14px;"><?php echo "email";?></span></h3>
							  <span id="seeker_user_contact"><h3><span style="margin: 0;color: #777;" class="fa fa-phone"></span> <span style="font-size:12px;"><?php echo "contact";?></span></h3></span><br/>
							</div>
						  </div>
						</div>
					  </div>
					   <div class="row" style="margin-bottom: 15px;">
						<div class="span9" style="width: 754px;">
						  <div class="widget widget-nopad">
							<div class="widget-header"> <i class="fa fa-user"></i>
							  <h3>Bio</h3>
							</div>
							<div class="widget-content">
							  <div class="widget big-stats-container">
								<div class="widget-content">
								  <div class="big_stats cf">
									<div class="profile_widgets"> 
									  <div id="seeker_user_bio" style="padding: 0px 10px 10px 10px;font-size: 14px;">
									    <div class="spinner" style="background-color: #000;"></div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
						<div class="row" style="margin-bottom: 15px;">
						<div class="span9" style="width: 754px;">
						  <div class="widget widget-nopad">
							<div class="widget-header"> <i class="fa fa-gavel"></i>
							  <h3>Skills</h3>
							</div>
							<div class="widget-content">
							  <div class="widget big-stats-container">
								<div class="widget-content">
								  <div class="big_stats cf">
									<div class="profile_widgets"> 
									  <div id="seeker_user_skill">
										 <div class="spinner" style="background-color: #000;"></div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					   <div class="row" style="margin-bottom: 15px;">
						<div class="span9" style="width: 754px;">
						  <div class="widget widget-nopad">
							<div class="widget-header"> <i class="fa fa-mortar-board"></i>
							  <h3>Education</h3>
							</div>
							<div class="widget-content">
							  <div class="widget big-stats-container">
								<div class="widget-content">
								  <div class="big_stats">
									 <div class="profile_widgets"> 
									  <div id="seeker_user_edu">
										<div class="spinner" style="background-color: #000;"></div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="row">
						<div class="span9" style="width: 754px;">
						  <div class="widget widget-nopad">
							<div class="widget-header"> <i class="fa fa-suitcase"></i>
							  <h3>Experience</h3>
							</div>
							<div class="widget-content">
							  <div class="widget big-stats-container">
								<div class="widget-content">
								  <div class="big_stats">
									 <div class="profile_widgets"> 
									  <div id="seeker_user_xp">
										<div class="spinner" style="background-color: #000;"></div>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
		</div>
	</div>
</div>
<script type="text/javascript">
function OpenSeekerProfile(userhash){
	if(userhash == ""){
		return false;
	}
	var xmlhttp7 = new XMLHttpRequest();
	xmlhttp7.onreadystatechange = function(){
		if(xmlhttp7.readyState==4&&xmlhttp7.status==200){
			var ustring = xmlhttp7.responseText.split("|||");
			for (var i = 0; i < ustring.length; i++){
				var string = ustring[i].split("|");		
			}	
			var userpic = string[0];
			var skillset = string[1];
			var xplist = string[2];
			var edulist = string[3];
			var firstname = string[4];
			var lastname = string[5];
			var email = string[6];
			var seekerbio = string[7];
			var seekercontact = string[8];
				
			document.getElementById('seeker_user_pic').innerHTML = userpic;
			document.getElementById('seeker_user_skill').innerHTML = skillset;
			document.getElementById('seeker_user_xp').innerHTML = xplist;
			document.getElementById('seeker_user_edu').innerHTML = edulist;
			document.getElementById('seeker_user_fname').innerHTML = firstname;
			document.getElementById('seeker_user_lname').innerHTML = lastname;
			document.getElementById('seeker_user_email').innerHTML = email;
			document.getElementById('seeker_user_bio').innerHTML = seekerbio;
			document.getElementById('seeker_user_contact').innerHTML = '<h3><span style="margin: 0;color: #777;" class="fa fa-phone"></span> <span style="font-size:12px;">'+seekercontact+'</span></h3>';
		}
	}
	xmlhttp7.open('GET','_parse/load_user-profile.php?userhash='+encodeURIComponent(userhash), true);
	xmlhttp7.send();
	$("#seekerprofile").fadeIn(10);
	$(".sht_caddts").fadeOut(10);
}
function CloseSeekerProfile(){
	document.getElementById("livesearch").style.display="none";
	$("#seekerprofile").fadeOut(500);
	$('.search-query').val("");
	document.getElementById('seeker_user_pic').innerHTML = '<div class="spinner" style="background-color: #000;margin-left: 35px;"></div>';
	document.getElementById('seeker_user_skill').innerHTML = '<div class="spinner" style="background-color: #000;"></div>';
	document.getElementById('seeker_user_xp').innerHTML = '<div class="spinner" style="background-color: #000;"></div>';
	document.getElementById('seeker_user_edu').innerHTML = '<div class="spinner" style="background-color: #000;"></div>';
	document.getElementById('seeker_user_fname').innerHTML = '';
	document.getElementById('seeker_user_lname').innerHTML = '';
	document.getElementById('seeker_user_email').innerHTML = '';
	document.getElementById('seeker_user_bio').innerHTML = '';
	document.getElementById('seeker_user_contact').innerHTML = '';
}
</script>