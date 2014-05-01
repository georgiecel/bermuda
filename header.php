<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="The tales of a web designer, photographer, musician, writer – someone who loves everything from A to Z.">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1, width=device-width">
		<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
		<script src="<?php bloginfo('template_url'); ?>/js/html5shiv.js"></script>
		</head>
	<body id="site-top">
		<header class="site-header" role="banner">
			<div class="site-logo-mini"></div>
			<a class="main-navigation-toggle" href="#">
				<span class="main-navigation-toggle-open">open menu</span>
				<span class="main-navigation-toggle-close">close menu</span>
			</a>
			<nav id="main-navigation" class="main-navigation" role="navigation">
				<a class="main-navigation-link" href="/">Home</a>
				<a class="main-navigation-link" href="/about/">About</a>
				<a class="main-navigation-link" href="/lzrgun-manifesto">The LZRGUN Manifesto</a>
				<a class="main-navigation-link" href="/poetry/">Poetry</a>
				<a class="main-navigation-link" href="/links/">Links</a>
			</nav>
		</header>
		<div class="site-body">
		<?php get_sidebar(); ?>
		<div class="site-content" role="main">