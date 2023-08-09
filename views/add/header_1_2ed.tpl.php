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
    <link media="screen" href="<?php echo $roott?>css/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>

    <!--[if IE 6]>
        <script type="text/javascript" src="js/unitpngfix.js"></script>
        <link href="css/ie6.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    <script type="text/javascript" src="<?php echo $roott?>js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="<?php echo $roott?>js/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo $roott?>js/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo $roott?>js/jquery_accordion.js"></script>
    <script type="text/javascript" src="<?php echo $roott?>js/jquery.cookie.js"></script>
    <?php echo (empty($params['str1']))	? "" :	$params['str1']?>


<script type="text/javascript">

    $(document).ready(function() {
    $("a.gal").fancybox({
            'overlayShow'	: false,
            'transitionIn'	: 'elastic',
            'transitionOut'	: 'elastic'
            });
			
    <?php echo (empty($params['str2'])) ? "" : $params['str2']?>
			
    var openItem = false;			
			
    var begin_glava = <?php echo (empty($that->begin_glava) 	? 0 :	$that->begin_glava) ?>;
    var glava 		= <?php echo (empty($that->glava)	        ? 0 :	$that->glava)       ?>;
    var acc_value	= <?php echo (empty($that->acc_value)  	    ? 0 :	$that->acc_value)   ?>;
    var kuka 		= "<?php echo $that->controller ?>";


    if (acc_value > 0)
    {
        openItem = parseInt(acc_value-1);
    }

			
    $("#accordion").accordion({
            active: openItem,
            collapsible: true,
            header: 'li.h4',
            autoHeight: false
    });

	$("#accordion li.h4 a.viewing").click(function(){
		var link = this.href;
		window.location = link;
	});

	$("#accordion li.h4 a.editing").click(function(){
				
            var link = this.href;
            window.location = link;
	});
     /*
	$("#accordion > li").click(function(){
				
            var link = $(this).find('a').attr('href');
            window.location = link;
	});
	*/
    });    
			
</script>
</head>