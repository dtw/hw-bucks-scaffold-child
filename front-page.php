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
		<!-- Front Page news widget -->
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page Top") ) : ?>
		<?php endif;?>
		<!-- 2. Recent feedback -->
		<?php
			$args = array(
				'status' => 'approve',
				'post_type' => 'local_services',
				'number' => 4,
			);

		// The Query - gets the last 4 approved comments for post_type local_services
		$comments_query = new WP_Comment_Query;
		$comments = $comments_query->query( $args );

		$reviewcount = 1;

// Comment Loop
if ( $comments ) {
	echo "<div class='feedback row'>";
	foreach ( $comments as $comment ) { ?>
		<!-- if this is the first review -->
		<?php if ($reviewcount == 1) { ?>
			<!-- start the main panel -->
			<div class="col-md-12 col-sm-12 col-xs-12 panel">
				<div class="col-md-12 panel-title">
					<h2>Recent feedback from the public</h2>
				</div>
		<?php } elseif ($reviewcount == 4) { ?>
			<!-- start the final small panel -->
			<div class="col-md-4 hidden-sm hidden-xs">
		<?php } else { ?>
			<!-- start a smaller panel -->
			<div class="col-md-4 col-sm-6 hidden-xs">
		<?php } ?>
		<?php 										// Display icon for taxonomy term
			$term_ids = get_the_terms( $comment->comment_post_ID, 'service_types' );	// Find taxonomies
			$term_id = $term_ids[0]->term_id;											// Get taxonomy ID
			$term_icon = get_term_meta( $term_id, 'icon', true );						// Get meta
		?>
				<div class="feedback row">
				<!-- if this is the main panel -->
				<?php if ($reviewcount == 1) { ?>
					<!-- if the post has an thumbnail -->
					<?php if ( has_post_thumbnail($comment->comment_post_ID) ) { ?>
						<!-- add a container and wrap the thumbnail in a hyperlink to the post -->
						<div class="service-icon-container text-center col-md-4 col-sm-3 col-xs-12">
							<a href="
							<?php echo get_the_permalink($comment->comment_post_ID); ?>
							">
							<?php echo get_the_post_thumbnail($comment->comment_post_ID,[auto,180]); ?>
					<?php } else { ?>
						<!-- if there is no thumb... the col's are different?! -->
						<div class="service-icon-container text-center col-md-4 col-sm-3 hidden-xs">
							<a href="
							<?php echo get_the_permalink($comment->comment_post_ID); ?>
							">
								<img class="service-icon-md" src="
								<?php echo $term_icon; ?>
								" alt="
								<?php echo get_the_title($comment->comment_post_ID); ?>
								" />
					<?php } ?>
				<!-- this isn't the main panel 4x to 2x to 1x-->
				<?php } else { ?>
					<!-- add a container and wrap the term icon in a hyperlink to the post -->
					<div class="service-icon-container text-center col-md-3 col-sm-3 col-xs-12">
						<a href="
						<?php echo get_the_permalink($comment->comment_post_ID); ?>
						">
						<img class="service-icon-sm" src="
						<?php echo $term_icon; ?>
						" alt="
						<?php echo get_the_title($comment->comment_post_ID); ?>
						" />
				<?php } ?>
			</a>
		</div>
<!-- REVIEWED TO HERE-->
						<?php if ($reviewcount == 1) { ?>
							<?php if ( has_post_thumbnail($comment->comment_post_ID) ) { ?>
								<div class="service-info-container col-md-8 col-sm-9 col-xs-12">
									<a class="title-link" href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_title($comment->comment_post_ID); ?>
									</a>
							<?php } else { ?>
								<div class="service-info-container col-md-8 col-sm-9 col-xs-12">
									<a class="title-link" href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_title($comment->comment_post_ID); ?>
									</a>
							<?php } ?>
						<?php } else { ?>
							<div class="service-info-container-sm col-md-9 col-sm-9 col-xs-12">
								<h3 style="margin: 0; padding-bottom: .5rem;">
									<a href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_title($comment->comment_post_ID); ?>
									</a>
								</h3>
						<?php } ?>
									<?php if ($reviewcount == 1) {
get_template_part("elements/comments-list");
?>
									<p>
										<?php
										// mb_strimwidth trims comment to 300 (if needed) and adds an ellipsis
										// wpautop converts double line breaks to <p></p>
										// i.e. this keeps line breaks in the comment
											echo wpautop(mb_strimwidth($comment->comment_content,0,300," ..."), true);
										?>
									</p>
									<?php } ?>
									<?php // Display star rating
$individual_rating = get_comment_meta( $comment->comment_ID, 'feedback_rating', true ); ?>
									<?php if ($individual_rating) {
										$star_count = 0;
									?>
									<p class="star-rating p-rating">
										<?php
										for ($int_count = 1; $int_count <= $individual_rating; $int_count++) {
											echo '<i class="fa fa-star fa-lg"></i>
											';
											$star_count++;
										}
										while ($star_count < 5) {
											echo '<i class="fa fa-star-o fa-lg"></i>
											';
											$star_count++;
										}
										?>
									</p>
									<p>
										<strong>
											<?php echo human_time_diff( strtotime($comment->comment_date), current_time( 'timestamp' ) ); ?> ago
										</strong>
									</p>
									<?php
	$reviewcount = $reviewcount + 1;


	} // end of if there is a rating ?>
								</div>
							</div>
						</div>
						<!-- end of col -->
						<?php	 } // end of loop?

echo "
					</div>
					<!-- end of row -->";

} else {
	echo 'No comments found.';
}


