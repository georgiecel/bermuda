<?php get_header(); ?>
<section class="l-listing l-spacing-outer">
<?php if ( have_posts() ) : ?>
    <div class="l-listing__intro">
        <h1 class="l-listing__heading">Archives for <?php echo get_the_archive_title(); ?></h1>
    </div>
    <div class="c-box-listing">
    <?php
        while ( have_posts() ) : the_post();
        get_template_part( 'listing-card' );
        endwhile;
    ?>
    </div>
</section>
<nav class="c-pagination l-spacing-inner--large">
    <?php
        if (get_next_posts_link() || get_previous_posts_link()) :
        next_posts_link('Older posts');
        previous_posts_link('Newer posts');
        endif;
    ?>
</nav>
<?php
    else :
    endif;
    get_footer();
?>
