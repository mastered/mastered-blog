<!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
	<!-- Optimised for mobile -->
	<meta name="viewport" content="width=device-width">
	<!-- All pinned sites -->
	<meta name="application-name" content="<?php bloginfo('name'); ?>" />
	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/blog-styles.css" />
	<!-- Typekit fonts -->
	<script type="text/javascript" src="//use.typekit.net/ihu5hfz.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<!-- Head functions shizzle -->
	<?php wp_head(); ?>
	<!-- End shizzle -->
	</head>
	<body <?php body_class(); ?>>
		<header class="blog-header">
			<div class="blog-header-inner layout-width">
				<a href="http://mastered.co" class="blog-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" />
				</a>
				<ul class="blog-nav">
					<li><a href="https://mastered.com/courses">Courses</a></li>
					<li><a href="https://mastered.com/schools">Schools</a></li>
					<li><a href="https://mastered.com/pages/faq">How It Works</a></li>
					<li><a href="http://blog.mastered.com/">Magazine</a></li>
				</ul>
			</div>
		</header>