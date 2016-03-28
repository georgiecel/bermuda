		<?php get_header(); ?>
			<section class="post-listing post-listing--category">
				<div class="post-listing__intro">
					<h1 class="post__title">Category: <?php single_cat_title(); ?></h1>
					<?php if ( category_description() ) :
						echo category_description();
						else : ?>
						<p>You are currently viewing the <strong><?php single_cat_title(); ?></strong> category. This category doesn’t have a fancy custom description yet, probably because:</p>
						<ul>
							<li>It doesn’t really need one because it’s self-explanatory.</li>
							<li>I haven’t gotten around to it yet because it’s new.</li>
						</ul>
					<?php endif; ?>
				</div>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="post" itemscope itemtype="http://schema.org/BlogPosting" role="article">
					<h1 class="post-summary__title" itemprop="name"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" itemprop="url"><?php the_title(); ?></a></h1>
					<footer class="post__meta" role="contentinfo">
						<time class="post__meta-item" datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:iP'); ?>" itemprop="datePublished"><?php the_time('jS F Y'); ?></time>
						<meta itemprop="author" content="<?php the_author(); ?>">
						<meta itemprop="inLanguage" content="en">
						<meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
						<meta itemprop="thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
						<?php image_url_meta(); ?>
					</footer>
					<div class="post__content" itemprop="text">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			</section>
			<nav class="pagination pagination--home" role="navigation" aria-label="Category archive">
				<?php previous_posts_link('<div class="pagination__item-container pagination__item-container--left">
						<div class="pagination__item">
							<span class="pagination__arrow" role="presentation" aria-hidden="true">&laquo;</span>
							<div class="pagination__link-container">
								<span class="pagination__link-text">Newer posts</span>
							</div>
						</div>
					</div>');
				?>
				<?php next_posts_link('<div class="pagination__item-container pagination__item-container--right">
						<div class="pagination__item">
							<span class="pagination__arrow" role="presentation" aria-hidden="true">&raquo;</span>
							<div class="pagination__link-container">
								<span class="pagination__link-text">Older posts</span>
							</div>
						</div>
					</div>');
				?>
			</nav>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>