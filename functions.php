<?php

    // Remove `p` tags from `iframe`s.

    function remove_some_ptags( $content ) {
        $content = preg_replace('/<p>\s*(<iframe.*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
        return $content;
    }

    add_filter( 'the_content', 'remove_some_ptags' );

    // Correct titles for views

    function my_theme_archive_title( $title ) {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }

    add_filter( 'get_the_archive_title', 'my_theme_archive_title' );


    // Site logo

    function return_site_logo() {
        return get_template_directory_uri() . '/images/logo-raster.png';
    }

    add_filter( 'site_logo', 'return_site_logo' );

    // Move jQuery to footer

    function footer_enqueue_scripts() {
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);
        add_action('wp_footer', 'wp_print_scripts', 5);
        add_action('wp_footer', 'wp_enqueue_scripts', 5);
        add_action('wp_footer', 'wp_print_head_scripts', 5);
    }

    add_action('after_setup_theme', 'footer_enqueue_scripts');

    // Function for meta description

    function meta_desc() {
        if ( is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post();
            echo wp_strip_all_tags( get_the_excerpt() );
        endwhile; endif; elseif ( is_home() ):
            echo bloginfo('description');
        endif;
    }

    // Adding main navigation menu

    add_action( 'after_setup_theme', 'main_navigation' );

    function main_navigation() {
        register_nav_menu('main-navigation',__( 'Main Navigation Menu', 'hg-bermuda' ));
    }

    add_action( 'init', 'main_navigation' );

    // Adding widgetised sidebar and footer

    function widgets() {

        register_sidebar( array(
            'name' => __( 'Sidebar' ),
            'id' => 'sidebar',
            'description' => __( 'Sidebar widgets.' ),
            'before_widget' => '<div class="site-sidebar-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="site-sidebar-heading">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __( 'Footer' ),
            'id' => 'footer',
            'description' => __( 'Footer widgets.' ),
            'before_widget' => '<div class="footer-item">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="footer-item__title">',
            'after_title' => '</h3>',
        ) );
    }

    add_action( 'widgets_init', 'widgets' );

    // Allowing PHP in widget

    add_filter( 'widget_text', 'execute_php', 100);

    function execute_php($html) {
        if( strpos( $html, '<' . '?php' ) !== false ){
            ob_start();
            eval( '?' . '>' . $html );
            $html = ob_get_contents();
            ob_end_clean();
        }
        return $html;
    }

    // Removing `textwidget` div

    add_action( 'widgets_init', 'register_my_widgets' );

    function register_my_widgets() {
        register_widget( 'My_Text_Widget' );
    }

    class My_Text_Widget extends WP_Widget_Text {
        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
            echo $before_widget;
            if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
            <?php echo $after_widget;
        }
    }

    // Get first image of post

    function get_first_image() {
        global $post, $posts;
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];

        if (empty($first_img)) {
            return get_bloginfo('template_directory') . '/images/card.png';
        }

        return site_url() . $first_img;
    }

    // Add custom “read more” link for excerpt

    function excerpt_read_more_link( $output ) {
        global $post;
        return substr( $output, 0 ) . '<a href="' . get_permalink() . '#more-' . get_the_ID() . '" class="c-read-more">Read post &raquo;</a>';
    }

    add_filter( 'the_excerpt', 'excerpt_read_more_link' );

    // Add classes to next/previous links

    function posts_link_attributes_1() {
        return 'class="c-pagination-item"';
    }

    function posts_link_attributes_2() {
        return 'class="c-pagination-item"';
    }

    add_filter( 'next_posts_link_attributes', 'posts_link_attributes_1' );
    add_filter( 'previous_posts_link_attributes', 'posts_link_attributes_2' );

    // Add classes to next/previous links in individual posts

    function post_link_attributes_1( $output ) {
        $code = 'class="c-pagination-item"';
        return str_replace('<a href=', '<a ' . $code . ' href=', $output);
    }

    function post_link_attributes_2( $output ) {
        $code = 'class="c-pagination-item"';
        return str_replace('<a href=', '<a ' . $code . ' href=', $output);
    }

    add_filter( 'next_post_link', 'post_link_attributes_1' );
    add_filter( 'previous_post_link', 'post_link_attributes_2' );

    // Add class to reply link

    function comment_reply( $content ) {
        return '<span class="comment__reply-link">' . $content . '</span>';
    }

    add_filter('comment_reply_link', 'comment_reply', 99);

    // Change “cancel reply” link to a button

    function cancel_comment_reply_button( $html, $link, $text ) {
        $style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
        $button = '<button id="cancel-comment-reply-link" class="c-cancel-link" tabindex="6"' . $style . '>';
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

        echo '<p>' . $excerpt . ' [&hellip;]</p>';
    }

    function search_title_highlight() {
        $title = get_the_title();
        $keys = implode('|', explode(' ', get_search_query()));
        $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

        echo $title;
    }

    // Preserve HTML in excerpts

    function pretty_excerpt( $excerpt ) {
        $raw = $excerpt;
        if ( '' == $excerpt ) {
            $excerpt = get_the_content();

            $excerpt = apply_filters( 'the_content', $excerpt );

            $limit = 75;
            $excerpt_length = apply_filters( 'excerpt_length', $limit );

            $excerpt_end = '[&hellip;]';
            $excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );

            $words = preg_split('/[\n\r\t ]+/', $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
            if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $excerpt = implode(' ', $words);
                $excerpt = $excerpt . $excerpt_more;
            } else {
                $excerpt = implode(' ', $words);
            }

            $allowed_tags = '<p>,<a>,<em>,<strong>,<img>,<br>';
            $excerpt = strip_tags($excerpt, $allowed_tags);
        }

        return apply_filters( 'wp_trim_excerpt', $excerpt, $raw );
    }

    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('get_the_excerpt', 'pretty_excerpt');

    // Adding short excerpt

    function short_excerpt( $limit ) {
        $excerpt = get_the_excerpt();
        $excerpt = explode(' ', get_the_excerpt(), $limit);

        if ( count( $excerpt ) >= $limit ) {
            array_pop( $excerpt );
            $excerpt = implode(' ', $excerpt);
        } else {
            $excerpt = implode(' ', $excerpt);
        }

        $excerpt = apply_filters( 'get_the_excerpt', $excerpt );

        $allowed_tags = '<p>,<br>';
        $excerpt = strip_tags( $excerpt, $allowed_tags );

        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        echo '<p>' . $excerpt . ' [&hellip;]</p>';
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
        } else {
            echo '<meta itemprop="image" content="' . get_first_image() . '">';
        }
    }

    // Adjust HTML for image caption shortcode

    function caption_shortcode($val, $attr, $content = null) {
        extract(shortcode_atts(array('id'=> '','align'=> 'center','caption' => ''), $attr));

        if ( empty($caption) )return $val;
        $capid = '';

        if ( $id ) {
            $id = esc_attr($id);
            $capid = 'id="figcaption-'. $id . '" ';
            $id = 'id="' . $id . '" aria-labelledby="figcaption-' . $id . '" ';
        }

        $figure = '<figure ' . $id . 'class="figure figure--' . esc_attr($align) . '">';
        $figure .= do_shortcode( $content ) . '<figcaption ' . $capid . 'class="figure__caption figure__caption--' . esc_attr($align) . '">' . $caption . '</figcaption></figure>';

        return $figure;
    }

    add_filter( 'img_caption_shortcode', 'caption_shortcode', 10, 3 );

    // Menu walker for main navigation

    class menu_walker extends Walker_Nav_Menu {

        // add classes to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= "\n" . '<ul class="c-navigation">' . "\n";
        }

        // add classes to <li> and <a>
        function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;
            $output .= $indent . '<li>';

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth = 0, $args = array(), $id = 0 );
        }
    }

    // Comment walker for comment list

    class comment_walker extends Walker_Comment {
        var $tree_type = 'comment';
        var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

        // constructor – wrapper for the comments list
        function __construct() { ?>
            <div class="comments-list">
        <?php }

        // start_lvl – wrapper for child comments list
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $GLOBALS['comment_depth'] = $depth + 2; ?>
            <div class="comments-list comments-list--child">
        <?php }

        // end_lvl – closing wrapper for child comments list
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $GLOBALS['comment_depth'] = $depth + 2; ?>
            </div>
        <?php }

        // start_el – HTML for comment template
        function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
            $depth++;
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment'] = $comment;
            $parent_class = ( empty( $args['has_children'] ) ? '' : 'comment--parent' );

            if ( 'article' === $args['style'] ) {
                $tag = 'article';
                $add_below = 'comment';
            } else {
                $tag = 'article';
                $add_below = 'comment';
            }

            $PostAuthor = false;
                if( $comment->comment_author_email == get_the_author_email() ) {
                    $PostAuthor = true;
                }
            ?>

            <article class="comment<?php if($PostAuthor) { echo ' comment--author'; } ?>" id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
                <div class="comment__meta">
                    <h2 class="comment__author" itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <?php if (get_comment_author_url()) : ?>
                        <a
                            aria-label="Link to <?php comment_author(); ?>’s website"
                            class="comment__author-link"
                            href="<?php comment_author_url(); ?>"
                            itemprop="url"
                            rel="nofollow"
                        >
                            <span itemprop="name"><?php comment_author(); ?></span>
                        </a>
                    <?php else : ?>
                        <span itemprop="name"><?php comment_author(); ?></span>
                    <?php endif; ?>
                    </h2>
                    <p class="comment__meta-item"><time datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('j F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time></p>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <mark><strong>Your comment is awaiting moderation.</strong> It will be published if it has been approved.</mark>
                    <?php endif; ?>
                </div>
                <div class="comment__text" itemprop="text">
                    <?php comment_text(); ?>
                </div>
                <?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply to this &raquo;' ) )) ?>

        <?php }

        // end_el – closing HTML for comment template
        function end_el(&$output, $comment, $depth = 0, $args = array(), $id = 0 ) { ?>
            </article>
        <?php }

        // destructor – closing wrapper for the comments list
        function __destruct() { ?>
            </div>
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

    // Undoing the insanity of the $pee in core formatting.php

    function dodge_default_formatting( $pee, $br = true ) {
        $pre_tags = array();

        if ( trim($pee) === '' )
            return '';

        // Just to make things a little easier, pad the end.
        $pee = $pee . "\n";

        // Replace pre tags with placeholders and bring them back after autop.
        if ( strpos($pee, '<pre') !== false ) {
            $pee_parts = explode( '</pre>', $pee );
            $last_pee = array_pop($pee_parts);
            $pee = '';
            $i = 0;

            foreach ( $pee_parts as $pee_part ) {
                $start = strpos($pee_part, '<pre');

                // Malformed html?
                if ( $start === false ) {
                    $pee .= $pee_part;
                    continue;
                }

                $name = "<pre wp-pre-tag-$i></pre>";
                $pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

                $pee .= substr( $pee_part, 0, $start ) . $name;
                $i++;
            }

            $pee .= $last_pee;
        }
        // Change multiple <br>s into two line breaks, which will turn into paragraphs.
        $pee = preg_replace('|<br\s*/?>\s*<br\s*/?>|', "\n\n", $pee);

        $allblocks = '(?:dl|dd|dt|ul|ol|li|pre|blockquote|p|h[1-6]|hr|section)';

        // Add a single line break above block-level opening tags.
        $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);

        // Add a double line break below block-level closing tags.
        $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);

        // Split up the contents into an array of strings, separated by double line breaks.
        $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);

        // Reset $pee prior to rebuilding.
        $pee = '';

        // Rebuild the content as a string, wrapping every bit with a <p>.
        foreach ( $pees as $tinkle ) {
            $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
        }

        // If an opening or closing block element tag is wrapped in a <p>, unwrap it.
        $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

        // If a <blockquote> is wrapped with a <p>, move it inside the <blockquote>.
        $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
        $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);

        // If an opening or closing block element tag is preceded by an opening <p> tag, remove it.
        $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);

        // If an opening or closing block element tag is followed by a closing <p> tag, remove it.
        $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

        // Optionally insert line breaks.
        if ( $br ) {
            // Replace newlines that shouldn't be touched with a placeholder.
            $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);

            // Normalize <br>
            $pee = str_replace( array( '<br>', '<br/>' ), '<br />', $pee );

            // Replace any new line characters that aren't preceded by a <br /> with a <br />.
            $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee);

            // Replace newline placeholders with newlines.
            $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
        }

        // If a <br /> tag is after an opening or closing block tag, remove it.
        $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);

        // If a <br /> tag is before a subset of opening or closing block tags, remove it.
        $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
        $pee = preg_replace( "|\n</p>$|", '</p>', $pee );

        // Replace placeholder <pre> tags with their original content.
        if ( !empty($pre_tags) )
            $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

        // Restore newlines in all elements.
        if ( false !== strpos( $pee, '<!-- wpnl -->' ) ) {
            $pee = str_replace( array( ' <!-- wpnl --> ', '<!-- wpnl -->' ), "\n", $pee );
        }

        return $pee;
    }

    remove_filter( 'the_excerpt', 'wpautop' );
    add_filter( 'the_excerpt', 'dodge_default_formatting', 10, 3 );

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

    // Kill WordPress emoji

    remove_action( 'wp_head',               'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts',   'print_emoji_detection_script' );
    remove_action( 'wp_print_styles',       'print_emoji_styles' );
    remove_action( 'admin_print_styles',    'print_emoji_styles' );
    remove_filter( 'the_content_feed',      'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss',      'wp_staticize_emoji' );
    remove_filter( 'wp_mail',               'wp_staticize_emoji_for_email' );

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

    add_filter( 'jetpack_implode_frontend_css', '__return_false' );

    function deregister_css_js () {
        wp_deregister_style( 'grunion.css' );
        wp_deregister_style( 'jetpack-subscriptions' );
        wp_deregister_style( 'jetpack_css' );
    }

    add_action( 'wp_print_styles', 'deregister_css_js' );

    // Remove WooCommerce Tabs - this code removes all 3 tabs

    add_filter( 'woocommerce_product_tabs', 'custom_remove_product_tabs', 98 );

    function custom_remove_product_tabs( $tabs ) {

        unset( $tabs['description'] );
        unset( $tabs['reviews'] );
        unset( $tabs['additional_information'] );

        return $tabs;
    }

    // Remove WooCommerce breadcrumb

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

    // Remove WooCommerce shipping and billing

    add_filter('woocommerce_billing_fields','custom_remove_billing_fields');

    function custom_remove_billing_fields( $fields = array() ) {
        unset($fields['billing_company']);
        unset($fields['billing_address_1']);
        unset($fields['billing_address_2']);
        unset($fields['billing_state']);
        unset($fields['billing_city']);
        unset($fields['billing_phone']);
        unset($fields['billing_postcode']);
        unset($fields['billing_country']);
        return $fields;
    }

    add_filter( 'woocommerce_checkout_fields' , 'custom_remove_checkout_fields', 20 );

    function custom_remove_checkout_fields( $fields ) {
        $fields['billing']['billing_first_name'] = array(
            'label' => 'First name',
            'label_class' => array('c-input-label'),
            'required' => true,
        );
        $fields['billing']['billing_last_name'] = array(
            'label' => 'Last name',
            'label_class' => array('c-input-label'),
            'required' => true,
        );
        $fields['billing']['billing_email'] = array(
            'label' => 'Email address',
            'label_class' => array('c-input-label'),
            'required' => true,
        );
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_state']);
        return $fields;
    }

    // Remove order notes field

    add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 20 );

    // Add custom cart validation for single item cart

    add_filter( 'woocommerce_add_to_cart_validation', 'custom_add_to_cart_validation', 10, 3 );

    function custom_add_to_cart_validation( $passed, $product_id, $quantity ) {
        $cart_items_count = WC()->cart->get_cart_contents_count();
        $total_count = $cart_items_count + $quantity;

        if( $cart_items_count >= 1 || $total_count > 1 ) {
            $passed = false;
            wp_safe_redirect( wc_get_checkout_url() );
            exit;
        }

        return $passed;
    }

    // Add redirection when product is added to cart

    add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );

    function custom_add_to_cart_redirect( $url ) {
        $url = wc_get_checkout_url();

        return $url;
    }

    // Add custom text to “Add to cart” button

    add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text' );

    function custom_add_to_cart_text() {
        return __( 'Buy now', 'woocommerce' );
    }

    // Custom “order received” text

    add_action( 'woocommerce_thankyou_order_received_text', 'custom_order_received_text' );

    function custom_order_received_text() {
        return __( 'Thank you so much for your purchase and for your support! 💌 I really appreciate it and hope you enjoy reading my work. If you have any questions about your order, or any feedback, please send an email to <a href="mailto:tosib@georgie.nu">tosib@georgie.nu</a>.' );
    }

    // Make orders automatically processed

    add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );

    function custom_woocommerce_auto_complete_order( $order_id ) {
        if ( ! $order_id ) {
            return;
        }

        $order = wc_get_order( $order_id );
        $order->update_status( 'completed' );
    }
?>