<?php
	function featuredtoRSS($content) {
	global $post;
	/* Does the post have a thumbnail image? */
	if ( has_post_thumbnail( $post->ID ) ){	
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		
		/* Check if there is alt text associated with the thumbnail image */
		if (get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)) {
			/* there is so use it */
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		} else {
			/* There isn't so put something at least */
			$alt = 'News post image';
		}
		/* Prepend a div containing the image to the post content */
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'display: block; margin-bottom: 0.5rem; clear:both;max-width: 100%;', 'alt' => $alt, 'class' => 'attachment-medium size-medium wp-post-image' ) ) . '</div>' . $content;
	}
		/* No image so just return content */
		return $content;
	}
	
	/* I only want to see an image in the feed when I see the full content */
	/* add_filter('the_excerpt_rss', 'featuredtoRSS'); */
	add_filter('the_content_feed', 'featuredtoRSS');
?>