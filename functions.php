<?php

	// Move jQuery to footer

	function jquery_in_footer() {
		if (!is_admin()) {
			wp_deregister_script('jquery');
			// load the local copy of jQuery in the footer
			wp_register_script('jquery', home_url(trailingslashit(WPINC) . 'js/jquery/jquery.js'), false, null, true);
			wp_enqueue_script('jquery');
		}
	}

	add_action( 'init', 'jquery_in_footer' );

	// Add custom “read more” link for excerpt

	function excerpt_read_more_link( $output ) {
		global $post;
		return substr( $output, 0 ) . '<p><a href="' . get_permalink() . '#more-' . get_the_ID() . '" class="btn more-link">Continue reading &raquo;</a></p>';
	}

	add_filter( 'the_excerpt', 'excerpt_read_more_link' );

	// Strip <br> from excerpt

	function remove_br_excerpt( $content ) {
		return wpautop( $content, false );
	}

	remove_filter( 'the_excerpt', 'wpautop' );
	add_filter( 'the_excerpt', 'remove_br_excerpt' );

	// Add classes to next/previous links

	function posts_link_attributes_1() {
		return 'class="btn prev-link"';
	}

	function posts_link_attributes_2() {
		return 'class="btn next-link"';
	}

	add_filter( 'next_posts_link_attributes', 'posts_link_attributes_1' );
	add_filter( 'previous_posts_link_attributes', 'posts_link_attributes_2' );

	// Add classes to next/previous links in individual posts

	function post_link_attributes_1( $output ) {
		$code = 'class="next-post-link"';
		return str_replace('<a href=', '<a ' . $code . ' href=', $output);
	}

	function post_link_attributes_2( $output ) {
		$code = 'class="prev-post-link"';
		return str_replace('<a href=', '<a ' . $code . ' href=', $output);
	}

	add_filter( 'next_post_link', 'post_link_attributes_1' );
	add_filter( 'previous_post_link', 'post_link_attributes_2' );

	// Add class to “edit comment” link

	function custom_edit_comment_link( $output ) {
		$editcomment = 'comment-meta-item';
		return preg_replace('/comment-edit-link/', 'comment-edit-link ' . $editcomment, $output, 1);
	}

	add_filter( 'edit_comment_link', 'custom_edit_comment_link' );

	// Change “cancel reply” link to a button

	function cancel_comment_reply_button( $html, $link, $text ) {
		$style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
		$button = '<button id="cancel-comment-reply-link" class="btn cancel-comment-reply"' . $style . '>';
		return $button . $text . '</button>';
	}

	add_action( 'cancel_comment_reply_link', 'cancel_comment_reply_button', 10, 3 );

	// Use “nice” search URL

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

	if ( current_theme_supports('nice-search') ) {
		add_action( 'template_redirect', 'roots_nice_search_redirect' );
	}

	function change_search_url_rewrite() {
		if ( is_search() && ! empty( $_GET['s'] ) ) {
			wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
			exit();
		}	
	}

	add_action( 'template_redirect', 'change_search_url_rewrite' );	

	// Highlight search terms 

	function search_excerpt_highlight( $limit ) {
		$excerpt = get_the_excerpt();
		$excerpt = explode(' ', get_the_excerpt(), $limit);

		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode(' ', $excerpt);
		} else {
			$excerpt = implode(' ', $excerpt);
		}

		$excerpt = apply_filters( 'get_the_excerpt', $excerpt );

		$allowed_tags = '<p>,<br>,<mark>';
		$excerpt = strip_tags( $excerpt, $allowed_tags );

		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

		$keys = implode('|', explode(' ', get_search_query()));
		$excerpt = trim(preg_replace('/(' . $keys .')/iu', '<mark class="search-highlight">\0</mark>', $excerpt));
	
		echo '<p>' . $excerpt . ' [...]</p>';
	}

	function search_title_highlight() {
		$title = get_the_title();
		$keys = implode('|', explode(' ', get_search_query()));
		$title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

		echo $title;
	}

	// Adding post image URLs to metadata

	function image_url_meta() {
		global $post;
		$args = array(
			'post_type' => 'attachment', 
			'numberposts' => -1,
			'post_mime_type' => 'image',
			'post_status' => null,
			'post_parent' => $post->ID
		);
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ( $attachments as $attachment ) {
				echo '<meta itemprop="image" content="' . $attachment->guid . '">';
			}
		}
	}

	// Adjust HTML for image caption shortcode

	function caption_shortcode($val, $attr, $content = null) {
		extract(shortcode_atts(array('id'=> '','align'=> 'aligncenter','width'=> '','caption' => ''), $attr));
		
		if ( 1 > (int) $width || empty($caption) )return $val;
		$capid = '';
		
		if ( $id ) {
			$id = esc_attr($id);
			$capid = 'id="figcaption_'. $id . '" ';
			$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
		}

		return '<figure ' . $id . 'class="post-figure figure-' . esc_attr($align) . '" style="width: '. (int) $width . 'px">' 
			. do_shortcode( $content ) . '<figcaption ' . $capid . 'class="post-figcaption">' . $caption . '</figcaption></figure>';
	}	

	add_filter( 'img_caption_shortcode', 'caption_shortcode', 10, 3 );

	// Comment walker for comment list

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
				<figure class="comment-gravatar"><?php echo get_avatar( $comment, 65, 'http://hey.georgie.nu/wp-content/themes/hg-bermuda/favicons/small.png', 'Author’s gravatar' ); ?></figure>
				<div class="comment-meta post-meta" role="complementary">
					<h2 class="comment-author">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" rel="nofollow" itemprop="author"><?php comment_author(); ?></a>
					</h2>
					<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
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

	// Subscribe to posts form 

	add_action( 'init', 'process_my_subscription_form' );
	function process_my_subscription_form() {
		if ( isset( $_POST['my-form-action'] ) && $_POST['my-form-action'] == 'subscribe' ) {
			$email = $_POST['my-email'];
			$subscribe = Jetpack_Subscriptions::subscribe( $email, 0, false );
			// check subscription status
			if ( is_wp_error( $subscribe ) ) {
				$error = $subscribe->get_error_code();
			} else {
				$error = false;
				foreach ( $subscribe as $response ) {
					if ( is_wp_error( $response ) ) {
						$error = $response->get_error_code();
						break;
					}
				}
			}

			if ( $error ) {
				switch( $error ) {
					case 'invalid_email':
						$redirect = add_query_arg( 'subscribe', 'invalid_email' );
						break;
					case 'active': case 'pending':
						$redirect = add_query_arg( 'subscribe', 'already' );
						break;
					default:
						$redirect = add_query_arg( 'subscribe', 'error' );
						break;
				}
			} else {
				$redirect = add_query_arg( 'subscribe', 'success' );
			}

			wp_safe_redirect( $redirect );
		}
	}

	// Include post thumbnails

	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, false );
	}

	// Word Count

	function wordcount() {
		ob_start();
		the_content();
		$postcontent = ob_get_clean();
		return sizeof(explode(" ", $postcontent));
	}

	// Allow HTML in category descriptions

	remove_filter( 'pre_term_description', 'wp_filter_kses' );
	remove_filter( 'pre_link_description', 'wp_filter_kses' );
	remove_filter( 'pre_link_notes', 'wp_filter_kses' );
	remove_filter( 'term_description', 'wp_kses_data' );

	// Allow WordPress shortcodes to work in excerpts

	add_filter( 'get_the_excerpt','do_shortcode' );

	// Remove unnecessary bloaty things in the header

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
	add_filter( 'jetpack_enable_open_graph', '__return_false' );

	// Remove unnecessary self-closing tags
	
	function remove_self_closing_tags($input) {
		return str_replace(' />', '>', $input);
	}

	add_filter( 'get_avatar', 'remove_self_closing_tags' ); // <img />
	add_filter( 'comment_id_fields', 'remove_self_closing_tags' ); // <input />
	add_filter( 'post_thumbnail_html', 'remove_self_closing_tags' ); // <img />

	// Remove rel attribute from the category list

	function remove_category_list_rel( $output ){
		$output = str_replace(' rel="category tag"', '', $output);
		return $output;
	}

	add_filter( 'wp_list_categories', 'remove_category_list_rel' );
	add_filter( 'the_category', 'remove_category_list_rel' );

	// Remove Jetpack plugin CSS

	add_action( 'wp_footer', 'deregister_css_js' );
	add_filter( 'jetpack_implode_frontend_css', '__return_false' );

	function deregister_css_js () {
	    wp_deregister_style( 'jetpack-subscriptions' );
	    wp_deregister_style( 'jetpack_css' );
	}

?>