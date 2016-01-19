		<?php get_header(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post" itemscope itemtype="http://schema.org/BlogPosting" role="article">
				<?php $html_title = get_post_meta($post->ID, 'html_title', true); ?>
				<h1 class="post__title" itemprop="name" role="heading"><?php if ($html_title) { echo $html_title; } else { the_title(); } ?></h1>
				<footer class="post__meta" role="contentinfo">
					<div class="post__meta-item"><time datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:iP'); ?>" itemprop="datePublished"><?php the_time('jS F Y'); ?></time></div>
					<div class="post__meta-item">Posted in <span itemprop="keywords"><?php the_category(', '); ?></span></div>
					<div class="post__meta-item">
						<a href="<?php comments_link(); ?>" itemprop="discussionUrl">
							<span itemprop="interactionCount"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></span>
						</a>
					</div>
					<meta itemprop="author" content="<?php the_author(); ?>">
					<meta itemprop="inLanguage" content="en">
					<meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
					<meta itemprop="url" content="<?php echo get_permalink(); ?>">
					<meta itemprop="commentCount" content="<?php echo get_comments_number(); ?>">
					<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
					<meta itemprop="thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
					<?php image_url_meta(); ?>
				</footer>
				<div class="post__content" itemprop="text">
					<?php the_content(); ?>
				</div>
			</article>
			<nav class="pagination">
				<?php previous_post_link('<div class="pagination__item-container pagination__item-container--left">%link</div>',
					$link='<div class="pagination__item">
						<span class="pagination__arrow" role="presentation" aria-hidden="true">&laquo;</span>
						<div class="pagination__link-container">
							<span class="pagination__link-label">Previous post</span>
							<span class="pagination__link-text">%title</span>
						</div>
					</div>');
				?>
				<?php next_post_link('<div class="pagination__item-container pagination__item-container--right">%link</div>',
					$link='<div class="pagination__item">
						<span class="pagination__arrow" role="presentation" aria-hidden="true">&raquo;</span>
						<div class="pagination__link-container">
							<span class="pagination__link-label">Next post</span>
							<span class="pagination__link-text">%title</span>
						</div>
					</div>');
				?>
			</nav>
			<?php comments_template(); ?>
			<?php endwhile; ?>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>