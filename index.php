			<?php get_header(); ?>
			<section class="blog-listing">
			<!-- // begin the loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<!-- HTML for individual post here -->
				<article class="blog-post" itemscope itemtype="http://schema.org/BlogPosting">
					<h1 class="blog-post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url"><?php the_title(); ?></a></h1>
					<footer class="blog-post-meta" role="contentinfo">
						<meta itemprop="author" content="Georgie Luhur">
						<meta itemprop="inLanguage" content="en">
						<meta itemprop="copyrightYear" content="<?php the_time('Y') ?>">
						<meta itemprop="image thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
						<time class="blog-post-meta-item" datetime="<?php the_time('Y-m-d') ?>T<?php the_time('H:iP') ?>" itemprop="datePublished"><?php the_time('jS F Y') ?></time>
						<p class="blog-post-meta-item">Posted in <span itemprop="keywords"><?php the_category(', ') ?></span></p>
						<p class="blog-post-meta-item"><a href="<?php comments_link(); ?>" itemprop="discussionUrl">
							<span itemprop="interactionCount"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></span>
						</a></p>
					</footer>
					<div class="blog-post-content" itemprop="text">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			<!-- // end the loop -->
			<?php else : ?>
				<!-- 404 or if post not found -->
			<?php endif; ?>
			</section>
			<?php get_footer(); ?>