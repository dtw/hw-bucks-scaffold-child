<?php /* Template Name: Thanks */
global $wp;
$current_slug = add_query_arg( array(), $wp->request );

// check we've been sent to thanks-website
if ( $current_slug == 'thanks-website' ) {
  // delete the cookies set after the feedback form is submitted
  unset($_COOKIE['comment_id']);
  unset($_COOKIE['comment_uuid']);
}

get_header(); ?>
  <div class="container">
    <div id="content" role="main" class="col-md-8 col-xs-12">
      <? // for cookie we set when returning
      if ( $current_slug == 'thanks-website' || $current_slug == 'thanks-signposting' ) {
        echo '<div id="demographics" class="row"><div class="alert alert-success alert-relative" role="alert">Thank you for sharing your demographic data. You can <a href="https://www.healthwatchbucks.co.uk/2021/06/why-were-asking-for-more-information-about-you/">read more about why we need this data</a>.</div></div>';
        }
      ?>
      <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </article><!-- #post -->

        <?php endwhile; // end of the loop. ?>
      </div><!-- .row -->
      <!-- Thanks Page Widget Area -->
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Thanks Page") ) : ?>
      <?php endif;?>
    </div><!-- #content -->
    <div id="sidebar" class="col-md-4 col-xs-12">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Pages without menu')) : endif; ?>
    </div>
  </div><!-- .container -->
<?php get_footer(); ?>
