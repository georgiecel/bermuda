<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <meta itemprop="mainEntityOfPage" itemscope itemType="https://schema.org/WebPage">
        <?php $html_title = get_post_meta($post->ID, 'html_title', true); ?>
        <h1 class="post__title" itemprop="headline"><?php if ($html_title) { echo $html_title; } else { the_title(); } ?></h1>
        <?php get_template_part( 'single-meta' ); ?>
        <div class="post__content" itemprop="text">
            <?php the_content(); ?>
        </div>
    </article>
    <nav class="c-pagination c-pagination--post l-spacing-inner--large">
        <?php previous_post_link('%link',
            $link='<span class="c-pagination-item__label">Previous post</span>
                <span class="c-pagination-item__title">%title</span>');
        ?>
        <?php next_post_link('%link',
            $link='<span class="c-pagination-item__label">Next post</span>
                <span class="c-pagination-item__title">%title</span>');
        ?>
    </nav>
    <?php comments_template(); ?>
    <?php endwhile; ?>
    <?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>