<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="javascript:void(0);" onclick="owlphinhome()">
	    <img src="_img/owlphin_log.png" style="height:30px;" />
		<span></span>
      </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-user"></i> <?php echo $email;?> <b class="caret"></b>
			</a>
            <ul class="dropdown-menu">
              <li <?php echo $usershow;?>><a href="javascript:void(0);" onclick="profile('<?php echo $e;?>')">Profile</a></li>
              <li <?php echo $userhide;?>><a href="javascript:void(0);" pd-popup-open="companyprofile">Company info</a></li>
            </ul>
          </li>
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-cog"></i> Account <b class="caret"></b>
			</a>
            <ul class="dropdown-menu">
              <li><a href="javascript:void(0);" onclick="settings('<?php echo $log_email;?>')">Settings</a></li>
			  <li><a href="javascript:void(0);" onclick="logout()">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search mobile-no-show" style="margin-top: 6px;">
          <input type="text" name="qu" id="qu" onKeyUp="fx(this.value)" onBlur="hideLive(this)" class="search-query" placeholder="Search people" style="width: 282px;">
		  <div id="livesearch"></div>
		</form>
      </div>
    </div>
  </div> 
</div>
<script type="text/javascript">
function fx(str){
	var s1=document.getElementById("qu").value;
	var xmlhttp;
	if (str.length==0) {
		document.getElementById("livesearch").innerHTML="";
		document.getElementById("livesearch").style.border="0px";
		document.getElementById("search-layer").style.width="auto";
		document.getElementById("search-layer").style.height="auto";
		document.getElementById("livesearch").style.display="block";
		return;
	  }
	if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();
	  }else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
		document.getElementById("search-layer").style.width="100%";
		document.getElementById("search-layer").style.height="100%";
		document.getElementById("livesearch").style.display="block";
		}
	  }
	xmlhttp.open("GET","_parse/_call_main_search_ajax.php?n="+encodeURIComponent(s1),true);
	xmlhttp.send();	
}
function hideLive(search){
	//document.getElementById("livesearch").style.display="none";
}
</script>