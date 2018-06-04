<?php get_header(); ?>
<section class="l-listing l-spacing-outer">
<?php if ( have_posts() ) : ?>
    <div class="l-listing__intro">
        <h1 class="l-listing__heading"><?php single_cat_title(); ?></h1>
        <?php
            if ( category_description() ) :
                echo category_description();
                echo '<i>Each image links to a different post in this category.</i>';
            else :
        ?>
            <p>You are currently viewing the <strong><?php single_cat_title(); ?></strong> category. This category doesn’t have a fancy custom description yet, probably because:</p>
            <ul>
                <li>It doesn’t really need one because it’s self-explanatory.</li>
                <li>I haven’t gotten around to it yet because it’s new.</li>
            </ul>
        <?php endif; ?>
    </div>
    <div class="c-box-listing">
    <?php
        while ( have_posts() ) : the_post();
        if ( is_category('Fashion Friday') ) { 
            $title = get_the_title($post->id);
            $trimmed_title = str_replace('Fashion Friday: ', '', $title);
        }
        if ( is_category('Hey Girlfriend!') ) { 
            $title = get_the_title($post->id);
            $trimmed_title = str_replace('Hey Girlfriend!: ', '', $title);
        }
        if ( is_category('Timeless Thoughts') ) { 
            $title = get_the_title($post->id);
            $trimmed_title = str_replace('Timeless Thoughts: ', '', $title);
        }
        get_template_part( 'listing-card' );
        endwhile;
    ?>
    </div>
</section>
<?php
    if (get_next_posts_link() || get_previous_posts_link()) :
    echo '<nav class="c-pagination l-spacing-inner--large">';
    $link = ' posts <span class="c-pagination-item__label">in <span class="c-pagination-item__title">' . get_the_archive_title() . '</span></span>';
    next_posts_link('Older' . $link);
    previous_posts_link('Newer' . $link);
    echo '</nav>';
    endif;
    endif;
    get_footer();
?>