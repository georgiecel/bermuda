		<?php get_header(); ?>
			<section class="search-listing post-listing">
			<?php $posts=query_posts($query_string . '&posts_per_page=20&order=DESC&orderby=date'); ?>
		<?php if (have_posts()) : ?>
				<!-- Search results introduction -->
				<h1 class="post-title">Search Results</h1>
				<p class="search-listing-intro">Your search for <strong><mark class="search-highlight"><?php echo wp_specialchars($s); ?></mark></strong> returned the following results. Results are displayed newest first, only showing a 80-or-so-word formatting-limited summary of the beginning of the post or page. Instances of your search term are <mark class="search-highlight">highlighted</mark>.</p>
			<?php while (have_posts()) : the_post(); ?>
				<!-- HTML for each search result -->
				<article class="post">
					<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title"><?php search_title_highlight(); ?></a></h1>
					<div class="post-content">
						<?php search_excerpt_highlight(80); ?>
						<p>
							<a class="btn more-link" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read more of this post &raquo;</a>
						</p>
					</div>
				</article>
			<?php endwhile; ?>
			</section>
			<nav class="post-navigation pagination">
				<?php next_posts_link('&laquo; Older Entries') ?>
				<?php previous_posts_link('Newer Entries &raquo;') ?>
			</nav>
			<?php else : ?>
				<article class="post error-post">
					<h1 class="post-title">Search Results</h1>
					<p>Sorry, your search for <em><?php echo wp_specialchars($s); ?></em> did not return any results.</p>	
					<h2>Browse blog categories</h2>
					<ul class="blog-category-list">
						<?php wp_list_categories('title_li=&show_count=1'); ?>
					</ul>
				</article>
		<?php endif; ?>
		<?php get_footer(); ?>