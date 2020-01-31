<?php
/*
YARPP Template: Default
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?><h3>Related Posts</h3>
<?php
// a little easter egg: if the default image URL is left blank,
// default to the theme's header image. (hopefully it has one)
if ( empty($thumbnails_default) )
	$thumbnails_default = get_header_image();

$dimensions = $this->thumbnail_dimensions();
if (have_posts()) {
	$output .= '<div class="yarpp-thumbnails-horizontal">' . "\n";
	while (have_posts()) {
		the_post();

		$output .= "<a class='yarpp-thumbnail' rel='norewrite' href='" . get_permalink() . "' title='" . the_title_attribute('echo=0') . "'>" . "\n";

		$post_thumbnail_html = '';
		if ( has_post_thumbnail() ) {
			if ( $this->diagnostic_generate_thumbnails() )
				$this->ensure_resized_post_thumbnail( get_the_ID(), $dimensions );
			$post_thumbnail_html = get_the_post_thumbnail(null, $dimensions['size'], array('data-pin-nopin' => 'true') );
		}

		if ( trim($post_thumbnail_html) != '' )
			$output .= $post_thumbnail_html;
		else
			$output .= '<span class="yarpp-thumbnail-default"><img src="' . esc_url($thumbnails_default) . '" alt="Default Thumbnail" data-pin-nopin="true" /></span>';

		$output .= '<span class="yarpp-thumbnail-title">' . get_the_title() . '</span>';
		$output .= '</a>' . "\n";

	}
	$output .= "</div>\n";
} else {
	$output .= $no_results;
}

echo $output;
?>
