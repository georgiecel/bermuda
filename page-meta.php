<meta itemprop="author" content="<?php the_author(); ?>">
<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d') . 'T' . get_the_date('H:iP'); ?>">
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