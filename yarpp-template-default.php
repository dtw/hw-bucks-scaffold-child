<?php
/*
YARPP Template: Default
Author: dtw (Phil Thiselton)
Description: A simple YARPP template based on the default.
*/
// a little easter egg: if the default image URL is left blank,
// default to the theme's header image. (hopefully it has one)
if ( empty($thumbnails_default) )
	$thumbnails_default = get_header_image();

$dimensions = $this->thumbnail_dimensions();
if (have_posts()) {
	$output .= '<!--default template--><div class="yarpp-thumbnails-horizontal col-md-12 col-sm-8 col-xs-12 col-md-offset-0 col-sm-offset-2"><h3>Related Posts</h3>';
	while (have_posts()) {
		the_post();

		$output .= '<div class="yarpp-container media"><a class="yarpp-thumbnail media-left img-anchor" rel="norewrite" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';

		$post_thumbnail_html = '';
		if ( has_post_thumbnail() ) {
			if ( $this->diagnostic_generate_thumbnails() )
				$this->ensure_resized_post_thumbnail( get_the_ID(), $dimensions );
			$post_thumbnail_html = get_the_post_thumbnail(null, $dimensions['size'], array('class' => 'media-object','data-pin-nopin' => 'true') );
		}

		if ( trim($post_thumbnail_html) != '' )
			$output .= $post_thumbnail_html . '</a>';
		else
			$output .= '<img src="' . esc_url($thumbnails_default) . '" alt="Default Thumbnail" data-pin-nopin="true" /></a>';

		$output .= '<a class="yarpp-thumbnail-title media-body" rel="norewrite" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">'  . get_the_title() . '</a>';
		$output .= '</div>';
	}
	$output .= '</div>';
} else {
	$output .= '<!--No results from yarpp -->';
}
?>
