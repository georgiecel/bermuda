			<?php get_header(); ?>
			<!-- // begin the loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<!-- HTML for individual post here -->
			<?php endwhile; ?>
			<!-- // end the loop -->
			<?php else : ?>
				<!-- 404 or if post not found -->
			<?php endif; ?>
			<?php get_footer(); ?>