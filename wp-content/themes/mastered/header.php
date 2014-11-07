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
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-46814231-1']);
	  _gaq.push(['_setDomainName', 'mastered.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	</head>
	<body <?php body_class(); ?>>
		<header class="blog-header">
			<div class="blog-header-inner layout-width">
				<a href="http://mastered.com" class="blog-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" />
				</a>
				<ul class="blog-nav">
					<li><a href="https://mastered.co/courses">Courses</a></li>
					<li><a href="https://mastered.co/pages/faq">How It Works</a></li>
				</ul>
			</div>
		</header>
