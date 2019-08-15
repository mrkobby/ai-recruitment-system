<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bacsyd Support</title>
<?php include_once("_ext/default_head.php");?>
<link href="_css/p.help.css" rel="stylesheet">
</head>
<body class="owlbody owl-gradient">
<?php include_once("_ext/pageloader.php");?>
<?php include_once("_ext/pageloader-starter.php");?>
<div class="navbar navbar-fixed-top" style="position: fixed;">
	<div class="navbar-inner owl-gradient">
		<div class="container"> 
		  <a class="brand"  href="javascript:void(0)" onclick="owlphinhome()">
			<h2 class="title"><img src="_img/owlphin_gif.gif" style="height:30px;" /></h2>
		  </a>
		  <div class="nav-collapse">
			<form class="navbar-search" role="form" method="post" onSubmit="return false;">
			  <ul class="nav pull-right mobile-no-show">
			   <li><button class="btn btn-inverse" onclick="register()">No account? Join now</button></li>
			   <li><button class="btn btn-primary" onclick="contact()">Contact us</button></li>
			  </ul>
			</form>
		  </div>
		</div>
	</div> 
</div>
<div class="main" style="padding-top: 5em;">
  <div class="main-inner">
	<div class="container">	
      <div class="row">
	    <div class="span12">
	      <div class="widget">
			<div class="widget-header">
			  <i class="fa fa-thumb-tack"></i>
			  <h3>Frequently Asked Questions - FAQ</h3>
			</div>
			<div class="widget-content">
			  <ol class="faq-list">
				<li>
				  <h4>What is Bacsyd? How does the system work?</h4>
				  <p>With the current recruitment cycle, which is time consuming and tedious, 
				  it will be advisable to incorporate machine-learning into the recruitment process. A system that will use AI
				  to shortlist candidates by determining what an open role’s essentials and desirable criteria are.</p>	
				  <p>Bacsyd is a job seacrh website that automates the screening and shortlisting processes of recruitment. 
				  It is intended to help ensure a quality and bias-free selection of candidates, 
				  avoid discrimination, save time and money, as well as positively impacting of the organization’s reputation. </p>	
				</li>
				<li>
				  <h4>Who is behind Bacsyd?</h4>
				  <p> Bacsyd is a privately held company with global ambitions and consists of a well seasoned
				  management team and advisors. Kwabena Aboagye Dougan founded this company.</p>	
				</li>
				<li>
				  <h4> Is Bacsyd a recruitment firm?</h4>
				  <p> No. Bacsyd is NOT a recruitment agency. We do not do candidate interviewing but automate short-listing. 
				  When we get such request, we recommend a list of qualified recruiters that we are familiar with. 
				  We do not accept commissions for recommendations we make. </p>	
				</li>
				<li>
				  <h4>How do I apply for a job?</h4>
				  <p> Go to your jobs page. Search through available jobs. Once you find the one that interests you, click the "apply for this job" button.</p>	
				</li>
				<li>
				  <h4>Do I need a PC before i can visit www.bascyd.com?</h4>
				  <p> No. You can also access www.bascyd.com on your mobile phone. But we strong recommend a PC, just to enhance your experience on the website.</p>	
				</li>
				<li>
				  <h4>What happens when I apply online for jobs posted on www.bascyd.com?</h4>
				  <p> Your profile information will be sent to the systems AI job queue, where all applicant will be automatically shortlisted.
				  Do not worry if you do not receive immediate response. Once the deadline of the job offer reachs, messages will be automatically sent 
				  to candidates who applied for that job, with the results of the short-listing. Be rest assured that the employer will contact you 
				  if you are a successful candidate.</p>	
				</li>
				<li>
				  <h4>Do I need a resume to apply to a job posting?</h4>
				  <p> No. Your profile is what explains your focus, qualifications, skills, as well as your commitment to starting 
				  or changing a career, which will help the system make short-listing decisions. Your profile is basically a virtual
				  replica of your physical resume.</p>	
				</li>
			  </ol>
			</div>
		  </div>
		</div>
      </div>      
	  <div class="row" style="margin-top:5px">
	    <div class="span12">
	      <div class="widget">
			<div class="widget-header">
			  <i class="fa fa-tint"></i>
			  <h3>Sitemap</h3>
			</div>
			<div class="widget-content">
			  <ul>
				<li><h4><a href="javascript:void(0)" onclick="owlphinhome()">Front page</a></h4></li>
				<li><h4><a href="javascript:void(0)" onclick="login()">Looking for a job? Looking for a professional? Login now!</a></h4></li>
				<li><h4><a href="javascript:void(0)" onclick="register()">You need to create an account before using our system. Sign up!</a></h4></li>
			  </ul>
			</div>
		  </div>
		</div>
      </div>
	</div>
  </div>    
