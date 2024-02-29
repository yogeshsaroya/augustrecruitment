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
<meta name="description" content='<?php if (isset($page_meta)) { echo htmlentities($page_meta['des'], ENT_QUOTES, 'UTF-8'); } else { if (isset($WebSetting['WebSetting']['description'])) { echo htmlentities( $WebSetting['WebSetting']['description'], ENT_QUOTES, 'UTF-8'); } } ?>'/>
<meta name="keywords" content="<?php if (isset($page_meta)) { echo htmlentities($page_meta['key'], ENT_QUOTES, 'UTF-8'); } else { if (isset($WebSetting['WebSetting']['keyword'])) { echo htmlentities($WebSetting['WebSetting']['keyword'], ENT_QUOTES, 'UTF-8'); } } ?>"/>
<meta property="og:site_name" content="<?php echo WEBTITLE;?>">
<meta property="og:url" content="<?php echo Router::url($this->here, true); ?>">
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo ucwords(strtolower($title_for_layout)); ?>">
<meta property="og:description" content='<?php if (isset($page_meta)) { echo htmlentities($page_meta['des'], ENT_QUOTES, 'UTF-8'); } else { if (isset($WebSetting['WebSetting']['description'])) { echo htmlentities( $WebSetting['WebSetting']['description'], ENT_QUOTES, 'UTF-8'); } } ?>'>
<?php if (isset($room_primary_image) && !empty($room_primary_image)) { ?>
<meta property="og:image" content="<?php echo $room_primary_image; ?>" />
<?php }?>
<meta property="og:locale" content="en_US">
<link rel="canonical" href="<?php echo Router::url($this->here, true); ?>"/>
<link rel="shortcut icon" href="<?php echo SITEURL; ?>favicon.ico" type="image/x-icon"/>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta http-equiv="imagetoolbar" content="false"/>
<meta name="distribution" content="Global"/>
<meta name="language" content="en-us"/>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<?php if (isset($WebSetting['WebSetting']['meta'])) { echo $WebSetting['WebSetting']['meta']; } ?>
<?php if (isset($WebSetting['WebSetting']['script'])) { echo $WebSetting['WebSetting']['script']; } ?>
<link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo SITEURL; ?>sitemap.xml"/>

<?php echo $this->Html->css(array('bootstrap','animate','jquery-ui','magnific-popup.css','font-icons','style','//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css','//fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic','responsive'));
    echo $this->Html->script(array('jquery.js', 'plugins.js', 'vendor/jquery.form.js')); ?>

<script>
var SITEURL = "<?php echo SITEURL;?>";
</script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<?php 
        echo $this->Js->writeBuffer(array('catch' => TRUE));
        echo $scripts_for_layout;
?>
</head>
<body class="stretched">
	<div id="wrapper1" class="clearfix">
		<?= $this->element('header') ?>
	<?= $this->Flash->render() ?>
    <?php echo $this->Session->flash(); ?>
    <div class="main">

<section id="page-title"><div class="container clearfix"><h1>Page Not Found</h1></div></section>

<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="col_half nobottommargin">
                        <div class="error404 center">404</div>
                    </div>

                    <div class="col_half nobottommargin col_last ">

                        <div class="heading-block nobottomborder">
                            <h4>Ooopps.! The Page you were looking for, couldn't be found.</h4>
                            <span>Try searching for the best match or browse the links below:</span>
                        </div>

                        

                       

                       

                       

                    </div>

                </div>

            </div>

        </section>    




    </div>
    <?= $this->element('footer') ?>
<div id="app_data"></div>    
</div>
<?php echo $this->Html->script(array('functions')); ?>?>
<?php //echo $this->element('sql_dump');   ?>
<?php if (isset($WebSetting['WebSetting']['tracker'])) { echo $WebSetting['WebSetting']['tracker']; } ?>
</body>
</html>