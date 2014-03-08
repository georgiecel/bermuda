		<?php get_header(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post page" itemscope itemtype="http://schema.org/Article">
				<?php if ( is_page('about') ) {
						echo '<h1 class="post-title" itemprop="name">About Georgie</h1>';
					} else {
						echo '<h1 class="post-title" itemprop="name">', the_title(), '</h1>';
					}
				?>
				<footer class="post-meta" role="contentinfo">
					<meta itemprop="author" content="Georgie Luhur">
					<meta itemprop="inLanguage" content="en">
					<meta itemprop="copyrightYear" content="<?php the_time('Y') ?>">
					<meta itemprop="url" content="<?php echo get_permalink(); ?>">
					<meta itemprop="wordCount" content="<?php echo wcount(); ?>">
				</footer>
				<div class="post-content" itemprop="articleBody">
					<?php the_content(); ?>
					<?php edit_post_link('Click here to edit this page (admin).'); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>