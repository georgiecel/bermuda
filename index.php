		<?php get_header(); ?>
			<section class="homepage-listing post-listing">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="post" itemscope itemtype="http://schema.org/BlogPosting" role="article">
					<h1 class="post-summary__title" itemprop="name" role="heading"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url"><?php the_title(); ?></a></h1>
					<time class="post-meta-item" datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:iP'); ?>" itemprop="datePublished"><?php the_time('jS F Y'); ?></time>
					<meta itemprop="author" content="<?php the_author(); ?>">
					<meta itemprop="inLanguage" content="en">
					<meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
					<meta itemprop="commentCount" content="<?php echo get_comments_number(); ?>">
					<meta itemprop="thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
					<?php image_url_meta(); ?>
					<div class="post-content" itemprop="text">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			</section>
				<nav class="pagination">
					<?php next_posts_link('&laquo; Older Entries'); ?>
					<?php previous_posts_link('Newer Entries &raquo;'); ?>
				</nav>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>