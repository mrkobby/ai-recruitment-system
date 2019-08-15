	<div class="popup" id="addeducation" pd-popup="addeducation" style="display:none;">
		<div class="popup-inner">
		<div id="addeduloader" class="div-loader-cover"><div class="spinner"></div></div>
			<div class="row">
			  <div class="span7">
				<div class="widget widget-nopad" style="margin-bottom: 0em;">
				  <div class="widget-header text-center">
					<h3>Add education</h3>
				  </div>
				  <div class="widget-content">
					<div class="widget big-stats-container" style="margin-bottom: 0;">
					  <div class="widget-content">
						<div class="cf">
							<form class="form-horizontal" style="margin: 0 0 0px;" role="form" method="post" onSubmit="return false;">
							  <fieldset style="padding: 10px;">
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="sch">School</label>
									<div class="controls">
									  <input class="span6" name="sch" id="sch" type="text">
									</div>			
								  </div>
								</div>
								<div class="control-flex">
								  <div class="control-group-max">											
									<label class="control-label" for="degree">Degree</label>
									<div class="controls">
									  <select name="degree" id="degree">
										<option Selected disabled value=""></option>
										<option value="Diploma degree">Diploma degree</option>
										<option value="Bachelor/s degree">Bachelor's degree</option>
										<option value="Doctor of Education - EdD">Doctor of Education - EdD</option>
										<option value="Doctor of Law - JD">Doctor of Law - JD</option>
										<option value="Master/s degree">Master's degree</option>
										<option value="Engineer/s degree">Engineer's degree</option>
										<option value="Doctor of Philosophy - phD"> Doctor of Philosophy - phD</option>
										<option value="Other">Other</option>
									  </select> 
									</div>		
								  </div>
								</div>
								<div class="control-flex">	
								  <div class="control-group-max">											
									<label class="control-label" for="major">Field of study</label>
									<div class="controls">
									  <input class="span6" name="major" id="major" type="text">
									</div>		
								  </div>	
								</div>	
								<div class="control-flex">	
								  <div class="control-group-max">											
									<label class="control-label" for="cgpa">CGPA</label>
									<div class="controls">
									  <input class="span6" type="text" id="cgpa" name="cgpa" placeholder="Optional" />
									</div>		
								  </div>	
								</div>	
								<div class="control-flex">
								  <div class="control-group">											
									<label class="control-label" for="from">From Year</label>
									<div class="controls">
									  <select name="from" id="from">
										<option Selected disabled value=""></option>
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
									<label class="control-label" for="to">To Year </label>
									<div class="controls">
									  <select name="to" id="to">
										<option Selected disabled value=""></option>
										  <option value="2018">2022</option><option value="2017">2021</option><option value="2016">2020</option><option value="2015">2019</option>
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
									  <p class="help-block">(or expected)</p>
									</div>		
								  </div>		
								</div>	
								<div class="form-actions">
								  <div class="control-group" style="margin-bottom: 0px;">											
									<div class="controls"> 
									  <button class="btn btn-inverse" onclick="addEdu()">Add</button> 
									  <button class="btn" pd-popup-close="addeducation">Cancel</button>
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
function addEdu(){
    var sch = _("sch").value;
	var major = _("major").value;
	var degree = _("degree").value;
	var cgpa = _("cgpa").value;
	var fr = _("from").value;
	var to = _("to").value;
	if(sch == "" || major == "" || degree == "" || fr == "" || to == ""){
		Hint.render("Please fill out all of the form data");
	}else if(!sch.replace(/\s/g, '').length || !major.replace(/\s/g, '').length || !degree.replace(/\s/g, '').length){
		Hint.render("Please fill out all of the form data");
	} else{
		document.getElementById("addeduloader").style.display = 'block';
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "add_failed"){
					Alert.render("Query was unsuccessful. You've either reached your maximum of 6 education background details or your input values are invalid");
					document.getElementById("addeduloader").style.display = 'none';
				}else {
					document.getElementById("addeduloader").style.display = 'none';
					document.getElementById("sch").value = "";
					document.getElementById("major").value = "";
					document.getElementById("cgpa").value = "";
					$("#addeducation").fadeOut(100);
					document.getElementById("user_edu").innerHTML = ajax.responseText;
				}
	        }
        }
		ajax.send("action=add_edu&sch="+encodeURIComponent(sch)+"&major="+encodeURIComponent(major)+"&degree="+degree+"&cgpa="+encodeURIComponent(cgpa)+"&fr="+fr+"&to="+to);
	}
}
function deleteEdu(eid,ebox){
	Confirm.render("Are you sure you want to remove this?");
	Confirm.yes = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		var ajax = ajaxObj("POST", "_parse/_all_edits.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "delete_ok"){
					_(ebox).style.display = 'none';
				} else {
					Hint.render(ajax.responseText);
				}
			}
		}
		ajax.send("action=delete_education&eid="+eid);
	}
	Confirm.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
</script>	