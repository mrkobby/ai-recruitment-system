<div id="loadx">
	<div class="page-loader-wrapper">
		<div class="loader">
			<div class="preloader">
				<!-- <img class="theowl" src="_img/owlphin_gif.gif" style="height:30px;" /> -->
				<div class="spinner" style="background-color: #fff;width: 160px;height: 160px;"></div>
			</div>
		   <p style="color:#b3b3b3;">Please wait...</p>
		</div>
	</div>
</div>
<script>
window.addEventListener("load", function(){
	var load_screen = document.getElementById("loadx");
	$('.page-loader-wrapper').fadeOut(500);
	setTimeout(function(){document.body.removeChild(load_screen);}, 1000);
});
</script>