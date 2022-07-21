<?php // OPEN GRAPH for FACEBOOK and TWITTER

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;

// Standard OG for Facebook
				echo '<!-- scaffold OG for Facebook -->';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="' . get_bloginfo(name) . '"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://www.healthwatchbucks.co.uk/wp-content/uploads/2016/07/Patterned-Quotes.png"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}



// Twitter
		echo '<!-- scaffold meta for Twitter -->';
		echo '<meta name="twitter:card" content="summary_large_image" />';
		echo '<meta name="twitter:creator" content="@' . get_theme_mod( 'scaffold_org_twitter') . '" />';
		echo '<meta name="twitter:title" content="' . get_the_title() . '" />';
		echo '<meta name="twitter:description" content="' . get_the_excerpt() . '" />';
		echo '<meta name="twitter:image:alt" content="' . get_the_title() . '" />';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		// $default_image= get_site_icon_url(); //replace this with a default image on your server or an image in your media library
		$default_image="http://www.healthwatchbucks.co.uk/wp-content/uploads/2016/07/Patterned-Quotes.png"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="twitter:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo '<meta property="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}







	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );





?>
