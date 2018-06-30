<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Cache-control" content="public">
        <meta charset="utf-8">
        <meta name="description" content="<?php meta_desc(); ?>">
        <meta name="viewport" content="initial-scale=1.0, width=device-width">
        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css?<?php echo date('Ymdhi', filemtime( get_stylesheet_directory() . '/style.min.css' )); ?>" type="text/css" media="screen">
        <link rel="dns-prefetch" href="//fonts.googleapis.com/">
        <link rel="prefetch" href="//cdn.jsdelivr.net/font-hack/2.019/css/hack.min.css">
        <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/icon.png">
        <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/images/icon.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/icon.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/icon.png">
        <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon-g.ico">
        <meta name="application-name" content="Hey Georgie">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-square70x70logo" content="<?php bloginfo('template_url'); ?>/images/small.png">
        <meta name="msapplication-square150x150logo" content="<?php bloginfo('template_url'); ?>/images/medium.png">
        <meta name="msapplication-wide310x150logo" content="<?php bloginfo('template_url'); ?>/images/wide.png">
        <meta name="msapplication-square310x310logo" content="<?php bloginfo('template_url'); ?>/images/large.png">
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
        <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">       
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
    <body id="site-top">
        <a class="c-skip-link" href="#main-content">Skip to content</a>
        <div class="c-logo-wrapper">
            <a href="<?php echo site_url(); ?>">
                <span class="u-visually-hidden">Go to homepage</span>
                <img
                    class="c-logo"
                    src="<?php bloginfo('template_url'); ?>/images/site-logo.svg"
                    alt="Logo for <?php bloginfo('name'); ?>"
                >
            </a>
        </div>
        <?php get_search_form(); ?>
        <div class="l-main-grid">
            <div class="l-sidebar">
                <nav>
                    <ul aria-label="The main sub-pages of this blog" class="c-navigation">
                        <?php wp_nav_menu( array(
                            'menu' => 'main-navigation',
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'walker' => new menu_walker
                        ) ); ?>
                    </ul>
                </nav>
            </div>
            <div
                <?php if (is_home()) : ?>
                class="l-listing-wrapper l-listing-wrapper--homepage"
                <?php elseif (is_single() || is_page()) : ?>
                class="l-post-wrapper"
                <?php elseif (is_category() || is_tag() || is_search() || is_archive()) : ?>
                class="l-listing-wrapper"
                <?php endif; ?>
                id="main-content"
                role="main"
            >