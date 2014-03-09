<?php

	// post thumbnail inclusion

	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, false );
	}

	// adjusting HTML for image caption shortcode

	add_filter('img_caption_shortcode', 'caption_shortcode', 10, 3);

	function caption_shortcode($val, $attr, $content = null) {
		extract(shortcode_atts(array('id'=> '','align'=> 'aligncenter','width'=> '','caption' => ''), $attr));
		
		if ( 1 > (int) $width || empty($caption) )return $val;
		$capid = '';
		
		if ( $id ) {
			$id = esc_attr($id);
			$capid = 'id="figcaption_'. $id . '" ';
			$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
		}

		return '<figure ' . $id . 'class="post-figure figure-' . esc_attr($align) . ' ' . esc_attr($align) . '" style="width: '. (int) $width . 'px">' 
			. do_shortcode( $content ) . '<figcaption ' . $capid . 'class="post-figcaption">' . $caption . '</figcaption></figure>';
	}	

	// word count function

	function wordcount() {
		ob_start();
		the_content();
		$postcontent = ob_get_clean();
		return sizeof(explode(" ", $postcontent));
	}

	// awesome semantic comment

	function better_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		if ( 'article' == $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		}

		?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
			<figure class="gravatar"><?php echo get_avatar( $comment, 65, 'http://hey.georgie.nu/wp-content/themes/heygeorgie/images/bg.png', 'Author’s gravatar' ); ?></figure>
			<div class="comment-meta post-meta" role="complementary">
				<h2 class="comment-author">
					<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
				</h2>
				<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
				<?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<p class="comment-meta-item">Your comment is awaiting moderation.</p>
				<?php endif; ?>
			</div>
			<div class="comment-content post-content" itemprop="text">
				<?php comment_text() ?>
				<div class="comment-reply">
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		<?php }

	// end of awesome semantic comment

	function better_comment_close() {
		echo '</article>';
	}

	class comment_walker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		/** CONSTRUCTOR
		* You'll have to use this if you plan to get to the top of the comments list, as
		* start_lvl() only goes as high as 1 deep nested comments */
		function __construct() { ?>

			<section class="comments">

		<?php }

		/** START_LVL
	     * Starts the list before the CHILD elements are added. */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
			
			<section class="child-comments comments-list">

		<?php }
	
		/** END_LVL
		 * Ends the children list of after the elements are added. */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			</section><!-- /.children -->
 
		<?php }

		/** START_EL */
		function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>

			<article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
				<figure class="gravatar"><?php echo get_avatar( $comment, 65, 'http://hey.georgie.nu/wp-content/themes/heygeorgie/images/bg.png', 'Author’s gravatar' ); ?></figure>
				<div class="comment-meta post-meta" role="complementary">
					<h2 class="comment-author">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
					</h2>
					<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
					<?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
					<?php if ($comment->comment_approved == '0') : ?>
					<p class="comment-meta-item">Your comment is awaiting moderation.</p>
					<?php endif; ?>
				</div>
				<div class="comment-content post-content" itemprop="text">
					<?php comment_text() ?>
					<div class="comment-reply">
						<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
				</div>			

		<?php }		

		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</article><!-- /#comment-' . get_comment_ID() . ' -->

		<?php }

		/** DESTRUCTOR */
		function __destruct() { ?>

			</section><!-- /#comment-list -->
		
		<?php }

	}

?>