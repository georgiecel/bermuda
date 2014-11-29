<?php

	// move jQuery to footer

	function jquery_in_footer() {
		if (!is_admin()) {
			wp_deregister_script('jquery');

			// load the local copy of jQuery in the footer
			wp_register_script('jquery', home_url(trailingslashit(WPINC) . 'js/jquery/jquery.js'), false, null, true);

			wp_enqueue_script('jquery');
		}
	}

	add_action('init', 'jquery_in_footer');

	// remove rel attribute from the category list

	function remove_category_list_rel( $output ){
		$output = str_replace(' rel="category tag"', '', $output);
		return $output;
	}

	add_filter('wp_list_categories', 'remove_category_list_rel');
	add_filter('the_category', 'remove_category_list_rel');

	// add class to “continue reading” link

	function add_morelink_class( $link, $text ) {
		return str_replace( 'more-link', 'btn more-link', $link );
	}

	add_action( 'the_content_more_link', 'add_morelink_class', 10, 2 );

	// add classes to next and previous links

	add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

	function posts_link_attributes_1() {
		return 'class="btn prev-link"';
	}

	function posts_link_attributes_2() {
		return 'class="btn next-link"';
	}

	// do the same for single

	add_filter('next_post_link', 'post_link_attributes_1');
	add_filter('previous_post_link', 'post_link_attributes_2');

	function post_link_attributes_1( $output ) {
		$code = 'class="next-post-link"';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}

	function post_link_attributes_2( $output ) {
		$code = 'class="prev-post-link"';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}

	// add a class to edit comment link

	function custom_edit_comment_link( $output ) {
		$editcomment = 'comment-meta-item';
		return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $editcomment, $output, 1 );
	}

	add_filter( 'edit_comment_link', 'custom_edit_comment_link' );

	// change cancel reply link to a button 

	function cancel_comment_reply_button( $html, $link, $text ) {
		$style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
		$button = '<button id="cancel-comment-reply-link" class="btn cancel-comment-reply"' . $style . '>';
		return $button . $text . '</button>';
	}

	add_action('cancel_comment_reply_link', 'cancel_comment_reply_button', 10, 3);

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

	function change_search_url_rewrite() {
		if ( is_search() && ! empty( $_GET['s'] ) ) {
			wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
			exit();
		}	
	}
	add_action( 'template_redirect', 'change_search_url_rewrite' );	

	// search highlight 

	function search_excerpt_highlight($limit) {
		$excerpt = get_the_excerpt();
		$excerpt = explode(' ', get_the_excerpt(), $limit);

		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(' ',$excerpt);
		} else {
			$excerpt = implode(' ',$excerpt);
		}

		$excerpt = apply_filters('get_the_excerpt', $excerpt);

		$allowed_tags = '<script>,<em>,<strong>,<br>,<mark>';
		$excerpt = strip_tags($excerpt, $allowed_tags);

		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

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

		return '<figure ' . $id . 'class="post-figure figure-' . esc_attr($align) . '" style="width: '. (int) $width . 'px">' 
			. do_shortcode( $content ) . '<figcaption ' . $capid . 'class="post-figcaption">' . $caption . '</figcaption></figure>';
	}	

	// not truncating excerpts in search results

	function nice_search_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		$allowed_tags = '<p>,<a>,<em>,<strong>,<img>,<mark>';
		$text = strip_tags($text, $allowed_tags);

		$excerpt_word_count = 150;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
		
		$excerpt_end = ''; 
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
		
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		
		if ( count($words) > $excerpt_length ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_more;
			} else {
				$text = implode(' ', $words);
			}
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}

	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'nice_search_excerpt');

	// allowing shortcodes to work in excerpts

	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'nice_trim_excerpt');

	function nice_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ( '' == $text ) {
			$text = get_the_content('');

			$text = apply_filters('the_content', $text);
			$text = str_replace(']]&gt;', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', 250);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}	

	add_filter('get_the_excerpt','do_shortcode');

	// adding [...] string to end of excerpt

	function excerpt_read_more_link($output) {
		global $post;
		return substr($output,0,-5) . ' [...]';
	}

	add_filter('the_excerpt', 'excerpt_read_more_link');

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
				<figure class="comment-gravatar"><?php echo get_avatar( $comment, 65, 'http://hey.georgie.nu/wp-content/themes/hg-bermuda/favicons/small.png', 'Author’s gravatar' ); ?></figure>
				<div class="comment-meta post-meta" role="complementary">
					<h2 class="comment-author">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
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

	// subscription form 

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
	add_filter( 'jetpack_enable_open_graph', '__return_false' );

	// remove unnecessary self-closing tags
	
	function remove_self_closing_tags($input) {
		return str_replace(' />', '>', $input);
	}

	add_filter('get_avatar', 'remove_self_closing_tags'); // <img />
	add_filter('comment_id_fields', 'remove_self_closing_tags'); // <input />
	add_filter('post_thumbnail_html', 'remove_self_closing_tags'); // <img />

	// remove jetpack plugin CSS

	add_action('wp_footer', 'deregister_css_js');
	add_filter( 'jetpack_implode_frontend_css', '__return_false' );

	function deregister_css_js () {
	    wp_deregister_style( 'jetpack-subscriptions' );
	    wp_deregister_style( 'jetpack_css' );
	}

?>