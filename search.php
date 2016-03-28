<?php get_header(); ?>
	<section class="post-listing post-listing--search">
	<?php $posts=query_posts($query_string . '&posts_per_page=20&order=DESC&orderby=date'); ?>
<?php if (have_posts()) : ?>
		<div class="post-listing__intro">
			<h1 class="post__title">Search Results</h1>
			<p>Your search for <mark class="search-highlight"><?php echo wp_specialchars($s); ?></mark> returned the following results. Results are displayed newest first, only showing a 80-or-so-word formatting-limited summary of the beginning of the post or page. Instances of your search term are <mark class="search-highlight">highlighted</mark>.</p>
		</div>
		<?php while (have_posts()) : the_post(); ?>
		<article class="post">
			<h1 class="post-summary__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php search_title_highlight(); ?></a></h1>
			<div class="post__content">
				<?php search_excerpt_highlight(80); ?>
				<div class="post__cta-container"><a class="post__cta" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read more of this post &raquo;</a></div>
			</div>
		</article>
	<?php endwhile; ?>
	</section>
	<nav class="pagination pagination--home" role="navigation">
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
		<article class="post error-post">
			<h1 class="post__title">Search Results</h1>
			<p>Sorry, your search for <em><?php echo wp_specialchars($s); ?></em> did not return any results.</p>
			<h2>Browse blog categories</h2>
			<ul class="blog-category-list">
				<?php wp_list_categories('title_li=&show_count=1'); ?>
			</ul>
		</article>
<?php endif; ?>
<?php get_footer(); ?>