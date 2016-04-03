<?php get_header(); ?>
	<article class="post page" itemscope itemtype="http://schema.org/Article">
		<h1 class="post__title" itemprop="name">Post Archive</h1>
		<meta itemprop="author" content="<?php the_author(); ?>">
		<meta itemprop="inLanguage" content="en">
		<meta itemprop="url" content="<?php echo get_permalink(); ?>">
		<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
		<div class="post__content" itemprop="articleBody">
			<?php the_content(); ?>
			<h2>Last ten posts</h2>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=10'); ?>
			</ul>
			<h2>Authors</h2>
			<ul>
				<?php wp_list_authors('optioncount=1'); ?>
			</ul>
			<h2>Archives by year</h2>
			<ul>
				<?php wp_get_archives('type=yearly&show_post_count=1'); ?>
			</ul>
			<h2>Archives by month</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
			<h2>Categories</h2>
			<ul>
				<?php wp_list_categories('title_li=&hierarchical=1&exclude=261'); ?>
			</ul>
		</div>
	</article>
<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	endwhile;
	else :
	endif;
	get_footer(); 
?>