<?php

// ENQUEUE STYLES

	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
			}



// INCLUDES

	// OPEN GRAPH for FACEBOOK
// 	require_once('functions/functions-open-graph.php');

	// RSS customisations
	require_once('functions/functions-rss.php');











function hwb_pre_get_posts( $query ) {


if ( $query->is_tax('signpost_categories') ) {
        // Manipulate $query here, for instance like so
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }
}
add_action( 'pre_get_posts', 'hwb_pre_get_posts' );








































function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body" style="background-color: rgba(0,0,0,.02); padding: 1rem;"><?php
    } ?>
        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 



	$author_name = get_comment_author();
	if ($author_name == 'Anonymous') {
printf( __( '<strong>Commenter</strong> said on ' ), get_comment_author_link() ); echo get_comment_date();		
		} else { 
echo "<p><img width='200' src='https://www.healthwatchbucks.co.uk/wp-content/uploads/2017/02/HW_Bucks_CMYK.svg' alt='Healthwatch Bucks' id='HWBucksCommentLogo'/></p>";
printf( __( 'On ' ), get_comment_author_link() ); echo get_comment_date();		
		}
	
	

             ?>
        </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <?php comment_text(); ?>

        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}



?>