<?php
include_once("_sys/check_login_status.php");
if($user_ok == false){
	header("location: ../bacsyd");
    exit();
}
?><?php 
include_once("_ext/dashboard_ulog.php");
if($e != $log_email){
	header("location: ../bacsyd");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Settings</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.dashboard.css" rel="stylesheet">
</head>
<body>
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<?php include_once("_ext/dashboard_navbar.php");?>
<?php include_once("_ext/dashboard_dialog-searchlayer.php");?>
<?php include_once("_parse/_all_note_check.php");?>
  <div class="everything-everything"> <!--style="filter:blur(3px)" -->
	<div class="subnavbar">
	  <div class="subnavbar-inner">
		<div class="container">
		  <ul class="mainnav">
			<li><a href="javascript:void(0);" onclick="owlphinhome()"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
			<li <?php echo $usershow;?>><a href="javascript:void(0);" onclick="profile('<?php echo $log_email;?>')"><i class="fa fa-user"></i><span>Profile</span> </a> </li>
			<li><a href="javascript:void(0);" onclick="notifications('<?php echo $log_email;?>')"><i class="fa fa-bell"></i><span>Notifications</span> </a><span id="quick_note_num"><?php echo $note_label;?></span> </li>
			<?php echo $subnav_extras1;?>
			<?php echo $subnav_extras2;?>
			<li class="active right-border"><a href="javascript:void(0);" onclick="settings('<?php echo $log_email;?>')"><i class="fa fa-gears"></i><span>Settings</span> </a> </li>
			<?php echo $jobpost;?>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="main">
	  <div class="main-inner">
		<div class="container">
<!------------------------------------------------------------------------------------------------------------------------------>
		   <div class="row">
			<div class="span12">
			  <div class="widget widget-nopad">
				<div class="widget-header text-center">
				  <h3>Account management and Security</h3>
				</div>
				<div class="widget-content">
				  <div class="widget big-stats-container">
					<div class="widget-content">
					  <div class="big_stats" style="margin-top: 1em;">
						<div class="control-group">
						  <div class="controls" style="width: 95%;margin: auto;">
                            <div class="accordion" id="accordion2">
                              <div class="accordion-group">
                                <div class="accordion-heading">
                                  <a class="accordion-toggle" style="font-weight: bold;font-size: 15px;border: 1px solid;" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                    Phone number - <span id="showphone"><?php echo $user_phonenumber;?></span>
                                  </a>
                                </div>
                                <div id="collapseOne" class="accordion-body in" style="height: auto;">
                                  <div class="accordion-inner text-center" style="background-color: #efefef;">
                                    You haven’t added a phone number yet?<br />
									Your phone number helps us keep your account secure. It also helps people who already have your number connect with you.
									<form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
									  <fieldset>
										<div class="control-flex">
										  <div class="control-group">											
											<label class="control-label" for="country">Country</label>
											<div class="controls">
											  <select name="country" id="country">
												<option value="Ghana" Selected disabled>Ghana</option>
											  </select> 
											</div>			
										  </div>
										  <div class="control-group">											
											<label class="control-label" for="phone">Phone number</label>
											<div class="controls">
											  <input class="span6" name="phone" id="phone" onkeyup="restrict('phone')" type="text" maxlength="10">
											</div>		
										  </div>
										</div>
										<div class="form-actions">
										  <div class="control-group" style="margin-bottom: 0px;">											
											<div class="controls" style="margin-right: 30px;"> 
											  <button class="btn btn-inverse" onclick="addContact()">Save</button> 
											</div>		
										  </div>	
										</div>
									  </fieldset>
									</form>				
								  </div>
                                </div>
                              </div>
                              <div class="accordion-group">
                                <div class="accordion-heading">
                                  <a class="accordion-toggle" style="font-weight: bold;font-size: 15px;border: 1px solid;" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                    Change password
                                  </a>
                                </div>
                                <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
								<div id="changepassloader" class="div-loader-cover"><div class="spinner"></div></div>
                                  <div class="accordion-inner text-center" style="background-color: #efefef;">
                                    Choose a password that will be hard for others to guess. 
									 We will stop your session after changing your password, for security reasons.
									<form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
									  <fieldset>
									    <div class="control-flex">
										  <div class="control-group-max">											
											<label class="control-label" style="width: 130px;" for="oldpass">Current password</label>
											<div class="controls">
											  <input class="span6" style="width: 85%;" name="oldpass" id="oldpass" type="password">
											</div>			
										  </div>
										</div>
										<div class="control-flex">
										  <div class="control-group-max">											
											<label class="control-label" style="width: 130px;" for="newpass1">New password</label>
											<div class="controls">
											  <input class="span6" style="width: 85%;" name="newpass1" id="newpass1" type="password">
											</div>			
										  </div>
										</div>
										<div class="control-flex">
										  <div class="control-group-max">											
											<label class="control-label" style="width: 130px;" for="newpass2">Confirm password</label>
											<div class="controls">
											  <input class="span6" style="width: 85%;" name="newpass2" id="newpass2" type="password">
											</div>		
										  </div>
										</div>
										<div class="form-actions">
										  <div class="control-group" style="margin-bottom: 0px;">											
											<div class="controls" style="margin-right: 30px;"> 
											  <button class="btn btn-inverse" onclick="updatePassword()">Save</button> 
											</div>		
										  </div>	
										</div>
									  </fieldset>
									</form>
                                  </div>
                                </div>
                              </div>
							  <div class="accordion-group">
                                <div class="accordion-heading">
                                  <a class="accordion-toggle" style="font-weight: bold;font-size: 15px;border: 1px solid;" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                    Edit profile info
                                  </a>
                                </div>
                                <div id="collapseThree" class="accordion-body collapse" style="height: 0px;">
                                  <div class="accordion-inner text-center" style="background-color: #efefef;">
									<form  <?php echo $usershow;?> class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
									  <fieldset>
									    <div class="control-flex">
										  <div class="control-group">											
											<label class="control-label" for="fname">Firstname</label>
											<div class="controls">
											  <input class="span6" name="fname" id="fname" value="<?php echo $firstname;?>" onkeyup="restrict('fname')" type="text">
											</div>			
										  </div>
										  <div class="control-group">											
											<label class="control-label" for="lname">Lastname</label>
											<div class="controls">
											  <input class="span6" name="lname" id="lname" value="<?php echo $lastname;?>" onkeyup="restrict('lname')" type="text">
											</div>		
										  </div>
										</div>
										<div class="form-actions">
										  <div class="control-group" style="margin-bottom: 0px;">											
											<div class="controls" style="margin-right: 30px;"> 
											  <button class="btn btn-inverse" onclick="updateFLnames()">Update</button> 
											</div>		
										  </div>	
										</div>
									  </fieldset>
									</form>
									<form  <?php echo $userhide;?> class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
									  <fieldset>
									    <div class="control-flex">
										  <div class="control-group">											
											<label class="control-label" for="companyname">Company name</label>
											<div class="controls">
											  <input class="span6" name="companyname" value="<?php echo $company_name;?>" id="companyname" type="text">
											</div>			
										  </div>
										  <div class="control-group">											
											<label class="control-label" for="url">Website URL</label>
											<div class="controls">
											  <input class="span6" name="url" value="<?php echo $company_website_url;?>" id="url" type="text">
											</div>		
										  </div>
										</div>
										<div class="form-actions">
										  <div class="control-group" style="margin-bottom: 0px;">											
											<div class="controls" style="margin-right: 30px;"> 
											  <button class="btn btn-inverse" onclick="updateCname()">Update</button> 
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
				</div>
			  </div>
			</div>
		  </div>		   
<!------------------------------------------------------------------------------------------------------------------------------>
		</div>
	  </div>
	</div>  
  </div>
<div id="shortlist_initiator"></div>
<br /><br /><br /><br />
<?php include_once("_ext/dashboard_footer.php");?>
<?php include_once("_ext/popup_changedp.php");?>
<?php include_once("_ext/popup_jobpost.php");?>
<?php include_once("_ext/popup_company-profile.php");?>
<?php include_once("_ext/popup_seeker-profile.php");?>
<!---------------------------------------------------------------------------->
<?php include_once("_ext/default_js.php");?>
<?php include_once("_ext/popup_add-requirements.php");?>
<?php include_once("_ext/dashboard_owlphin-box.php");?>
<script type="text/javascript">
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "phone"){
		rx = /[^0-9.]/gi;
	}else if(elem == "fname"){
		rx = /[^a-z-]/gi;
	}else if(elem == "lname"){
		rx = /[^a-z-]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function addContact(){
	var num = _("phone").value;
	if(num != ""){
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "update_failed"){
					Alert.render("Phone number update was unsuccessful. Please try again later.");
				}else {
					$("#showphone").html(ajax.responseText);
					document.getElementById("phone").value = "";
					Success.render("Phone number was updated");
				}
	        }
        }
		ajax.send("action=num_update&num="+encodeURIComponent(num));
	}else{
		Hint.render('Please enter phone number');
		return false;
	}	
}
function updatePassword(){
	Confirm.render("You will need to re-login after changing of your password. Do you want to proceed?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var op = _("oldpass").value;
		var np1 = _("newpass1").value;
		var np2 = _("newpass2").value;
		if(op == "" || np1 == "" || np2 == ""){
			Hint.render('Please enter passwords');
		} else if(np1 != np2){
			Hint.render('Your new passwords do not match');
		} else {
			document.getElementById("changepassloader").style.display = 'block';
			var ajax = ajaxObj("POST", "_parse/_all_edits.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					if(ajax.responseText != "security_success"){
						Alert.render(ajax.responseText);
						document.getElementById("changepassloader").style.display = 'none';
					} else {
						Success.render("Password changed");
						owlphinhome();
						document.getElementById("changepassloader").style.display = 'none';
					}
				}
			}
			ajax.send("action=pass_update&op="+encodeURIComponent(op)+"&np1="+encodeURIComponent(np1)+"&np2="+encodeURIComponent(np2));
		}
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		document.getElementById("oldpass").value = "";
		document.getElementById("newpass1").value = "";
		document.getElementById("newpass2").value = "";
	}
}
function updateFLnames(){
	var fname = _("fname").value;
	var lname = _("lname").value;
	if(fname == "" || lname == ""){
		Hint.render('Form is missing values');
	}else if(!fname.replace(/\s/g, '').length || !lname.replace(/\s/g, '').length){
		Hint.render('Form is missing values');
	}else{
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "update_failed"){
					Alert.render("Update was unsuccessful. Please try again later.");
				}else {
					document.getElementById("fname").value = "";
					document.getElementById("lname").value = "";
					Success.render("Profile info was updated");
				}
	        }
        }
		ajax.send("action=fln_update&fname="+encodeURIComponent(fname)+"&lname="+encodeURIComponent(lname));
	}	
}
function updateCname(){
	var cname = _("companyname").value;
	var url = _("url").value;
	if(cname == "" || url == ""){
		Hint.render('Form is missing values');
	}else if(!cname.replace(/\s/g, '').length || !url.replace(/\s/g, '').length){
		Hint.render('Form is missing values');
	}else{
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "update_failed"){
					Alert.render("Update was unsuccessful. Please try again later.");
				}else {
					document.getElementById("companyname").value = "";
					document.getElementById("url").value = "";
					Success.render("Profile info was updated");
				}
	        }
        }
		ajax.send("action=cn_update&cname="+encodeURIComponent(cname)+"&url="+encodeURIComponent(url));
	}	
}
</script>
</body>
</html>