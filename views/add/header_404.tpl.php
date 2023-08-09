<?php 
	header('HTTP/1.0 404 Not Found');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <meta name="robots" content="index, follow" />
	  <meta name="keywords" content="" />
	  <meta name="title" content="" />
	  <meta name="description" content="" />
	<title><?php echo $title ?></title>

	<link href="<?php echo $roott?>css/style.css" rel="stylesheet" type="text/css" />
	<!--
	<link media="screen" href="<?php //echo ROOTT?>css/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
	-->
	<!--[if IE 6]>
		<script type="text/javascript" src="js/unitpngfix.js"></script>
		<link href="css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--
	<script type="text/javascript" src="<?//php echo ROOTT?>js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="<?//php echo ROOTT?>js/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?//php echo ROOTT?>js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="<?//php echo ROOTT?>js/jquery_accordion.js"></script>
	<script type="text/javascript" src="<?//php echo ROOTT?>js/jquery.cookie.js"></script>


	<script type="text/javascript">

		$(document).ready(function() {
			$("a.gal").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});


			var openItem = false;
			if($.cookie("openItem") && $.cookie("openItem") != 'false'){
				var openItem = parseInt($.cookie("openItem"));
			}
			$("#accordion").accordion({
				active: openItem,
				collapsible: true,
				header: 'h4',
				autoHeight: false
			});
			$("#accordion h4").click(function(){
				$.cookie("openItem", $("#accordion").accordion("option", "active"));
			});
			$("#accordion > li").click(function(){
				$.cookie("openItem", null);
				var link = $(this).find('a').attr('href');
				window.location = link;
			});
			
		});    
			
	</script>
	-->
</head>