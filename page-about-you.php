<?php get_header(); ?>
  <div class="container">
    <!--<div id="content" role="main" class="col-md-8 col-xs-12">-->
    <div class="row">
      <div id="content" class="col-md-8 col-xs-12">
        <div class="alert alert-success alert-relative" role="alert">
          Success - your comment has been sent!
        </div>
        <div id="referral-buttons" class="row">
        <?php if ( isset($_COOKIE['comment_id']) ) {
          // read the cookie we set when the comment form was submitted
          $comment_id = $_COOKIE['comment_id'];
          // now remove the cookie
          unset($_COOKIE['comment_id']); ?>
          <div class="row">
            <h2>Help our research</h2>
          </div>
          <div class="row no-gutter col-sm-11 col-xs-12">
            <div class="text-center col-sm-3 hidden-xs">
              <i class="far fa-heart" aria-hidden="true"></i>
            </div>
            <div class="col-sm-9 col-xs-12">
              <p>By telling us more about yourself, you can help us address poor health outcomes across Buckinghamshire.</p>
              <div id="yes-button">
                <?php echo '<a class="btn btn-cta" href="https://www.smartsurvey.co.uk/s/HW_BUCKS_DEMO/?src=website&id=' . $comment_id . '">Contribute your data</a>';?>
              </div>
              <!--<div id="no-button" class="row">
                <a href="https://www.healthwatchbucks.co.uk/thanks-website/">No, I don't want to answer these questions</a>
              </div> -->
            </div>
          </div>
          <?php } ?>
        </div>
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </article><!-- #post -->

        <?php endwhile; // end of the loop. ?>
      </div> <!-- #content -->
      <div id="sidebar" class="col-md-4 hidden-sm hidden-xs">
        <div id="clipboard-cropped"></div>
      </div>
    </div><!-- .row -->
    <!-- Your Feedback Page Widget Area-->
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("About You Page") ) : ?>
    <?php endif;?>
  </div><!-- .container -->
<?php get_footer(); ?>
