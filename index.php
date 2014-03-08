			<?php get_header(); ?>
			<section class="blog-listing">
			<!-- // begin the loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<!-- HTML for individual post here -->
				<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
					<h1 class="post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url"><?php the_title(); ?></a></h1>
					<footer class="post-meta" role="contentinfo">
						<meta itemprop="author" content="Georgie Luhur">
						<meta itemprop="inLanguage" content="en">
						<meta itemprop="copyrightYear" content="<?php the_time('Y') ?>">
						<meta itemprop="image thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
						<time class="post-meta-item" datetime="<?php the_time('Y-m-d') ?>T<?php the_time('H:iP') ?>" itemprop="datePublished"><?php the_time('jS F Y') ?></time>
						<p class="post-meta-item">Posted in <span itemprop="keywords"><?php the_category(', ') ?></span></p>
						<p class="post-meta-item"><a href="<?php comments_link(); ?>" itemprop="discussionUrl">
							<span itemprop="interactionCount"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></span>
						</a></p>
					</footer>
					<div class="post-content" itemprop="text">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			<!-- // end the loop -->
				<nav class="post-navigation pagination">
					<div class="post-navigation prev-link"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="post-navigation next-link"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</nav>
			<?php else : ?>
				<!-- 404 or if post not found -->
			<?php endif; ?>
			</section>
			<?php get_footer(); ?>