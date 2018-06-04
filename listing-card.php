<a
    class="c-box"
    href="<?php the_permalink() ?>"
    style="background-image: url('<?php echo get_first_image(); ?>')"
    title="Permanent Link to <?php the_title_attribute(); ?>"
>
    <div class="c-box-info">
        <div class="c-box-info__subtitle"><?php the_time('F Y'); ?></div>
        <div class="c-box-info__title"><?php echo $trimmed_title ?: the_title(); ?></div>
    </div>
</a>