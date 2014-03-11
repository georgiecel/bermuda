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
		</head>
	<body>
		<header class="site-header" role="banner">
			<h1 class="site-title">Hey Georgie</h1>
			<nav class="main-navigation" role="navigation">
				<!-- This is an example link -->
				<a class="main-navigation-link" href="/">Home</a>
			</nav>
			<div class="site-search">
				<?php get_search_form(); ?>
			</div>
		</header>
		<!-- Sidebar may or may not be included ... -->
		<?php get_sidebar(); ?>
		<div class="site-content" role="main">