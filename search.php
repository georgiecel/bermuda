<?php get_header(); ?>
<section class="l-listing l-spacing-outer">
    <div class="l-listing__intro">
    <?php
        $posts=query_posts($query_string . '&posts_per_page=18&order=DESC&orderby=date');
        if ( have_posts() ) :
    ?>
        <h1 class="l-listing__heading">Search Results</h1>
        <p>Your search for <mark><?php echo wp_specialchars($s); ?></mark> returned the following results. In each of these posts the term <strong><?php echo wp_specialchars($s); ?></strong> appeared at least once in the body content. Results are displayed newest first.</p>
    </div>
    <div class="c-box-listing">
    <?php
        while (have_posts()) : the_post();
        get_template_part( 'listing-card' );    
        endwhile;
    ?>
    </div>
</section>
<?php
    if (get_next_posts_link() || get_previous_posts_link()) :
    echo '<nav class="c-pagination l-spacing-inner--large">';
    next_posts_link('Older posts');
    previous_posts_link('Newer posts');
    echo '</nav>';
    endif;
    else :
?>
    <h1 class="l-listing__heading">You searched for <mark><?php echo wp_specialchars($s); ?></mark>&hellip;</h1>
    <p>Sorry! 😢 <mark><?php echo wp_specialchars($s); ?></mark> did not return any results. Apparently I’ve never blogged about or mentioned such a thing in any of my posts, but if you think <strong><?php echo wp_specialchars($s); ?></strong> is an amazing topic to blog about, by all means <a href="mailto:searchresult@georgie.nu">let me know</a>!</p>
    <p>If you’re lost, <a href="<?php echo site_url(); ?>">the homepage</a> displays my most recent posts. If you’re feeling particularly daring, there’s a list of my blog categories below.</p>
    <h2>Browse blog categories</h2>
    <ul class="blog-category-list">
        <?php wp_list_categories('title_li=&show_count=1'); ?>
    </ul>
<?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>