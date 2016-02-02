		<?php get_header(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post page" itemscope itemtype="http://schema.org/Article" role="article">
				<?php if ( is_page('about') ) {
						echo '<h1 class="post__title" itemprop="name" role="heading">About Georgie</h1>';
					} else {
						echo '<h1 class="post__title" itemprop="name" role="heading">', the_title(), '</h1>';
					}
				?>
				<meta itemprop="author" content="<?php the_author(); ?>">
				<meta itemprop="inLanguage" content="en">
				<meta itemprop="url" content="<?php echo get_permalink(); ?>">
				<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
				<div class="post__content" itemprop="articleBody">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>