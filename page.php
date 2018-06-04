<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="post page" itemscope itemtype="http://schema.org/Article">
        <meta itemprop="mainEntityOfPage" itemscope itemType="https://schema.org/WebPage">
        <h1 class="post__title" itemprop="headline"><?php echo (is_page('about')) ? 'About Georgie' : the_title() ?></h1>
        <?php get_template_part( 'page-meta' ); ?>
        <div class="post__content" itemprop="articleBody">
            <?php the_content(); ?>
        </div>
    </article>
    <?php endwhile; ?>
    <?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>