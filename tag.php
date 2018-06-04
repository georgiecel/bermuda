<?php get_header(); ?>
<section class="l-listing l-spacing-outer">
    <div class="l-listing__intro">
        <h1 class="l-listing__heading"><code>#<?php single_cat_title(); ?></code></h1>
        <?php if ( category_description() ) :
            echo category_description();
            else : ?>
        <p>You are currently viewing the tag <strong>#<?php single_cat_title(); ?></strong>. This tag doesn’t have a fancy custom description yet, probably because:</p>
        <ul>
            <li>It doesn’t really need one because it’s self-explanatory.</li>
            <li>I haven’t gotten around to it yet because it’s new.</li>
        </ul>
        <?php endif; ?>
    </div>
    <div class="c-box-listing">
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        get_template_part( 'listing-card' );
        endwhile;
    ?>
    </div>
</section>
<?php
    if (get_next_posts_link() || get_previous_posts_link()) :
    echo '<nav class="c-pagination l-spacing-inner--large">';
    $link = ' posts tagged with <code>' . get_the_archive_title() . '</code>';
    next_posts_link('Older' . $link);
    previous_posts_link('Newer' . $link);
    echo '</nav>';
    endif;
    endif;
    get_footer();
?>