</div>
   

<div class="footer"><?php include_once("_ext/footer.php");?></div>
<?php include_once("_ext/default_js.php");?>
<script type="text/javascript">
(function($) {
    $.fn.goFaq = function(options) {
        var defaults = {
        	enableSearch: true,
        	enableToc: true,
        	enableStyling: true,
            //numberHtml: '{{#}}.',
            numberHtml: '<div class="faq-number">{{#}}</div>'
        };
        var options = $.extend({}, defaults, options);
        return this.each(function(i) {
            var $this = $(this);          
            var $container = $this.wrap ('<div class="faq-container"></div>');
            $this.addClass ('faq-list');
            if (options.enableToc) {
	            var $toc = generateToc ($this);
	            $toc.insertBefore ($this);
	        }
            var $empty = generateEmptySearch ();
            $empty.appendTo ($container);
            generateAnswerNumbers ($this); 
        });
        function search (e) {
			var el, container, filter, count, pattern, container, answers, toc, tocs, empty;
			el = $(this);
			container = el.parents ('.faq-container');
			filter = el.val ();
			toc = container.find ('.faq-toc');
			answers = container.find ('.faq-list').find ('li');
			tocs = container.find ('.faq-toc').find('li');
			empty = container.find ('.faq-empty');
			pattern = new RegExp (filter, 'i');
			
			answers.hide ();
			tocs.hide ();
			
			$.grep (answers.find ('.faq-text'), function (input) {
				if (pattern.test ($(input).text ())) {
					$(input).parents ('li').show ();
					var index = $(input).parents ('li').index ();				
					tocs.eq (index).show ();				
				}			
			});	
			
			if (!answers.is (':visible')) {
				empty.show ();
				toc.hide ();
			} else {
				empty.hide ();
				toc.show ();
			}
		}
		function generateEmptySearch () {
			var $empty = $('<div>', { 'class': 'faq-empty' });
			return $empty.html ('Nothing Found');
		}
        function generateAnswerNumbers ($list) {
        	$list.find ('li').each (function (i) {
        		var id = parseInt (i+1);
        		
        		
        		$(this).wrapInner ('<div class="faq-text"></div>');
            	if (options.enableStyling) {
					var icon = '<div class="faq-icon">' + options.numberHtml + '</div>';
	        		
					icon = icon.replace ('{{#}}', id);
					$(this).prepend (icon);
				}
        	});
        }    
        function generateToc ($list) {
        	var html = '<ol>';	
        	
			$list.find ('li').each (function (i) {				
				var id = parseInt (i+1);							
				html += '<li>' + id + '. <a href="#faq-' + id + '">' + $(this).find ('h4').text () + '</a></li>';								
				$(this).attr ('id', 'faq-' + id);				
			});	
					
			html += '</ol>';
        	var $toc = $('<div>', { 'class': 'faq-toc' });
        	$toc.html (html);
        	return $toc;
        }
    };
})(jQuery);

$(function () {	
	$('.faq-list').goFaq ();
});
</script>
</body>
</html>
