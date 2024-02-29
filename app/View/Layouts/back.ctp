<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo ucwords(strtolower($title_for_layout)); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo SITEURL; ?>favicon.ico" type="image/x-icon"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo SITEURL."lab_root/";?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo SITEURL."lab_root/";?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITEURL."lab_root/";?>dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITEURL."lab_root/";?>css/main.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- REQUIRED JS SCRIPTS -->
    
    <?php
 	   echo $this->Html->script(array('/lab_root/plugins/jQuery/jQuery-2.1.4.min','/lab_root/bootstrap/js/bootstrap.min','/lab_root/dist/js/app.min'));
        echo $this->Html->css(array('/lab_root/css/cake.generic'));
        echo $this->Html->script(array('/lab_root/js/lab.min','/lab_root/js/jquery.magnific-popup.min')); ?>
    <script>
    var SITEURL = "<?php echo SITEURL?>";
	$(document).ready(function() {
        $.ajaxSetup({cache: false});
        $('.image-popup-vertical-fit').magnificPopup({
    		type: 'image',
    		closeOnContentClick: true,
    		mainClass: 'mfp-img-mobile',
    		image: {
    			verticalFit: true
    		}
    		
    	});
        /* normal popup */
        $('.GnRespopAjax_cls').magnificPopup({type: 'ajax', closeOnContentClick:true,closeOnBgClick:true,closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">X</button>'});
        /*pop up close only with close button*/
        $('.GnResPopAjax').magnificPopup({type: 'ajax', closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: true, enableEscapeKey: false, closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">X</button>'});
        /*popup with action */
        $('.GnResPopAjax_act').magnificPopup({type: 'ajax', closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: true, enableEscapeKey: true, closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">X</button>'});
        /*popup with no close buttong */
        $('.GnResPopAjax').magnificPopup({type: 'ajax', closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: false, enableEscapeKey: false});
        
	});
	</script>  
  </head>
  
<body class="skin-blue sidebar-mini">
<div id="preloader" style="display:none"> <div id="status">&nbsp;</div> </div>
<div id="cover" ></div>  
    <div class="wrapper">
    <?php echo $this->Session->flash(); ?>
	<?php 
	echo $this->element('labs/header');
	echo $this->element('labs/menu');
	echo $this->fetch('content');
	echo $this->element('labs/footer');
	?>
    </div>
  </body>
</html>