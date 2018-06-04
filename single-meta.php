<footer class="post__meta">
	<time aria-label="Time stamp of blog post" class="post__meta-item" datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_date('H:iP'); ?>" itemprop="datePublished"><?php the_time('j F Y'); ?></time>
	<div class="post__meta-item">Posted in <span itemprop="keywords"><?php the_category(', '); ?></span></div>
	<div class="post__meta-item">
		<a href="<?php comments_link(); ?>" itemprop="discussionUrl"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></a>
	</div>
	<meta itemprop="author" content="<?php the_author(); ?>">
    <meta itemprop="commentCount" content="<?php echo get_comments_number(); ?>">
    <meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
    <meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-m-d') . 'T' . get_the_modified_date('H:iP'); ?>">
    <?php image_url_meta(); ?>
    <meta itemprop="inLanguage" content="en">
    <span
        class="u-hidden"
        itemprop="publisher"
        itemscope itemtype="http://schema.org/Organization"
    >
        <span itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
            <meta itemprop="url" content="<?php echo $sitelogo ?>">
        </span>
        <meta itemprop="name" content="<?php bloginfo('name'); ?>">
        <meta itemprop="url" content="<?php bloginfo('url'); ?>">
    </span>
	<meta itemprop="url" content="<?php echo get_permalink(); ?>">
	<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
</footer>