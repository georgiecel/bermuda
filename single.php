		<?php get_header(); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
					<meta itemprop="url" content="<?php echo get_permalink(); ?>">
					<meta itemprop="wordCount" content="<?php echo wordcount(); ?>">
					<meta itemprop="image thumbnailUrl" content="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>">
					<time class="post-meta-item" datetime="<?php the_time('Y-m-d') ?>T<?php the_time('H:iP') ?>" itemprop="datePublished"><?php the_time('jS F Y') ?></time>
					<p class="post-meta-item">Posted in <span itemprop="keywords"><?php the_category(', ') ?></span></p>
					<p class="post-meta-item"><a href="<?php comments_link(); ?>" itemprop="discussionUrl">
						<span itemprop="interactionCount"><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></span>
					</a></p>
				</footer>
				<div class="post-content" itemprop="text">
					<?php the_content(); ?>
					<?php edit_post_link('Click here to edit this entry (admin).'); ?>
				</div>
			</article>
			<nav class="post-navigation post-pagination pagination">
				<?php next_post_link('<div class="next-link-wrapper">
					Next post<br>','%link', $link='%title &raquo;','</div>') ?>
				<?php previous_post_link('<div class="prev-link-wrapper">
					Previous post<br>','%link', $link='&laquo; %title','</div>') ?>
			</nav>
			<?php comments_template(); ?>
			<?php endwhile; ?>
			<?php else : ?>
		<?php endif; ?>
		<?php get_footer(); ?>