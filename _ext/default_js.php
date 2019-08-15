<script src="_js/_query.js"></script>
<script src="_js/_strap.js"></script>
<script src="_js/_ajax.js"></script>
<script src="_js/_main.js"></script>
<script src="_js/_dialog.js"></script>
<script src="_js/_scripts.js"></script>
<script src="_js/_oBot.js"></script>
<script src="_js/_ooBot.js"></script>
<script type="text/javascript">
$(".owl-standby").click(function(){
	$(".owlphin-box").slideToggle(200);
	$("#owl-text").slideToggle(0);
	$(".face-mini").slideToggle(0);
	$("#appendedInputButton").focus();
})
function user(){
	user = '<?php echo $log_email?>';
	return user;
}
$.ajaxSetup({cache:false});
setInterval(function(){$('#quick_note_num').load('_parse/_quick_system_notes.php');}, 4000)
$.ajaxSetup({cache:false});
setInterval(function(){$('#quick_job_num').load('_parse/_quick_system_jobnum.php');}, 4000)
$.ajaxSetup({cache:false});
setInterval(function(){$('#quick_job_bookmark').load('_parse/_quick_system_bookmarknum.php');}, 4000)
$.ajaxSetup({cache:false});
setInterval(function(){$('#quick_rjob_num').load('_parse/_quick_system_company-job-num.php');}, 4000)
$.ajaxSetup({cache:false});
setInterval(function(){$('#shortlist_initiator').load('_parse/_quick_system_shortlist-insert.php');}, 5000)
</script>