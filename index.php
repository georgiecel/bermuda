		<?php get_header(); ?>
			<section class="homepage-listing post-listing">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
					<?php $html_title = get_post_meta($post->ID, 'html_title', true); ?>
					<h2 class="post-summary__title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" itemprop="url"><?php if ($html_title) { echo $html_title; } else { the_title(); } ?></a></h2>
					<div class="post__meta-item">
						<time datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:iP'); ?>" itemprop="datePublished"><?php the_time('jS F Y'); ?></time>
					</div>
					<meta itemprop="author" content="<?php the_author(); ?>">
					<meta itemprop="inLanguage" content="en">
					<meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
					<meta itemprop="commentCount" content="<?php echo get_comments_number(); ?>">
					<meta itemprop="thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
					<?php image_url_meta(); ?>
					<div class="post-summary__content" itemprop="text">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			</section>
			<nav class="pagination pagination--home">
				<?php previous_posts_link('<div class="pagination__item-container pagination__item-container--left">
						<div class="pagination__item">
							<span class="pagination__arrow" role="presentation" aria-hidden="true">&laquo;</span>
							<div class="pagination__link-container">
								<span class="pagination__link-label">Newer posts</span>
							</div>
						</div>
					</div>');
				?>
				<?php next_posts_link('<div class="pagination__item-container pagination__item-container--right">
						<div class="pagination__item">
							<span class="pagination__arrow" role="presentation" aria-hidden="true">&raquo;</span>
							<div class="pagination__link-container">
								<span class="pagination__link-label">Older posts</span>
							</div>
						</div>
					</div>');
				?>
			</nav>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>