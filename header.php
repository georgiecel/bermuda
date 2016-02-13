<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Cache-control" content="public">
		<meta charset="utf-8">
		<meta name="description" content="<?php meta_desc(); ?>">
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css?<?php echo date('Ymd', filemtime( get_stylesheet_directory() . '/style.min.css' )); ?>" type="text/css" media="screen">
		<link rel="prefetch" href="//cdn.jsdelivr.net/font-hack/2.019/css/hack.min.css">
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
	</head>
	<body id="site-top">
		<header class="site-header-container">
			<div class="site-header">
				<nav class="main-navigation">
					<ul class="main-navigation__list">
						<li class="main-navigation__list-item main-navigation__list-item--logo">
							<a href="<?php echo site_url(); ?>" class="main-navigation__logo">
								<img src="<?php bloginfo('template_url'); ?>/images/logo.png"
									 srcset="<?php bloginfo('template_url'); ?>/images/logo.png,
											 <?php bloginfo('template_url'); ?>/images/logo@2x.png 2x"
									 alt="Hey Georgie"
									 class="main-navigation__logo-image">
							</a>
						</li>
						<?php wp_nav_menu( array(
							'menu' => 'main-navigation',
							'container' => '',
							'items_wrap' => '%3$s',
							'walker' => new menu_walker
							) ); ?>
					</ul>
				</nav>
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
			</div>
		</header>
		<?php if (is_home() && !is_paged() ) : ?>
		<div class="intro-container">
			<aside class="intro">
				<div class="intro__text">
					<?php echo get_the_author_meta( 'description', 1 ); ?>
				</div>
				<div class="intro__image-container">
					<img class="intro__image"
						 src="<?php bloginfo('template_url'); ?>/images/Georgie-avatar.jpg"
						 srcset="<?php bloginfo('template_url'); ?>/images/Georgie-avatar.jpg,
								 <?php bloginfo('template_url'); ?>/images/Georgie-avatar@2x.jpg 2x"
						 alt="A photo of me, Georgie.">
				</div>
			</aside>
		</div>
		<?php endif; ?>
		<div class="site-body">
			<div class="site-content" role="main">