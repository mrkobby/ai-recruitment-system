	<div class="popup" id="addxp" pd-popup="addxp" style="display:none;">
		<div class="popup-inner">
		<div id="addxploader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span7">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Add work experience</h3>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
							  <fieldset style="padding: 10px;">
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="job_nm">Job title</label>
									<div class="controls">
									  <input class="span6" name="job_nm" id="job_nm" type="text">
									</div>			
								  </div>
								</div>
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="job_spec">Specialization</label>
									<div class="controls">
									  <select name="job_spec" id="job_spec">
										<option Selected disabled value=""></option>
										<option value="Administrative">Administrative</option><option value="Banking / Finance / Insurance">Banking / Finance / Insurance</option><option value="Building Design/Architecture">Building Design/Architecture</option>
										<option value="Construction / Building">Construction / Building</option><option value="Consulting/Business Strategy & Planning">Consulting/Business Strategy &amp; Planning</option><option value="Customer Service">Customer Service</option>
										<option value="Engineering">Engineering</option><option value="Executive / Top Management">Executive / Top Management</option><option value="Healthcare / Pharmaceutical">Healthcare / Pharmaceutical </option>
										<option value="Hospitality / Leisure / Travels">Hospitality / Leisure / Travels</option><option value="Human Resources">Human Resources</option><option value="Information Technology">Information Technology</option>
										<option value="Legal">Legal</option><option value="Manufacturing / Production">Manufacturing / Production</option><option value="Media / Public Relations / Advertising">Media / Public Relations / Advertising</option>
										<option value="Media/Journalism">Media/Journalism</option><option value="NGO">NGO</option><option value="Oil &amp; Gas">Oil &amp; Gas</option>
										<option value="Project Management">Project Management</option><option value="Real Estate / Property">Real Estate / Property</option><option value="Sales / Marketing / Bus. Dev.">Sales / Marketing / Bus. Dev.</option>
										<option value="Teaching / Education">Teaching / Education</option><option value="Telecommunications">Telecommunications</option>
									  </select> 
									</div>		
								  </div>
								</div>
								<div class="control-flex">	
								  <div class="control-group-max">											
									<label class="control-label" for="job_company">Company name</label>
									<div class="controls">
									  <input class="span6" type="text" id="job_company" name="job_company" />
									</div>		
								  </div>	
								</div>	
								<div class="control-flex">	
								  <div class="control-group-max">											
									<label class="control-label" for="bb_stream">Industry</label>
									<div class="controls">
									  <select name="bb_stream" id="bb_stream">
										<option Selected disabled value=""></option>
										<option value="Agriculture/Poultry/Fishing">Agriculture/Poultry/Fishing</option><option value="Banking / Financial Services">Banking / Financial Services</option>
										<option value="Construction / Real Estate">Construction / Real Estate</option><option value="Consulting">Consulting</option><option value="Creatives/Art/Design">Creatives/Art/Design</option>
										<option value="Ecommerce/Internet">Ecommerce/Internet</option><option value="Education">Education</option><option value="Engineering">Engineering</option>
										<option value="FMCG">FMCG</option><option value="Food">Food Services</option><option value="Government / Defence">Government / Defence</option>
										<option value="Healthcare">Healthcare</option><option value="Hospitality/Leisure">Hospitality/Leisure</option><option value="ICT / Telecommunications">ICT / Telecommunications</option>
										<option value="Insurance">Insurance</option><option value="Legal">Legal</option><option value="Logistics / Transportation">Logistics / Transportation</option>
										<option value="Manufacturing / Production">Manufacturing / Production</option><option value="Media">Media</option><option value="NGO">NGO</option>
										<option value="Oil & Gas / Mining">Oil &amp; Gas / Mining</option><option value="Power/Energy">Power/Energy</option><option value="Retail / Wholesales">Retail / Wholesales</option>
										<option value="Trade / Services">Trade / Services</option><option value="Travels/Tours">Travels/Tours</option><option value="Blue Collar">Blue Collar</option>
									  </select>
									</div>		
								  </div>	
								</div>	
								<div class="control-flex xp-date-special">
								  <div class="control-group">											
									<label class="control-label" for="start_dt">From:</label>
									<div class="controls">
									  <select name="from_month" id="from_month">
										<option Selected disabled value="">Month</option>
										  <option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option>
										  <option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option>
										  <option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>
									  </select> 
									</div>		
								  </div>
								  <div class="control-group">											
									<div class="controls xp-date-input-div" style="margin-left: 3px;">
									  <select name="from_year" id="from_year">
										<option Selected disabled value="">Year</option>
										  <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option>
										  <option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option>
										  <option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option>
										  <option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option>
										  <option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option>
										  <option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option>
										  <option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option>
										  <option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>
										  <option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option>
										  <option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option>
										  <option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option>
										  <option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option>
										  <option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option>
										  <option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option>
										  <option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option>
									  </select> 
									</div>		
								  </div>
								  <div class="control-group">											
									<label class="control-label xp-date-label" for="end_dt">To:</label>
									<div class="controls xp-date-input-div">
									  <select name="to_month" id="to_month">
										<option Selected disabled value="">Month</option>
										  <option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option>
										  <option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option>
										  <option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>
									  </select> 
									</div>	
								  </div>
								  <div class="control-group">											
									<div class="controls xp-date-input-div" style="margin-left: 3px;">
									  <select name="to_year" id="to_year">
										<option Selected disabled value="">Year</option>
										  <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option>
										  <option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option>
										  <option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option>
										  <option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option>
										  <option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option>
										  <option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option>
										  <option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option>
										  <option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>
										  <option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option>
										  <option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option>
										  <option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option>
										  <option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option>
										  <option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option>
										  <option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option>
										  <option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option>
									  </select> 
									</div>		
								  </div>		
								</div>	
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="description">Description</label>
									<div class="controls">
									  <textarea type="text" id="description" name="description" ></textarea>
									</div>		
								  </div>		
								</div>	
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-inverse" onclick="addEx()">Add</button> 
									  <button class="btn" pd-popup-close="addxp">Cancel</button>
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
function addEx(){
    var job_nm = _("job_nm").value;
    var job_company = _("job_company").value;
	var job_spec = _("job_spec").value;
	var bb_stream = _("bb_stream").value;
	var from_month = _("from_month").value;
	var from_year = _("from_year").value;
	var to_month = _("to_month").value;
	var to_year = _("to_year").value;
	var description = _("description").value;
	if(job_nm == "" || job_company == "" || job_spec == "" || bb_stream == "" || from_month == "" || to_month == "" || to_year == "" || from_year == ""){
		Hint.render("Please fill out all of the form data");
	}else if(!job_nm.replace(/\s/g, '').length || !job_company.replace(/\s/g, '').length){
		Hint.render("Please fill out all of the form data");
	} else{
		document.getElementById("addxploader").style.display = 'block';
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "xp_failed"){
					Alert.render("Query was unsuccessful. Please check input values");
					document.getElementById("addxploader").style.display = 'none';
				}else {
					document.getElementById("addxploader").style.display = 'none';
					document.getElementById("job_nm").value = "";
					document.getElementById("job_company").value = "";
					document.getElementById("from_month").value = "";
					document.getElementById("to_month").value = "";
					document.getElementById("to_year").value = "";
					document.getElementById("from_year").value = "";
					$("#addxp").fadeOut(100);
					document.getElementById("user_xp").innerHTML = ajax.responseText;
				}
	        }
        }
		ajax.send("action=add_xp&job_nm="+encodeURIComponent(job_nm)+"&job_company="+encodeURIComponent(job_company)+"&job_spec="+job_spec+"&bb_stream="+encodeURIComponent(bb_stream)+"&from_month="+from_month+"&to_month="+to_month+"&to_year="+to_year+"&from_year="+from_year+"&description="+encodeURIComponent(description));
	}
}
function deleteXp(xid,xbox){
	Confirm.render("Are you sure you want to remove this?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "delete_ok"){
					_(xbox).style.display = 'none';
				} else {
					Hint.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_experience&xid="+xid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>	