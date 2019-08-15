<?php 
include_once("_sys/check_login_status.php");
if($user_ok == true){
	header("location: sync&".$_SESSION["user_hash"]);
    exit();
}
?><?php
if(isset($_POST["e"])){	
	$_SESSION['e'] = $email = mysqli_real_escape_string($db_connection, $_POST['e']);
	$_SESSION['p1'] = $pass = $_POST['p1'];
	$sql = "SELECT id FROM user_account WHERE email='$email'";
    $query = mysqli_query($db_connection, $sql); 
	$e_check1 = mysqli_num_rows($query);
	$userstring1 = "";
	if($email == "" || $pass == ""){
		echo 'Form submission is missing values';
        exit();
	} else if ($e_check1 > 0){ 
        echo 'Email address is already in use';
        exit();
	} else if (strlen($pass) < 6) {
        echo "Password is too short. Try 6 or more characters";
        exit(); 
    } else {		
		$p_hash = md5($pass);
		$userstring1 .= "success|$email|$p_hash|||";
		$userstring1 = trim($userstring1, "|||");
		echo $userstring1;
		exit();
	}
	exit();
}
?><?php
if(isset($_POST["role"])  && isset($_POST["email"])){	
	$_SESSION['role'] = $role = $_POST['role'];
	$e = mysqli_real_escape_string($db_connection, $_POST['email']);
	$p = $_POST['p'];
	$userstring2 = "";
	if($role == "" || $e == "" || $p == ""){
		echo 'An unknown error occured';
        exit();
	} else {		
		$userstring2 .= "success|$e|$p|$role|||";
		$userstring2 = trim($userstring2, "|||");
		echo $userstring2;
		exit();
	}
	exit();
}
?><?php
if(isset($_POST["eo"]) && isset($_POST["pwd"])){	
	$_SESSION['eo'] = $eo = mysqli_real_escape_string($db_connection, $_POST['eo']);
	$_SESSION['pwd'] = $po = $_POST['pwd'];
	$_SESSION['userrole'] = $userrole = $_POST['userrole'];
	
	$_SESSION['fo'] = $fo = preg_replace('#[^a-z ]#i', '', $_POST['fo']);
	$_SESSION['lo'] = $lo = preg_replace('#[^a-z ]#i', '', $_POST['lo']);
	$_SESSION['go'] = $go = preg_replace('#[^a-z ]#i', '', $_POST['go']);
	$_SESSION['dob'] = $dob = $_POST['dob'];
	
	$_SESSION['uni'] = $uni = $_POST['uni'];
	$_SESSION['major'] = $major = $_POST['major'];
	$_SESSION['degree'] = $degree = $_POST['degree'];
	$_SESSION['cgpa'] = $cgpa = preg_replace('#[^0-9.]#i', '', $_POST['cgpa']);
	$_SESSION['fr'] = $fr = $_POST['fr'];
	$_SESSION['to'] = $to = $_POST['to'];
	
	$_SESSION['job_nm'] = $job_nm = $_POST['job_nm'];
	$_SESSION['job_company'] = $job_company = $_POST['job_company'];
	$_SESSION['job_spec'] = $job_spec = $_POST['job_spec'];
	$_SESSION['bb_stream'] = $bb_stream = $_POST['bb_stream'];
	$_SESSION['start_dt'] = $start_dt = $_POST['start_dt'];
	$_SESSION['end_dt'] = $end_dt = $_POST['end_dt'];
	if(isset($_POST["current_job"])){
		$_SESSION['current_job'] = $current_job = $_POST['current_job'];
		$end_dt = date("Y-m-d H:i:s", strtotime("now"));
	}else{
		$current_job = '0';
	}

    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	$eo_hash = md5($eo);
	
	$sql = "SELECT id FROM user_account WHERE email='$eo'";
    $query = mysqli_query($db_connection, $sql); 
	$e_check3 = mysqli_num_rows($query);

	if($fo == "" || $eo == "" || $po == "" || $userrole == "" || $lo == ""){
		echo 'The form submission is missing values';
        exit();
	}else if ($e_check3 > 0){ 
        echo 'Email address is already in use';
        exit();
	}else {
		$sql = "INSERT INTO user_account (e_hash, user_type ,email, password, registration_date, ip)       
		        VALUES('$eo_hash','$userrole','$eo','$po',now(),'$ip')";
		$query = mysqli_query($db_connection, $sql); 
		$uid = mysqli_insert_id($db_connection);
		
		$sql = "INSERT INTO seeker_profile (user_account_id, e_hash, firstname, lastname, date_of_birth, gender, seeker_bio) VALUES ('$uid','$eo_hash','$fo','$lo','$dob','$go',' ')";
		$query = mysqli_query($db_connection, $sql);
		
		$sql = "INSERT INTO education_detail (e_hash, certificate_degree_name, major, institute_university_name, starting_date, completion_date, cgpa, postdate) VALUES ('$eo_hash','$degree','$major','$uni','$fr','$to','$cgpa',now())";
		$query = mysqli_query($db_connection, $sql);
		
		if($job_nm != "" || $job_company != "" || $bb_stream != "" || $start_dt != ""){
			$sql = "INSERT INTO experience_detail (e_hash, is_current_job, job_title, job_specialization, company_name, business_stream, start_date, date_date, postdate) VALUES ('$eo_hash','$current_job','$job_nm','$job_spec','$job_company','$bb_stream','$start_dt','$end_dt',now())";
			$query = mysqli_query($db_connection, $sql);
		}
		$sql_note = "INSERT INTO notifications (note_type, e_hash, note, date_time) 
										VALUES (
												'a',
												'$eo_hash',
												'Hello $fo. Thanks for joining Owlphin. We hope you get excited when you consider the possibilities of landing your dream job. We can not wait for you to get started. You might want to start by:<br>- Tailoring your Profile <br> Your profile is a virtual representation of your physical CV. Make a good one.',
												now())";
		$query = mysqli_query($db_connection, $sql_note);
		
		if (!file_exists("_USER/$eo_hash")) {
			mkdir("_USER/$eo_hash", 0755);
		}	
		copy("_USER/index.php","_USER/$eo_hash/index.php");
		
		/* $to = "$eo";							 
		$from = "bacsyd-noreply@bacsyd.com";
		$subject = 'Bacsyd Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
		$message .= '<span style="font-size:16px;">Hi '.$fo.',<br /><br />Looks like this was the right email. :)<br /><br />';
		$message .= 'Next, please confirm your email address and activate your account by either clicking on the link below or using your activation string.<br /><br /><br />';
		$message .= '<div style="padding: 20px;background-color: rgb(217, 226, 245);"><a href="http://www.bacsyd.com/activation.php?id='.$uid.'&e='.$eo.'&e_hash='.$eo_hash.'&p='.$po.'">Click here to activate your account now</a></div><br />';
		$message .= '<div style="padding: 20px;background-color: rgb(217, 216, 245);">Activation string: <br /> '.$eo_hash.'</div>';
		$message .= '<br /><br /><br /><b>Bacsyd Team</b></span></body></html>';

		$headers = "From: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Reply-To: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Return-Path: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "CC: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "BCC: bacsyd-noreply@bacsyd.com\r\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers); */
		
		echo "seeker_success";
		exit();
	}
	echo "seeker_failed";
	exit();
}
?><?php
if(isset($_POST["r_eo"]) && isset($_POST["r_pwd"]) && isset($_POST["r_userrole"])){
	$_SESSION['r_eo'] = $r_eo = mysqli_real_escape_string($db_connection, $_POST['r_eo']);
	$_SESSION['r_pwd'] = $r_pwd = $_POST['r_pwd'];
	$_SESSION['r_userrole'] = $r_userrole = $_POST['r_userrole'];
	
	$_SESSION['company_name'] = $company_name = $_POST['company_name'];
	$_SESSION['company_url'] = $company_url = $_POST['company_url'];
	$_SESSION['b_stream'] = $b_stream = $_POST['b_stream'];
	$_SESSION['comp_email'] = $comp_email = $_POST['comp_email'];
	$_SESSION['comp_contact'] = $comp_contact = $_POST['comp_contact'];
	
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	$r_eo_hash = md5($r_eo);
	
	$sql = "SELECT id FROM user_account WHERE email='$r_eo'";
    $query = mysqli_query($db_connection, $sql); 
	$e_check4 = mysqli_num_rows($query);

	if($r_eo == "" || $company_name == "" || $b_stream == "" || $comp_contact == ""){
		echo 'The form submission is missing values';
        exit();
	}else if ($e_check4 > 0){ 
        echo 'Email address is already in use';
        exit();
	}else{
		$sql = "INSERT INTO user_account (e_hash, user_type ,email, password, contact_number, registration_date, ip)       
		        VALUES('$r_eo_hash','$r_userrole','$r_eo','$r_pwd','$comp_contact',now(),'$ip')";
		$query = mysqli_query($db_connection, $sql); 
		$oid = mysqli_insert_id($db_connection);
		
		$sql = "INSERT INTO company_profile (company_account_id, e_hash, company_name, business_stream_name, company_website_url) VALUES ('$oid','$r_eo_hash','$company_name','$b_stream','$company_url')";
		$query = mysqli_query($db_connection, $sql);
		
		$_note = "INSERT INTO notifications (note_type, e_hash, note, date_time) 
										VALUES (
												'a',
												'$r_eo',
												'Hello $company_name. Thanks for joining Owlphin. We hope you get excited when you consider the possibilities of landing the best employees. We can not wait for you to get started. You might want to start by:<br>- Posting a Job',
												now())";
		$query = mysqli_query($db_connection, $_note);
		
		if (!file_exists("_USER/$r_eo_hash")) {
			mkdir("_USER/$r_eo_hash", 0755);
		}	
		copy("_USER/index.php","_USER/$r_eo_hash/index.php");
		
		/* $to = "$r_eo";							 
		$from = "bacsyd-noreply@bacsyd.com";
		$subject = 'Bacsyd Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
		$message .= '<span style="font-size:16px;">Hi there,<br /><br />Looks like this was the right email. :)<br /><br />';
		$message .= 'Next, please confirm your email address and activate your account by either clicking on the link below or using your activation string.<br /><br /><br />';
		$message .= '<div style="padding: 20px;background-color: rgb(217, 226, 245);"><a href="http://www.bacsyd.com/activation.php?id='.$oid.'&e='.$r_eo.'&e_hash='.$r_eo_hash.'&p='.$r_pwd.'">Click here to activate your account now</a></div><br />';
		$message .= '<div style="padding: 20px;background-color: rgb(217, 216, 245);">Activation string: <br /> '.$r_eo_hash.'</div>';
		$message .= '<br /><br /><br /><b>Bacsyd Team</b></span></body></html>';

		$headers = "From: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Reply-To: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "Return-Path: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "CC: bacsyd-noreply@bacsyd.com\r\n";
		$headers .= "BCC: bacsyd-noreply@bacsyd.com\r\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers); */
		
		echo "recruiter_success";
		exit();
	}
	
}
?><?php
if(isset($_POST['action']) && $_POST['action'] == "activate_account"){	
	$at_eo = mysqli_real_escape_string($db_connection, $_POST['e_mail']);
	$seeker_code = $_POST['code'];
	$seeker_pass = $_POST['passwd'];
	if($at_eo == "" || $seeker_code == ""){
		echo "activate_failed";
    	exit(); 
	}else{
		$at_eo_hash = md5($at_eo);
		$sql = "SELECT e_hash FROM user_account WHERE e_hash='$at_eo_hash' AND email='$at_eo' LIMIT 1";
		$query = mysqli_query($db_connection, $sql);
		$row = mysqli_fetch_row($query);
		$email_hash = $row[0];
		$numrows = mysqli_num_rows($query);
		if($numrows == 0){
			echo "activate_failed";
			exit(); 
		}
		if($email_hash != $seeker_code){
			echo "activate_failed";
			exit(); 
		}else{
			$log_sql = "SELECT id, e_hash, password FROM user_account WHERE BINARY e_hash = BINARY '$at_eo_hash' LIMIT 1";
			$log_query = mysqli_query($db_connection, $log_sql);
			$row = mysqli_fetch_row($log_query);
			$db_id = $row[0];
			$db_ehash = $row[1];
			$db_pass_str = $row[2];
			if($seeker_pass != $db_pass_str){
				echo "activate_failed";
				exit();
			} else {
				$_SESSION['userid'] = $db_id;
				$_SESSION['user_hash'] = $db_ehash;
				$_SESSION['password'] = $db_pass_str;
				setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
				setcookie("e_hash", $db_ehash, strtotime( '+30 days' ), "/", "", "", TRUE);
				setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE);

				$osql = "UPDATE user_account SET activated='1', registration_date=now() WHERE e_hash='$db_ehash' LIMIT 1";
				$query = mysqli_query($db_connection, $osql);
				echo $db_ehash;
				exit();
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Join Owlphin now</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.login-register-reset.css" rel="stylesheet">
</head>
<body class="register-background">
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container"> 
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		  </a>
		  <a class="brand"  href="javascript:void(0)" onclick="owlphinhome()">
			<img src="_img/owlphin_log.png" style="height:30px;" />
			<span></span>
		  </a>
		  <div class="nav-collapse" id="hideloginbtn">
			<form class="navbar-search" action="login">
			  <ul class="nav pull-right mobile-no-show">
			    <li><button class="btn btn-inverse" onclick="login()">Already have an account? Sign in</button></li>
			  </ul>
			</form>
		  </div>
		</div>
	</div> 
</div>
<div id="registerform" style="display:;">
	<div class="account-container register">
	  <div id="showloader1" class="div-loader-cover"><div class="spinner"></div></div>
	  <div class="content clearfix">	
		<form role="form" method="post" onSubmit="return false;">
		  <div class="register-logo">
			<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>
			<h2>Let's get started</h2>	
			<span id="status1"><h5 style="font-size: 14px;font-weight: initial;color: #747171;">Over 10,000 people have landed jobs here</h5></span>
		  </div>		
		  <div class="login-fields">
			<div class="field" style="margin-bottom: 0em;">
			  <input type="text" id="email" name="email" placeholder="Email address" onblur="emailValidation()" onkeyup="restrict('email')" onfocus="emptyElement('status1')" />
			</div>
			<div class="login-extra" style="margin-bottom: 0;margin-top: 0;">
			  <p class="text-center" style="font-size:10px;">Please enter an active email address</p>				
		    </div>
			<div class="field">
			  <input type="password" id="pass1" name="pass1" placeholder="Password" onfocus="emptyElement('status1')" maxlength="40" onpaste="return false" />
			</div>
			<div class="field">
			  <input type="password" id="pass2" name="pass2" placeholder="Confirm Password" onfocus="emptyElement('status1')" maxlength="40" onpaste="return false" />
			</div>	
			<div class="login-actions">	
			  <button style="margin-top:10px;" class="button btn btn-inverse btn-large" onclick="nextone()">Join now</button>
			</div>
			<div class="login-extra" style="margin-top: 4em;">
			  <a href="javascript:void(0)" onclick="login()">Already have an account? Sign in</a> 
		    </div>
		  </div>
		</form>	
	  </div>
	</div>
</div>

<div class="footer mobile-no-show" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
<script type="text/javascript">
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	}else if(elem == "fname"){
		rx = /[^a-z-]/gi;
	}else if(elem == "lname"){
		rx = /[^a-z-]/gi;
	}else if(elem == "cgpa"){
		rx = /[^0-9.]/gi;
	}else if(elem == "comp_contact"){
		rx = /[^0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	if(x == "status1"){
		_(x).innerHTML = '<h5 style="font-size: 14px;font-weight: initial;color: #747171;">Over 10,000 people have landed jobs here</h5>';
	}else if(x == "status2"){
		_(x).innerHTML = "";
	}else if(x == "status7"){
		_(x).innerHTML = "We will send you an email with your activation information, in a couple of minutes. <br />NOTE: You need to activate your account in order to use our system.";
	}else{
		_(x).innerHTML = "";
	}
}
function toggleElement(x){
	if (x.checked) {
    _("end_dt").style.display = "none";
  } else {
    _("end_dt").style.display = "block";
  }
}
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function emailValidation() {
  var e = _("email").value;
  if (!validateEmail(e)) {
	_("email").style.borderColor = "red";
  }
  return false;
}
function nextone(){
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var status1 = _("status1");
	if(e == "" || p1 == "" || p2 == ""){
		status1.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!e.replace(/\s/g, '').length){
		status1.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!validateEmail(e)){
		status1.innerHTML = '<h5><div class="alert">Your email is invalid</div></h5>';
	}else if(p1 != p2){
		status1.innerHTML = '<h5><div class="alert">Your passwords do not match</div></h5>';;
	}else {
		_("showloader1").style.display = "block";
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var ustring = ajax.responseText.split("|||");
				for (var i = 0; i < ustring.length; i++){
					var string = ustring[i].split("|");		
				}		
				var text = string[0];
				var email = string[1];
				var pass = string[2];
	            if(text != "success"){
					_("showloader1").style.display = "none";
					status1.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
				} else {
					_("hideloginbtn").innerHTML = '<ul class="nav pull-right"><li><button class="btn btn-inverse" onclick="register()">Cancel</button></li></ul>';
					window.scrollTo(0,0);	
					_("registerform").innerHTML = '	<div class="account-container register">'+
												'<div id="showloader2" class="div-loader-cover"><div class="spinner"></div></div>'+
												'<div class="content clearfix">'+
												'<form role="form" method="post" onSubmit="return false;">'+
												'  <div class="register-logo">'+
												'	 <span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
												'	 <h3>Let\'s know your role</h3>'+
												'	  <span id="status2"></span>'+
												'   </div>'+		
												'<div class="login-fields">'+
												'  <div class="field">'+
												'	  <input type="radio" name="user_role" checked id="none" value="none" style="visibility:hidden;">'+
												'	  <label class="rcontainer">Sign up as a Job Seeker'+
												'		<input type="radio" name="user_role" id="seeker" value="seeker" onfocus="emptyElement(\'status2\')">'+
												'		<span class="checkmark"></span>'+
												'	  </label>'+
												'	  <label class="rcontainer">Sign up as a Recruiter'+
												'		<input type="radio" name="user_role" id="recruiter" value="recruiter" onfocus="emptyElement(\'status2\')">'+
												'		<span class="checkmark"></span>'+
												'	  </label>'+
												'	</div>'+
												'	<div class="login-actions">'+	
												'	  <button class="button btn btn-inverse btn-large" onclick="nexttwo(\''+email+'\',\''+pass+'\')">Continue</button>'+
												'	</div>'+
												'</div></form></div></div>';		
				}
	        }
        }
      ajax.send("e="+e+"&p1="+encodeURIComponent(p1));
	}
}
function nexttwo(email,pass){
	var role = document.querySelector('input[name = "user_role"]:checked').value;
	var status2 = _("status2");
	if(role == "none"){
		status2.innerHTML = '<h5><div class="alert">Please select an option</div></h5>';
	}else{
		_("showloader2").style.display = "block";
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var ustring = ajax.responseText.split("|||");
				for (var i = 0; i < ustring.length; i++){
					var string = ustring[i].split("|");		
				}		
				var text = string[0];
				var e = string[1];
				var p = string[2];
				var userrole = string[3];
	            if(text != "success"){
					_("showloader2").style.display = "none";
					status1.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
				} else {
					_("showloader2").style.display = "block";
					if(userrole == "seeker"){
					window.scrollTo(0,0);	
					_("registerform").innerHTML = '	<div class="account-container register">'+
												  '<div id="seekerloader1" class="div-loader-cover"><div class="spinner"></div></div>'+
												  '<div class="content clearfix">'+
													'<form role="form" method="post" onSubmit="return false;">'+
													 ' <div class="register-logo">'+
														'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
														'<h3>Tell us about yourself</h3>'+
														'<span id="status3"></span>'+
													  '</div>'+			  
													  '<div class="login-fields">'+
														'<div class="field">'+
														 ' <input type="text" id="fname" name="fname" placeholder="Firstname" onkeyup="restrict(\'fname\')" onfocus="emptyElement(\'status3\')" />'+
														'</div>'+
														'<div class="field">'+
														 ' <input type="text" id="lname" name="lname" placeholder="Lastname" onkeyup="restrict(\'lname\')" onfocus="emptyElement(\'status3\')" />'+
														'</div>'+
														'<div class="field">'+
														 ' <select style="border:1px solid #686868;" name="gender" id="gender" onfocus="emptyElement(\'status3\')">'+
															'<option Selected disabled>Gender:</option>'+
															'<option value="m">Male</option>'+
															'<option value="f">Female</option>'+
														  '</select>'+
														'</div>'+
														'<div class="field">'+
														 ' <label class="text-center" for="dob">Date of Birth:</label>'+
														  '<input type="date" id="dob" max="2001-01" name="dob" placeholder="Date of Birth:" onfocus="emptyElement(\'status3\')" required />'+
														'</div>'+
														'<div class="login-actions">	'+
														'  <button class="button btn btn-inverse btn-large" onclick="seeker1(\''+e+'\',\''+p+'\',\''+userrole+'\')">Continue</button>'+
														'</div>'+
													  '</div></form></div></div>';	
					}else if(userrole == "recruiter"){
						window.scrollTo(0,0);	
						_("registerform").innerHTML = '	<div class="account-container-larger register">'+
													  '<div id="recruiterloader1" class="div-loader-cover"><div class="spinner"></div></div>'+
													  '<div class="content clearfix">'+	
														'<form role="form" method="post" onSubmit="return false;">'+
														 ' <div class="register-logo">'+
															'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
															'<h3>Tell us about your company</h3>'+
															'<span id="status6"></span>'+
														 ' </div>'+			  
														  '<div class="login-fields">'+
															'<div class="field">'+
															 ' <input class="max" type="text" id="company_name" name="company_name" placeholder="Company name" onfocus="emptyElement(\'status6\')" />'+
															'</div>'+
															'<div class="field-flex">'+
															 ' <input type="text" id="company_url" name="company_url" placeholder="Company website URL - Optional" onfocus="emptyElement(\'status6\')" />'+
															  ' <select class="margin" style="border:1px solid #686868;" name="b_stream" id="b_stream" onfocus="emptyElement(\'status6\')">'+
																'<option Selected disabled>Industry:</option>'+
																  '<option value="Agriculture/Poultry/Fishing">Agriculture/Poultry/Fishing</option><option value="Banking / Financial Services">Banking / Financial Services</option>'+
																	'<option value="Construction / Real Estate">Construction / Real Estate</option><option value="Consulting">Consulting</option><option value="Creatives/Art/Design">Creatives/Art/Design</option>'+
																	'<option value="Ecommerce/Internet">Ecommerce/Internet</option><option value="Education">Education</option><option value="Engineering">Engineering</option>'+
																	'<option value="FMCG">FMCG</option><option value="Food">Food Services</option><option value="Government / Defence">Government / Defence</option>'+
																	'<option value="Healthcare">Healthcare</option><option value="Hospitality/Leisure">Hospitality/Leisure</option><option value="ICT / Telecommunications">ICT / Telecommunications</option>'+
																	'<option value="Insurance">Insurance</option><option value="Legal">Legal</option><option value="Logistics / Transportation">Logistics / Transportation</option>'+
																	'<option value="Manufacturing / Production">Manufacturing / Production</option><option value="Media">Media</option><option value="NGO">NGO</option>'+
																	'<option value="Oil & Gas / Mining">Oil &amp; Gas / Mining</option><option value="Power/Energy">Power/Energy</option><option value="Retail / Wholesales">Retail / Wholesales</option>'+
																	'<option value="Trade / Services">Trade / Services</option><option value="Travels/Tours">Travels/Tours</option><option value="Blue Collar">Blue Collar</option>'+
															  '</select>'+
															'</div>'+
															'<div class="field-flex">'+
															 ' <div>'+
															  '<label class="text-center" for="comp_contact">Telephone number:</label>'+
															  '<input type="text" id="comp_contact" name="comp_contact" placeholder="000-0000-000 " onkeyup="restrict(\'comp_contact\')" onfocus="emptyElement(\'status6\')" maxlength="10" />'+
															 ' </div>'+
								 							' <div class="margin">'+
															 ' <label class="text-center grey-out" for="comp_email">Alternative email address:</label>'+
															  '<input type="email" id="comp_email" name="comp_email" style="border-color:white;" placeholder="(Disabled)" onfocus="emptyElement(\'status6\')" disabled />'+
															 ' </div>'+
															'</div>'+
															'<div class="login-actions">'+		
															  '<button class="button btn btn-inverse btn-large" onclick="recruiter1(\''+e+'\',\''+p+'\',\''+userrole+'\')">Continue</button>'+
															'</div>'+
														  '</div></form></div></div>';	
					}	
				}
	        }
        }
      ajax.send("role="+role+"&email="+encodeURIComponent(email)+"&p="+encodeURIComponent(pass));
	}
}
function seeker1(email,pass,role){
    var f = _("fname").value;
	var l = _("lname").value;
	var g = _("gender").value;
	var dob = _("dob").value;
	var status3 = _("status3");
	if(f == "" || l == "" || g == "Gender:" || dob == ""){
		status3.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!f.replace(/\s/g, '').length || !l.replace(/\s/g, '').length || !g.replace(/\s/g, '').length){
		status3.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	} else {
		window.scrollTo(0,0);	
		_("registerform").innerHTML = '<div class="account-container-larger register">'+
							'<div id="seekerloader2" class="div-loader-cover"><div class="spinner"></div></div>'+
							'<div class="content clearfix">'+	
								'<form role="form" method="post" onSubmit="return false;">'+
								' <div class="register-logo">'+
									'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
									'<h3>Tell us about your highest level of education</h3>'+	
									'<span id="status4"></span>'+
								'</div>'+			  
								'<div class="login-fields">'+
								'<div class="field">'+
								' <input class="max" type="text" id="uni" name="uni" placeholder="School or Institute" onfocus="emptyElement(\'status4\')" />'+
								'</div>'+
								'<div class="field-flex">'+
								' <input type="text" id="major" name="major" placeholder="Field of study" onfocus="emptyElement(\'status4\')" />'+
								 ' <select class="margin" style="border:1px solid #686868;" name="degree" id="degree" onfocus="emptyElement(\'status4\')">'+
										'<option Selected disabled>Degree:</option>'+
										'<option value="Diploma degree">Diploma degree</option>'+
										'<option value="Bachelor/s degree">Bachelor\'s degree</option>'+
										'<option value="Doctor of Education - EdD">Doctor of Education - EdD</option>'+
										'<option value="Doctor of Law - JD">Doctor of Law - JD</option>'+
										'<option value="Master/s degree">Master\'s degree</option>'+
										'<option value="Engineer/s degree">Engineer\'s degree</option>'+
										'<option value="Doctor of Philosophy - phD"> Doctor of Philosophy - phD</option>'+
										'<option value="Other">Other</option>'+
									'</select>'+
								'</div>'+
								'<div class="field-flex">'+
								 '<input type="text" id="cgpa" name="cgpa" placeholder="CGPA (optional)" onkeyup="restrict(\'cgpa\')"  onfocus="emptyElement(\'status4\')" />'+
								 ' <input class="margin disabled" type="text" id="pecentage" name="pecentage" placeholder="Grade (disabled)" style="border-color: rgba(255, 255, 255, 0.8);" disabled/>'+
								 '</div>'+
								 '<div class="field-flex">'+
								  ' <select style="border:1px solid #686868;" name="start_date" id="start_date" onfocus="emptyElement(\'status4\')">'+
										'<option Selected disabled>From year:</option>'+
										  '<option value="2026">2026</option><option value="2025">2025</option><option value="2024">2024</option><option value="2023">2023</option>'+
										  '<option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option>'+
										  '<option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option>'+
										  '<option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option>'+
										  '<option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option>'+
										  '<option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option>'+
										  '<option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option>'+
										  '<option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option>'+
										  '<option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option>'+
										  '<option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>'+
										  '<option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option>'+
										  '<option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option>'+
										  '<option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option>'+
										  '<option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option>'+
										  '<option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option>'+
										  '<option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option>'+
										  '<option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option>'+
									'</select>'+
									' <select class="margin" style="border:1px solid #686868;" name="end_date" id="end_date" onfocus="emptyElement(\'status4\')">'+
										'<option Selected disabled>To year (or expected):</option>'+
										  '<option value="2026">2026</option><option value="2025">2025</option><option value="2024">2024</option><option value="2023">2023</option>'+
										  '<option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option>'+
										  '<option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option>'+
										  '<option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option>'+
										  '<option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option>'+
										  '<option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option>'+
										  '<option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option>'+
										  '<option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option>'+
										  '<option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option>'+
										  '<option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>'+
										  '<option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option>'+
										  '<option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option>'+
										  '<option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option>'+
										  '<option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option>'+
										  '<option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option>'+
										  '<option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option>'+
										  '<option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option>'+
									'</select>'+
								  '</div>'+
								 '<div class="login-actions">	'+			
								 ' <button class="button btn btn-inverse btn-large" onclick="seeker2(\''+email+'\',\''+pass+'\',\''+role+'\',\''+f+'\',\''+l+'\',\''+g+'\',\''+dob+'\')">Continue</button>'+
								 '</div>'+
								// '<div class="login-extra" style="margin: 3em auto -25px auto;"><br>'+
								 // ' <a href="javascript:void(0)">I\'m a Student</a>'+ 
								 // '</div>'+
								'</div></form></div></div>';	
	}
}
function seeker2(email,pass,role,f,l,g,dob){
    var uni = _("uni").value;
	var major = _("major").value;
	var degree = _("degree").value;
	var cgpa = _("cgpa").value;
	var fr = _("start_date").value;
	var to = _("end_date").value;
	var status4 = _("status4");
	if(uni == "" || major == ""){
		status4.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!uni.replace(/\s/g, '').length || !major.replace(/\s/g, '').length){
		status4.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(fr >= to){
		status4.innerHTML = '<h5><div class="alert">Check and change the years of study</div></h5>';
	}  else {
		window.scrollTo(0,0);	
		_("registerform").innerHTML = '	<div class="account-container-larger register">'+
							  '<div id="seekerloader3" class="div-loader-cover"><div class="spinner"></div></div>'+
							  '<div class="content clearfix">'+	
								'<form role="form" method="post" onSubmit="return false;">'+
								 ' <div class="register-logo">'+
									'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
									'<h3>Tell us about your most recent job</h3>'+	
									'<span id="status5"></span>'+
								  '</div>'+			  
								  '<div class="login-fields">'+
									'<div class="field-flex">'+
									 ' <input type="text" id="job_nm" name="job_nm" placeholder="Job title (Example: Head Teacher)" onfocus="emptyElement(\'status5\')" />'+
									  ' <select class="margin" style="border:1px solid #686868;" name="job_spec" id="job_spec" onfocus="emptyElement(\'status5\')">'+
										'<option Selected disabled>Job specialization:</option>'+
										  '<option value="Administrative">Administrative</option><option value="Banking / Finance / Insurance">Banking / Finance / Insurance</option><option value="Building Design / Architecture">Building Design / Architecture</option>'+
										  '<option value="Construction / Building">Construction / Building</option><option value="Consulting/Business Strategy & Planning">Consulting/Business Strategy &amp; Planning</option><option value="Customer Service">Customer Service</option>'+
										  '<option value="Engineering">Engineering</option><option value="Executive / Top Management">Executive / Top Management</option><option value="Healthcare / Pharmaceutical">Healthcare / Pharmaceutical </option>'+
										  '<option value="Hospitality / Leisure / Travels">Hospitality / Leisure / Travels</option><option value="Human Resources">Human Resources</option><option value="Information Technology">Information Technology</option>'+
										  '<option value="Legal">Legal</option><option value="Manufacturing / Production">Manufacturing / Production</option><option value="Media / Public Relations / Advertising">Media / Public Relations / Advertising</option>'+
										  '<option value="Media/Journalism">Media/Journalism</option><option value="NGO">NGO</option><option value="Oil &amp; Gas">Oil &amp; Gas</option>'+
										  '<option value="Project Management">Project Management</option><option value="Real Estate / Property">Real Estate / Property</option><option value="Sales / Marketing / Bus. Dev.">Sales / Marketing / Bus. Dev.</option>'+
										  '<option value="Teaching / Education">Teaching / Education</option><option value="Telecommunications">Telecommunications</option>'+
									'</select>'+
									'</div>'+
									'<div class="field-flex">'+
									 '<input type="text" id="job_company" name="job_company" placeholder="Institute or Company name" onfocus="emptyElement(\'status5\')" />'+
									  ' <select class="margin" style="border:1px solid #686868;" name="bb_stream" id="bb_stream" onfocus="emptyElement(\'status5\')">'+
										'<option Selected disabled>Industry:</option>'+
										  '<option value="Agriculture / Poultry / Fishing">Agriculture / Poultry / Fishing</option><option value="Banking / Financial Services">Banking / Financial Services</option>'+
											'<option value="Construction / Real Estate">Construction / Real Estate</option><option value="Consulting">Consulting</option><option value="Creatives / Art / Design">Creatives / Art / Design</option>'+
											'<option value="Ecommerce / Internet">Ecommerce / Internet</option><option value="Education">Education</option><option value="Engineering">Engineering</option>'+
											'<option value="FMCG">FMCG</option><option value="Food">Food Services</option><option value="Government / Defence">Government / Defence</option>'+
											'<option value="Healthcare">Healthcare</option><option value="Hospitality / Leisure">Hospitality / Leisure</option><option value="ICT / Telecommunications">ICT / Telecommunications</option>'+
											'<option value="Insurance">Insurance</option><option value="Legal">Legal</option><option value="Logistics / Transportation">Logistics / Transportation</option>'+
											'<option value="Manufacturing / Production">Manufacturing / Production</option><option value="Media">Media</option><option value="NGO">NGO</option>'+
											'<option value="Oil & Gas / Mining">Oil &amp; Gas / Mining</option><option value="Power / Energy">Power / Energy</option><option value="Retail / Wholesales">Retail / Wholesales</option>'+
											'<option value="Trade / Services">Trade / Services</option><option value="Travels / Tours">Travels / Tours</option><option value="Blue Collar">Blue Collar</option>'+
									  '</select>'+
									'</div>'+
									'<div class="field-flex">'+
									 ' <div>'+
									  '<label class="text-center" for="start_dt">From:</label>'+
									 ' <input type="date" id="start_dt" name="start_dt" onfocus="emptyElement(\'status5\')" />'+
									  '</div>'+
									  '<div class="margin">'+
									  '<span style="display: inline-flex;" for="end_dt"><label class="text-center" for="end_dt" style="display: inline-flex;">To:</label> '+
									  '<input type="checkbox" style="width: 30px;margin-bottom: 7px;" id="current_job" name="current_job" onchange="toggleElement(this)"/><label for="current_job">I currently work here</label></span>'+
									  '<input type="date" id="end_dt" name="end_dt" onfocus="emptyElement(\'status5\')" />'+
									 ' </div>'+
									'</div>'+
									'<div class="login-actions">'+			
									 ' <button class="button btn btn-inverse btn-large" onclick="seeker3(\''+email+'\',\''+pass+'\',\''+role+'\',\''+f+'\',\''+l+'\',\''+g+'\',\''+dob+'\',\''+major+'\',\''+degree+'\',\''+cgpa+'\',\''+fr+'\',\''+to+'\',\''+uni+'\')">Continue</button>'+
									'</div>'+
									'<div class="login-extra" style="margin: 4em auto -25px auto;">'+
									  '<a href="javascript:void(0)" onclick="xpSkipped(\''+email+'\',\''+pass+'\',\''+role+'\',\''+f+'\',\''+l+'\',\''+g+'\',\''+dob+'\',\''+major+'\',\''+degree+'\',\''+cgpa+'\',\''+fr+'\',\''+to+'\',\''+uni+'\')">Skip for now</a> '+
									'</div>'+
								  '</div></form></div></div>';		
	}
}
function seeker3(email,pass,role,f,l,g,dob,major,degree,cgpa,fr,to,uni){
	var current_job_chkbx = _("current_job");
	var current_job = "0"; if(current_job_chkbx.checked){current_job = "1";} else{current_job = "0";}
    var job_nm = _("job_nm").value;
    var job_company = _("job_company").value;
	var job_spec = _("job_spec").value;
	var bb_stream = _("bb_stream").value;
	var start_dt = _("start_dt").value;
	var end_dt = _("end_dt").value;
	var status5 = _("status5");
	if(job_nm == "" || job_company == "" || job_spec == "Job specialization:" || bb_stream == "Industry:" || start_dt == ""){
		status5.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!job_nm.replace(/\s/g, '').length || !job_company.replace(/\s/g, '').length){
		status5.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(current_job == "0" && end_dt == ""){
		status5.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else {
		_("seekerloader3").style.display = "block";
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "seeker_success"){
					_("hideloginbtn").innerHTML = '';
					window.scrollTo(0,0);	
					_("registerform").innerHTML = '<div class="account-container register">'+
											  '<div id="seekerloader5" class="div-loader-cover"><div class="spinner"></div></div>'+
											  '<div class="content clearfix">'+	
												'<form role="form" method="post" onSubmit="return false;">'+
												 ' <div class="register-logo">'+
													'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
													'<h2>Hello '+f+'</h2>'+	
													'<p style="font-weight: lighter; font-size: 14px;" id="status7">We will send you an email with your activation information, in a couple of minutes. NOTE: You need to activate your account in order to use our system.</p>'+	
													''+
												  '</div>'+			  
												  '<div class="login-fields text-center">'+
													'<label class="text-center" for="code1">Activation string:</label>'+
													'<div class="field-flex">'+
													  '<input type="text" id="code1" name="code1" placeholder="" onfocus="emptyElement(\'status7\')" />'+
													'</div>'+
													'<div class="login-actions">'+	
													 ' <button class="button btn btn-inverse btn-large" onclick="activate1(\''+email+'\',\''+pass+'\')">Finish</button>'+
													'</div>'+
													'<div class="login-extra" style="margin: 4em auto -25px auto;">'+
													 ' <a href="javascript:void(0)" onclick="login()">I will do this later</a> '+
													'</div>'+
												 ' </div></form></div></div>';	
				} else {
					status5.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
				}
	        }
        }
      ajax.send("eo="+email+"&pwd="+encodeURIComponent(pass)+"&userrole="+role+"&fo="+f+"&lo="+l+"&go="+g+"&dob="+dob+"&major="+major+"&degree="+degree+"&cgpa="+cgpa+"&fr="+fr+"&to="+to+"&uni="+uni+"&job_nm="+job_nm+"&job_company="+job_company+"&job_spec="+job_spec+"&bb_stream="+bb_stream+"&start_dt="+start_dt+"&end_dt="+end_dt+"&current_job="+current_job);
	}
}
function xpSkipped(email,pass,role,f,l,g,dob,major,degree,cgpa,fr,to,uni){
	var job_nm = "";
    var job_company = "";
	var job_spec = "";
	var bb_stream = "";
	var start_dt = "";
	var end_dt = "";
	_("seekerloader3").style.display = "block";
	var ajax = ajaxObj("POST", "register.php");
    ajax.onreadystatechange = function() {
	    if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "seeker_success"){
				window.scrollTo(0,0);	
				_("registerform").innerHTML = '<div class="account-container register">'+
											  '<div id="seekerloader5" class="div-loader-cover"><div class="spinner"></div></div>'+
											  '<div class="content clearfix">'+	
												'<form role="form" method="post" onSubmit="return false;">'+
												 ' <div class="register-logo">'+
													'<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
													'<h2>Hello '+f+'</h2>'+	
													'<p style="font-weight: lighter; font-size: 14px;" id="status7">We will send you an email with your activation information, in a couple of minutes. NOTE: You need to activate your account in order to use our system.</p>'+	
													''+
												  '</div>'+			  
												  '<div class="login-fields text-center">'+
													'<div class="field-flex">'+
													  '<input type="text" id="code1" name="code1" placeholder="Activation string" onfocus="emptyElement(\'status7\')" />'+
													'</div>'+
													'<div class="login-actions">'+	
													 ' <button class="button btn btn-inverse btn-large" onclick="activate1(\''+email+'\',\''+pass+'\')">Finish</button>'+
													'</div>'+
													'<div class="login-extra" style="margin: 4em auto -25px auto;">'+
													 ' <a href="javascript:void(0)" onclick="login()">I will do this later</a> '+
													'</div>'+
												 ' </div></form></div></div>';	
			} else {
				status5.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
			}
	    }
    }
    ajax.send("eo="+email+"&pwd="+encodeURIComponent(pass)+"&userrole="+role+"&fo="+f+"&lo="+l+"&go="+g+"&dob="+dob+"&major="+major+"&degree="+degree+"&cgpa="+cgpa+"&fr="+fr+"&to="+to+"&uni="+uni+"&job_nm="+job_nm+"&job_company="+job_company+"&job_spec="+job_spec+"&bb_stream="+bb_stream+"&start_dt="+start_dt+"&end_dt="+end_dt);
}
function recruiter1(email,pass,role){
    var company_name = _("company_name").value;
	var company_url = _("company_url").value;
	var b_stream = _("b_stream").value;
	var comp_email = _("comp_email").value;
	var comp_contact = _("comp_contact").value;
	var status6 = _("status6");
	if(company_name == "" || b_stream == "Industry:" || comp_contact == ""){
		status6.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	}else if(!company_name.replace(/\s/g, '').length || !comp_contact.replace(/\s/g, '').length){
		status6.innerHTML = '<h5><div class="alert">Please fill out all of the form data</div></h5>';
	} else if(comp_contact.length <  10){
		status6.innerHTML = '<h5><div class="alert">Invalid contact number</div></h5>';
	}else {
		_("recruiterloader1").style.display = "block";
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "recruiter_success"){
					window.scrollTo(0,0);	
					_("registerform").innerHTML = '	<div class="account-container-larger register">'+
												   '<div id="recruiterloader2" class="div-loader-cover"><div class="spinner"></div></div>'+
												   '<div class="content clearfix">'+
													 '<form role="form" method="post" onSubmit="return false;">'+
													   '<div class="register-logo">'+
														 '<span><img src="_img/owlphin_log.png" style="width:55px;" /></span>'+
														 '<h3>We will send an activation string to '+email+'. </h3>'+	
														 '<p style="font-weight: lighter; font-size: 14px;">Please check your an email in a couple of minutes, for your activation information. NOTE: You need to activate your account in order to use our system.</p>'+	
														 '<span id="status8"></span>'+
													   '</div>'+			  
													   '<div class="login-fields text-center">'+
														 '<div class="field-flex">'+
														  ' <input type="text" id="code2" name="code2" placeholder="Activation string" />'+
														 '</div>'+
														 '<div class="login-actions">'+				
														  ' <button class="button btn btn-inverse btn-large" onclick="activate2(\''+email+'\',\''+pass+'\')">Finish</button>'+
														'</div>'+
														//'<div class="login-extra" style="margin: 3em auto -25px auto;"><br>'+
														 //' <a href="javascript:void(0)">Activate later</a> '+
														 //'</div>'+
													  '</div></form></div></div>';	
				} else {
					_("recruiterloader1").style.display = "none";
					status6.innerHTML = '<h5><div class="alert">'+ajax.responseText+'</div></h5>';
				}
	        }
        }
      ajax.send("r_eo="+email+"&r_pwd="+encodeURIComponent(pass)+"&r_userrole="+role+"&company_name="+company_name+"&company_url="+company_url+"&b_stream="+b_stream+"&comp_email="+comp_email+"&comp_contact="+comp_contact);
	}
}
function activate1(email,pass){
	var code = _("code1").value;
	var status7 = _("status7");
	if(email == "" || code == ""){
		status7.innerHTML = '<h5><div class="alert">Invalid activation string</div></h5>';
	}else if(!code.replace(/\s/g, '').length){
		status7.innerHTML = '<h5><div class="alert">Please enter activation string</div></h5>';
	} else {
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "activate_failed"){
					status7.innerHTML = '<h5><div class="alert">Account activation failed. Check activation string.</div></h5>';
				}else {
					_("seekerloader5").style.display = "block";
					window.location = "sync&"+ajax.responseText;
				}
	        }
        }
		ajax.send("action=activate_account&e_mail="+encodeURIComponent(email)+"&code="+encodeURIComponent(code)+"&passwd="+encodeURIComponent(pass));
	}
}
function activate2(email,pass){
	var code = _("code2").value;
	var status8 = _("status8");
	if(email == "" || code == ""){
		status8.innerHTML = '<h5><div class="alert">Form is missing key values</div></h5>';
	}else if(!code.replace(/\s/g, '').length){
		status8.innerHTML = '<h5><div class="alert">Please enter activation string</div></h5>';
	} else {
		var ajax = ajaxObj("POST", "register.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "activate_failed"){
					status8.innerHTML = '<h5><div class="alert">Account activation failed. Check activation string.</div></h5>';
				}else {
					_("recruiterloader2").style.display = "block";
					window.location = "sync&"+ajax.responseText;
				}
	        }
        }
		ajax.send("action=activate_account&e_mail="+encodeURIComponent(email)+"&code="+encodeURIComponent(code)+"&passwd="+encodeURIComponent(pass));
	}
}
</script>
</body>
</html>