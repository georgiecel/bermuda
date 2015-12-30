		<?php get_header(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post" itemscope itemtype="http://schema.org/BlogPosting" role="article">
				<h1 class="post-title" itemprop="name" role="heading"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url"><?php if ($html_title) { echo $html_title; } else { the_title(); } ?></a></h1>
				<footer class="post-meta" role="contentinfo">
					<time class="post-meta-item" datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:iP'); ?>" itemprop="datePublished"><?php the_time('jS F Y'); ?></time>
					<div class="post-meta-item">Posted in <span itemprop="keywords"><?php the_category(', '); ?></span></div>
					<div class="post-meta-item">
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
				<div class="post-content" itemprop="text">
					<?php the_content(); ?>
					<?php edit_post_link('Click here to edit this entry (admin).'); ?>
				</div>
			</article>
			<nav class="pagination">
				<?php previous_post_link('<div class="pagination-link">
					Previous post %link</div>', $link='%title'); ?>
				<?php next_post_link('<div class="pagination-link">
					Next post %link</div>', $link='%title'); ?>
			</nav>
			<?php comments_template(); ?>
			<?php endwhile; ?>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>