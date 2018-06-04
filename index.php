<?php
    get_header();
    if (is_home() && !is_paged() ) :
        get_template_part( 'index-intro' );
    endif;
    if ( have_posts() ) :
?>
<section class="c-box-listing c-box-listing--home">
<?php
    $postCount = 0;
    while ( have_posts() ) :
    the_post();
    $image = get_first_image();
    $postCount++;
?>
    <a
        class="c-box"
        href="<?php echo get_permalink(); ?>"
        style="background-image: url('<?php echo $image; ?>')"
    >
        <div class="c-box-info">
            <span class="c-box-info__subtitle">
                <?php
                    if ( $postCount == 1 && !is_paged() ) :
                    echo 'Latest post';
                    else :
                    echo the_time('j F Y');
                ?>
            </span>
            <?php endif; ?>
            <h2 class="c-box-info__title"><?php echo the_title(); ?></h2>
        </div>
    </a>
<?php endwhile; ?>
</section>
<?php
    if (get_next_posts_link() || get_previous_posts_link()) :
    echo '<nav class="c-pagination l-spacing-inner--large">';
    next_posts_link('Older posts');
    previous_posts_link('Newer posts');
    echo '</nav>';
    endif;
    endif;
    get_footer();
?>