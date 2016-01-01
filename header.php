<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="The tales of a web designer, photographer, musician, writer – someone who loves everything from A to Z.">
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css?<?php echo date('Ymd', filemtime( get_stylesheet_directory() . '/style.min.css' )); ?>" type="text/css" media="screen">
		<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/favicons/144.png">
		<!-- For iPhone 4 Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/favicons/114-icon.png">
		<!-- For iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/favicons/72.png">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicons/195.png">
		<!-- For Windows 8 -->
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicons/favicon.ico">
		<meta name="application-name" content="Hey Georgie">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-square70x70logo" content="<?php bloginfo('template_url'); ?>/favicons/small.png">
		<meta name="msapplication-square150x150logo" content="<?php bloginfo('template_url'); ?>/favicons/medium.png">
		<meta name="msapplication-wide310x150logo" content="<?php bloginfo('template_url'); ?>/favicons/wide.png">
		<meta name="msapplication-square310x310logo" content="<?php bloginfo('template_url'); ?>/favicons/large.png">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">		
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<script src="<?php bloginfo('template_url'); ?>/js/html5shiv.js"></script>
		<![endif]-->
		</head>
	<body id="site-top">
		<header class="site-header" role="banner">
			<a href="/" class="site-header-logo">Hey Georgie</a>
			<a class="main-navigation-toggle" href="#">
				<span class="main-navigation-toggle-open">(click for menu)</span>
				<span class="main-navigation-toggle-close">(click to close menu)</span>
			</a>
			<nav id="main-navigation" class="main-navigation" role="navigation">
				<a href="/" class="home-link">Hey Georgie</a>
				<a href="/about/">About</a>
				<a href="/links/">Links</a>
				<a href="/archives/">Archives</a>
			</nav>
		</header>
		<div class="site-body">
		<div class="site-content" role="main">