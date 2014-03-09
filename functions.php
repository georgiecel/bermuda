<?php

	// remove rel attribute from the category list

	function remove_category_list_rel($output){
		$output = str_replace(' rel="category tag"', '', $output);
		return $output;
	}

	add_filter('wp_list_categories', 'remove_category_list_rel');
	add_filter('the_category', 'remove_category_list_rel');

	// use nice search 

	function roots_nice_search_redirect() {
		global $wp_rewrite;
		if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
 			return;
		}

		$search_base = $wp_rewrite->search_base;
		if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
			wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    		exit();
		}
	}

	if (current_theme_supports('nice-search')) {
		add_action('template_redirect', 'roots_nice_search_redirect');
	}

	// search highlight 

	function search_excerpt_highlight() {
		$excerpt = get_the_excerpt();
		$keys = implode('|', explode(' ', get_search_query()));
		$excerpt = preg_replace('/(' . $keys .')/iu', '<mark class="search-highlight">\0</mark>', $excerpt);
	
		echo '<p>' . $excerpt . '</p>';
	}

	function search_title_highlight() {
		$title = get_the_title();
		$keys = implode('|', explode(' ', get_search_query()));
		$title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

		echo $title;
	}

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

	class comment_walker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>

			<section class="comments-list">

		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
			
			<section class="child-comments comments-list">

		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			</section>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			} ?>

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
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>

		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</article>

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>

			</section>
		
		<?php }

	}

	// remove unnecessary bloaty things in the header

	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// remove unnecessary self-closing tags
	
	function remove_self_closing_tags($input) {
		return str_replace(' />', '>', $input);
	}

	add_filter('get_avatar', 'remove_self_closing_tags'); // <img />
	add_filter('comment_id_fields', 'remove_self_closing_tags'); // <input />
	add_filter('post_thumbnail_html', 'remove_self_closing_tags'); // <img />

?>