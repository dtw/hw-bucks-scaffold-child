<?php get_header(); ?>
  <div class="container">
    <div id="content" role="main" class="col-md-8 col-xs-12">
      <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-content">
                <?php the_content(); ?>
                <div id="feedback-selector" class="row">
                  <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="choice-container">
                      <a class="choice-img-link" href="https://www.healthwatchbucks.co.uk/your-story/">
                        <img class="choice-img" src="https://www.staging1.healthwatchbucks.co.uk/wp-content/uploads/2016/07/Icon-Signage-150x150.png" alt="Your story">
                      </a>
                      <a class="choice-details your-story" href="https://www.healthwatchbucks.co.uk/your-story/">
                        <p>Your story</p>
                        <div class="hover-content">
                          <p>A blurb.</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="choice-container">
                      <a class="choice-img-link" href="https://www.healthwatchbucks.co.uk/">
                        <img class="choice-img" src="https://www.staging1.healthwatchbucks.co.uk/wp-content/uploads/2016/07/Icon-Signage-150x150.png" alt="Rate & Review">
                      </a>
                      <a class="choice-details rate-review" href="https://www.healthwatchbucks.co.uk/">
                        <p>Rate & Review</p>
                        <div class="hover-content">
                          <p>A blurb.</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="choice-container">
                      <a class="choice-img-link" href="https://www.healthwatchbucks.co.uk/contact-us/">
                        <img class="choice-img" src="https://www.staging1.healthwatchbucks.co.uk/wp-content/uploads/2016/07/Icon-Signage-150x150.png" alt="Contact us">
                      </a>
                      <a class="choice-details contact-us" href="https://www.healthwatchbucks.co.uk/contact-us/">
                        <p>Contact us</p>
                        <div class="hover-content">
                          <p>A blurb.</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </article><!-- #post -->

        <?php endwhile; // end of the loop. ?>
      </div><!-- .row -->
    </div><!-- #content -->
    <div id="sidebar" class="col-md-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div><!-- .container -->
<?php get_footer(); ?>
