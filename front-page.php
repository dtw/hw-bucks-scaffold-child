<?php get_header(); ?>

<!-- 1. Search form -->
<div class="widget widget-home widget_search">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12 shade">
				<h2>We're here to listen to you and work with the people that run your health and care services to make them better</h2>
				<div class="col-md-12 col-sm-12" id="search-box" title="Search for a health or care service">
					<p>Rate and review over 500 GPs, dentists, pharmacies, care homes and hospitals</p>
					<?php echo do_shortcode("[wd_asp id=1]"); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- container -->
</div>
<!-- widget -->
<div class="container">
	<div id="content">
		<div class="feedback row">
		<!-- Front Page top widget -->
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page Panel One") ) : ?>
		<?php endif;?>
		</div>

<div class='row news'>
	<!-- Front Page Panel Two widget area -->
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page Panel Two") ) : ?>
	<?php endif;?>
</div>
<!-- end of row -->
<!-- 3. Dignity in Care -->
<div class="row news">
<?php
	$dic = new WP_Query(array(
		'post_type' => 'Local_services',
		// 'orderby' => 'rand',
		'showposts' => 1,
		'meta_query' => array(
			array(
				'key'     => 'hw_services_overall_rating',
				'value'   => 1,
				'compare' => '>=',),
			),
		)
	);
	if( $dic->have_posts() ) :
?>
	<?php while($dic->have_posts()) : $dic->the_post(); ?>
	<div class='panel col-md-12 col-sm-12 col-xs-12 panel-green' id='dignity-in-care'>
		<div class="row">
			<div class="col-md-4 col-sm-6 hidden-xs panel-icon-left">
				<a href="
					<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail([auto,240]); ?>
				</a>
			</div>
			<div class="col-md-8 col-sm-6 col-xs-12 panel-text-right">
				<div class="row">
					<div class="col-md-12 panel-title">
						<h2>Latest Dignity in Care visit</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<span class="city">
							<a class="title-link" href="
								<?php the_permalink(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
							<?php $city = get_post_meta( $post->ID, 'hw_services_city', true ); if ($city) { echo $city; } ?>
						</span>
						<?php the_excerpt(); ?>
						<p>
							<?php $rating = get_post_meta( $post->ID, 'hw_services_overall_rating', true );
								for ($i = 1; $i <= $rating; ++$i)  {
									echo "<i class='fas fa-star fa-lg green'></i> ";
								}
								for ($i = 1; $i <= (5 - $rating); ++$i)  {echo "<i class='far fa-star fa-lg green'></i> ";
								}
							?>
						</p>
						<p class="visit-date">Visited on
							<?php echo the_date(); ?>
						</p>
					</div>
					<?php // get_template_part("elements/comments-rating-average"); ?>
				</div>
			</div>
		</div>
		<!-- end of column -->
	</div>
		<!-- end of panel -->
  <?php
		endwhile;
		endif; wp_reset_query();
	?>
	<!-- Front Page Panel Three widget area -->
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page Panel Three") ) : ?>
	<?php endif;?>
</div>
<!-- end of row -->
<!-- 7. PPG -->
<div class='row news'>
	<!-- Front Page Panel Four widget area -->
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page Panel Four") ) : ?>
	<?php endif;?>
</div>
<!-- end of row -->
</div>
<!-- end of content column -->
<?php get_footer(); ?>
