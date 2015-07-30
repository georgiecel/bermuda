		<?php get_header(); ?>
			<section class="blog-listing post-listing category-listing">
				<div class="category-listing-intro">
					<h1 class="category-title post-title">Category: <?php single_cat_title(); ?></h1>
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
				<?php if ( has_post_thumbnail() ) { ?>
					<figure class="post-thumbnail"><?php the_post_thumbnail(); ?></figure>
				<?php } ?>
					<h1 class="post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title" itemprop="url" role="heading"><?php the_title(); ?></a></h1>
					<footer class="post-meta" role="complementary">
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
						<meta itemprop="thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
						<?php image_url_meta(); ?>
					</footer>
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