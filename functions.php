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

?>