<?php 
	// Template Name: Archives
	get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
	<article class="post page" itemscope itemtype="http://schema.org/Article" role="article">
		<h1 class="post-title" itemprop="name" role="heading">Post Archive</h1>
		<meta itemprop="author" content="<?php the_author(); ?>">
		<meta itemprop="inLanguage" content="en">
		<meta itemprop="url" content="<?php echo get_permalink(); ?>">
		<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
		<div class="post-content" itemprop="articleBody">
			<h2>Authors</h2>
			<ul>
				<?php wp_list_authors('exclude_admin=0&optioncount=1'); ?>
			</ul>
			<h2>Archives by month</h2>
				<p><?php wp_get_archives('type=monthly&format=custom&after= |'); ?></p>
			<?php the_content(); ?>
			<?php edit_post_link('Click here to edit this page (admin).'); ?>
		</div>
	</article>
<?php 
	endwhile;
	else :
	endif;
	get_footer(); 
?>