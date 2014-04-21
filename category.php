		<?php get_header(); ?>
			<section class="blog-listing post-listing">
			<!-- Category descriptions -->
			<h1 class="post-title">Category: <?php single_cat_title(); ?></h1>
			<?php if (is_category('Things I Miss')) : ?>
			<p><strong>Things I Miss</strong> is an occasional segment about things that I miss. It could include places I have been, things I bought as a child, things I used to do, things that have become obsolete or are no longer produced like old television shows, foods, toys, and the like.</p>
			<?php elseif (is_category('2 minutes and 40 seconds')) : ?>
			<p><strong>2 minutes and 40 seconds</strong> is an interview segment in which I interview people from any walk of life, and ask them questions outside of the traditional interview format to reveal random facts, suss out their quirks, and provide an enjoyable read. To find out more about this segment, <a href="/2-minutes-40-seconds/">read this page</a>.</p>
			<p>A new ‘2 minutes and 40 seconds’ is posted every second Thursday.</p>
			<?php elseif (is_category('Fashion Friday')) : ?>
			<p><strong>Fashion Friday</strong> is an fashion segment I started in 2013, where I share outfits or items related to fashion and beauty.</p>
			<p>There used to be a new post each month, on average, but now occurs every second Friday. Some older posts have been posted on Saturday rather than Friday, due to timezones, but are now more consistent.</p>
			<p>I would like to thank one of my best friends <a href="http://alonelyseptember.org">Seb</a> for having the time and patience to photograph in some of the more recent posts.</p>
			<?php else : ?>
			<p>You are currently viewing the <strong><?php single_cat_title(); ?></strong> category.</p>
			<?php endif; ?>
			<!-- // begin the loop -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<!-- HTML for individual post here -->
				<article class="post" itemscope itemtype="http://schema.org/BlogPosting" role="article">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-thumbnail-wrapper">
						<figure class="post-thumbnail"><?php the_post_thumbnail(); ?></figure>
					</div>
				<?php } ?>
					<h1 class="post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url" role="heading"><?php the_title(); ?></a></h1>
					<footer class="post-meta" role="complementary">
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
						<?php the_content('','[...]'); ?>
					</div>
				</article>
			<?php endwhile; ?>
			</section>
			<!-- // end the loop -->
				<nav class="post-navigation pagination">
					<?php next_posts_link('&laquo; Older Entries') ?>
					<?php previous_posts_link('Newer Entries &raquo;') ?>
				</nav>
			<?php else : ?>
				<!-- 404 or if post not found -->
		<?php endif; ?>
		<?php get_footer(); ?>