?>
<!--<div class="col-md-12 col-sm-12 col-xs-12 panel strap"><h2 style="line-height:4rem;">Our vision is that everyone who needs them experiences high quality health and care services in Buckinghamshire</h2></div>-->
<!-- 4. News -->
<div class='row news'>
	<?php
		$news = new WP_Query(array(
			'showposts' 		=> 4,
			'post_type'      	=> 'post',
			'post_status'      	=> 'publish',
			'category__in'    	=> '68',
			)
		);

		if( $news->have_posts() ) :
			$count = 1;
	?>
	<?php while($news->have_posts()) : $news->the_post(); ?>
		<?php if ($count == 1) { ?>
			<div class="col-md-12 col-sm-12 col-xs-12 panel panel-pink">
				<div class="row">
					<div class="col-md-8 col-sm-6 col-xs-12 panel-text">
						<div class="row">
							<div class="col-md-12 panel-title">
								<h2>Latest news</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a class="title-link" href="
									<?php the_permalink(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
								<?php the_excerpt(); ?>
								<!-- <p><a href="
								<?php echo get_the_permalink(); ?>">Read more &raquo;</a></p> -->
								<?php echo '
								<p style="clear: both;">
									<a class="btn btn-primary" href="' . get_category_link(68) . '">Read all ' . get_cat_name(68) . '</a>
								</p>'; ?>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 hidden-xs panel-icon">
						<a href="
							<?php the_permalink(); ?>" rel="bookmark">
							<?php the_post_thumbnail([auto,240]); ?>
						</a>
					</div>
			</div>

			<?php } else { ?>
				<div class="col-md-4 col-sm-4 hidden-xs" style="padding-right: 2rem;">
					<h3>
						<a href="
							<?php the_permalink(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h3>
					<?php the_excerpt(); ?>
					<p>
						<a href="
							<?php echo get_the_permalink(); ?>">Read more &raquo;
						</a>
					</p>
				<?php } ?>
			</div>
		<!-- end of column -->
	<?php 		$count = $count + 1;
		endwhile;
		endif; wp_reset_query();
	?>
</div>
<!-- end of row --?></div>
<!-- end of loop -->
<!-- 5. Article -->
<div class='row news'>
	<?php
		$article = new WP_Query(array(
			'showposts' 		=> 1,
			'post_type'      	=> 'post',
			'post_status'      	=> 'publish',
			'category__in'            	=> '119',)
		);
		if( $article->have_posts() ) :
	?>
	<?php while($article->have_posts()) : $article->the_post(); ?>
	<div class="panel col-md-12 col-sm-12 col-xs-12 panel-blue">
		<div class="row">
			<div class="col-md-8 col-sm-6 col-xs-12 panel-text">
				<div class="row">
					<div class="col-md-12 panel-title">
						<h2>Latest article</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<a class="title-link" href="
								<?php the_permalink(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						<?php the_excerpt(); ?>
						<!--<p><a href="
						<?php echo get_the_permalink(); ?>">Read more &raquo;</a></p>-->
						<?php echo '
						<p style="clear: both;">
							<a class="btn btn-primary" href="' . get_category_link(119) . '">Read all ' . get_cat_name(119) . '</a>
						</p>'; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 hidden-xs panel-icon">
				<a href="
					<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail([auto,240]); ?>
				</a>
			</div>
		</div>
	</div>
	<!-- end of column -->
	<?php
		endwhile;
		endif; wp_reset_query();
	?>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/client-services/">Client Services</a>
		</h3>
		<p>At Healthwatch Bucks we believe that we all learn from each other. Make sure that what people have to say helps you do better every day; our client services can help.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/client-services/">What we offer &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/category/real-stories/">Real Stories</a>
		</h3>
		<p>When it comes to health, we’ve all got a story. We’re here to help you share yours.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/category/real-stories/">Read the stories &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/about-our-meetings-in-public/">Our Meetings</a>
		</h3>
		<p>Healthwatch Bucks has a commitment to transparency and open communication. Our Board Meetings are held in public and anyone is welcome to attend.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/about-our-meetings-in-public/">Read more &raquo;</a>
		</p>
	</div>
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
									echo "<i class='fa fa-star fa-lg green'></i> ";
								}
								for ($i = 1; $i <= (5 - $rating); ++$i)  {echo "<i class='fa fa-star-o fa-lg green'></i> ";
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
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/projects/dignity-in-care/">Dignity in Care</a>
		</h3>
		<p>Our visits are a brief snapshot view of a care home at a particular point in time, looking particularly at dignity and care. We make recommendations for improvements and highlight good practice.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/projects/dignity-in-care/">Find out more &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/volunteer/">Volunteer</a>
		</h3>
		<p>Healthwatch Bucks is looking for volunteers to help in a wide variety of areas. You might want to make a difference to people around you and in your community or help those without a voice.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/volunteer/">How you can help &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/signpost-category/social-care/">Social Care in Bucks</a>
		</h3>
		<p>Helping you to find information and guidance on social care services in Buckinghamshire.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/signpost-category/social-care/">Social Care Signposts &raquo;</a>
		</p>
	</div>
</div>
<!-- end of row -->
<!-- 7. PPG -->
<div class='row news'>
	<?php
		$ppg = new WP_Query(array(
			'showposts' 		=> 1,
			'post_type'      	=> 'post',
			'post_status'      	=> 'publish',
			'category__in'            	=> '200',)
		);
		if( $ppg->have_posts() ) :
	?>
	<?php while($ppg->have_posts()) : $ppg->the_post(); ?>
	<div class="panel col-md-12 col-sm-12 col-xs-12 panel-blue">
		<div class="row">
			<div class="col-md-8 col-sm-6 col-xs-12 panel-text">
				<div class="row">
					<div class="col-md-12 panel-title">
						<h2>Supporting Bucks PPGs</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<a class="title-link" href="
								<?php the_permalink(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						<?php the_excerpt(); ?>
						<!--<p><a href="
						<?php echo get_the_permalink(); ?>">Read more &raquo;</a></p>-->
						<?php echo '
						<p style="clear: both;">
							<a class="btn btn-primary" href="' . get_category_link(200) . '">Read all ' . get_cat_name(200) . '</a>
						</p>'; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 hidden-xs panel-icon">
				<a href="
					<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail([auto,240]); ?>
				</a>
			</div>
		</div>
	</div>
	<!-- end of column -->
	<?php
		endwhile;
		endif; wp_reset_query();
	?>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/projects/patient-participation-group-support/">PPG Toolkit</a>
		</h3>
		<p>A selection to tools to develop and grow your PPG</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/projects/patient-participation-group-support/">Read more &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/press-releases/">Press & Media</a>
		</h3>
		<p>Read our latest press releases.</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/how-we-work/press-releases/">Read more &raquo;</a>
		</p>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12 subitem">
		<h3>
			<a href="https://www.healthwatchbucks.co.uk/category/results/">Reports & Results</a>
		</h3>
		<p>We produce a variety of reports and recommendations to influence service improvement</p>
		<p>
			<a href="https://www.healthwatchbucks.co.uk/category/results/">Read our reports &raquo;</a>
		</p>
	</div>
</div>
<!-- end of row -->
</div>
<!-- end of content column -->
<?php get_footer(); ?>
