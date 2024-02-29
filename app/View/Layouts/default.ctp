<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
header('Content-Type: text/html; charset=UTF-8');
header("Content-type: text/css");
header("Content-type: application/javascript");
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1,user-scalable=0">
	<title><?php echo ucwords(strtolower($title_for_layout)); ?></title>
	<meta name="description" content='<?php if (isset($page_meta)) {
											echo htmlentities($page_meta['des'], ENT_QUOTES, 'UTF-8');
										} else {
											if (isset($WebSetting['WebSetting']['description'])) {
												echo htmlentities($WebSetting['WebSetting']['description'], ENT_QUOTES, 'UTF-8');
											}
										} ?>' />
	<meta name="keywords" content="<?php if (isset($page_meta)) {
										echo htmlentities($page_meta['key'], ENT_QUOTES, 'UTF-8');
									} else {
										if (isset($WebSetting['WebSetting']['keyword'])) {
											echo htmlentities($WebSetting['WebSetting']['keyword'], ENT_QUOTES, 'UTF-8');
										}
									} ?>" />
	<meta property="og:site_name" content="<?php echo WEBTITLE; ?>">
	<meta property="og:url" content="<?php echo Router::url($this->here, true); ?>">
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo ucwords(strtolower($title_for_layout)); ?>">
	<meta property="og:description" content='<?php if (isset($page_meta)) {
													echo htmlentities($page_meta['des'], ENT_QUOTES, 'UTF-8');
												} else {
													if (isset($WebSetting['WebSetting']['description'])) {
														echo htmlentities($WebSetting['WebSetting']['description'], ENT_QUOTES, 'UTF-8');
													}
												} ?>'>
	<meta property="og:image" content="<?php echo SITEURL; ?>img/featured_image.png" />
	<meta property="og:locale" content="en_US">
	<link rel="canonical" href="<?php echo Router::url($this->here, true); ?>" />
	<link rel="shortcut icon" href="<?php echo SITEURL; ?>favicon.ico" type="image/x-icon" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="imagetoolbar" content="false" />
	<meta name="distribution" content="Global" />
	<meta name="language" content="en-us" />
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<?php //if (isset($WebSetting['WebSetting']['meta'])) { echo $WebSetting['WebSetting']['meta']; } 
	?>
	<?php //if (isset($WebSetting['WebSetting']['script'])) { echo $WebSetting['WebSetting']['script']; } 
	?>
	<link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo SITEURL; ?>sitemap.xml" />

	<link href="//fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo SITEURL; ?>css/responsive.css" type="text/css" />

	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="<?php echo SITEURL; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>






	<script>
		var SITEURL = "<?php echo SITEURL; ?>";
	</script>
	<?php
	echo $this->Js->writeBuffer(array('catch' => TRUE));
	echo $scripts_for_layout;
	?>
	<style>
		


		.h_sec {
			font-size: 21px !important
		}

		.revo-slider-emphasis-text {
			font-size: 64px;
			font-weight: 700;
			letter-spacing: -1px;
			font-family: 'Gabarito', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Gabarito', sans-serif;
		}

		.white {
			background-color: #fff !important;
		}
	</style>
</head>

<body class="no-transition stretched device-lg">
	<div id="preloader" style="display: none;">
		<div id="status">&nbsp;</div>
	</div>
	<div id="wrapper" class="clearfix">
		<?= $this->element('header') ?>
		<?= $this->Flash->render() ?>
		<?php echo $this->Session->flash(); ?>

		<?= $this->fetch('content') ?>

		<?= $this->element('footer') ?>
		<div id="app_data"></div>
	</div>
	<?php echo $this->Html->script(array('functions')); ?>
	<?php //echo $this->element('sql_dump');   
	?>
	<?php if (isset($WebSetting['WebSetting']['tracker'])) {
		echo $WebSetting['WebSetting']['tracker'];
	} ?>
	<!-- Footer Scripts
	============================================= -->
</body>

</html>