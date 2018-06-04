<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, width=device-width">
        <title>Oopsies. The page you were after does not exist.</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon-g.ico">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/error.min.css" type="text/css" media="screen">
    </head>
    <body>
        <div class="site-error">
            <h1 class="site-error__title">
            <?php
                $quotes[] = "Not another error page&hellip;";
                $quotes[] = "Woah nelly.";
                $quotes[] = "Uh oh! Spaghettio";
                $quotes[] = "Ruh oh.";
                $quotes[] = "Whoopsy-daisy.";
                $quotes[] = "Womp womp.";
                $quotes[] = "Planet does not exist in this solar system.";
                $quotes[] = "Fancy meeting you here.";
                srand ((double) microtime() * 99999999999999);
                $randomquote = rand(0,count($quotes)-1);
                echo " " . $quotes[$randomquote] . " ";
            ?></h1>
            <p>The webpage you were after doesn’t exist, or was moved or deleted.</p>
            <div class="c-action">
                <p><a href="<?php echo site_url(); ?>">return to the Hey Georgie homepage</a> 🚀 or search below:</p>
                <form method="get" id="searchform" class="c-search-form" action="<?php bloginfo('url'); ?>/">
                    <label class="c-search-form__label u-visually-hidden" for="s">Search</label>
                    <input class="c-search-form__input" type="search" onblur="if (this.value == '') {this.value = 'Search my blog...';}" onfocus="if (this.value == 'Search my blog...') {this.value = '';}" value="Search my blog..." placeholder="Type a few words to search" name="s" id="s">
                    <button type="submit" class="c-button">Search</button>
                </form>
            </div>
            <p>Please <a href="mailto:404@georgie.nu">let me know</a> if you came to this page via a broken link on my website, so I can update it.</p>
            <p>Not sure where to go? Check out some posts in <a href="/category/fashion/">Fashion</a>, <a href="/category/travel/">Travel</a>, the <a href="/category/hey-girlfriend/">Hey Girlfriend!</a> interview series, or a curated list of my <a href="/best/">Best posts</a>. ✨</p>
            </ul>
        </div>
    </body>
</html>