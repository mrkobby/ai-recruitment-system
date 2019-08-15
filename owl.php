<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Owlphin</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.owl.css" rel="stylesheet">
</head>
<body class="owlbody owl-gradient">
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner owl-gradient">
		<div class="container"> 
		  <a class="brand"  href="javascript:void(0)" onclick="owlphinhome()">
			<h2 class="title"><img src="_img/owlphin_gif.gif" style="height:30px;" /></h2>
		  </a>
		</div>
	</div> 
</div>
<div class="contain">
	<div class="chat"></div>
	<div class="busy"></div>
	<div class="input has-feedback">
		<div class="input-append">
          <input class="span2 m-wrap" id="appendedInputButton" placeholder="Start typing.." type="text">
          <a class="btn" style="margin-left: 2px;"><span class="fa fa-send"></span></a>
        </div>     	
	</div>
</div>
<div class="footer" style="bottom: 0;position: fixed;right: 0;left: 0;"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
<!--<script src="_js/_oBot.js"></script>
<script src="_js/_ooBot.js"></script>-->
</body>
</html>
