<?php get_header(); ?>
  <div class="container">
    <!--<div id="content" role="main" class="col-md-8 col-xs-12">-->
    <div id="content" role="main" class="col-xs-12">
      <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </article><!-- #post -->

        <?php endwhile; // end of the loop. ?>
      </div><!-- .row -->
      <!-- Signposting & Complaints Page Page Widget Area-->
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Signposting & Complaints Page") ) : ?>
      <?php endif;?>
    </div><!-- #content -->
    <!-- <div id="sidebar" class="col-md-4 col-xs-12">
      <?php //get_sidebar(); ?>
    </div> -->
  </div><!-- .container -->
<?php get_footer(); ?>
