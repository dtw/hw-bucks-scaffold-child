<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>
<style>

.row {
	margin-bottom: 2rem;
}

/* .news .panel {
	padding: 2rem 0;
	border: none;
	}

.news .panel h3,
.news .panel p {
	padding: 1rem 2rem 0 2rem;
	}
*/

.panel {
	background-color: rgba(0,0,0,.03);
	padding: 2rem;
	/*margin: 6rem 0 2rem 0;*/
	margin-bottom: 2rem;
	transition: 400ms ease-out 100ms;
	}
	
.widget_search {
	padding: 0 !important;
	background-image: url(https://www.healthwatchbucks.co.uk/wp-content/themes/scaffold-child/images/frontpage.jpg);
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 0% 5%;
	border-radius: 0;
	}

.widget_search .ajaxsearchpro {
	margin-top: 12rem;
	}

.widget_search p,
.widget_search h2 {
	text-shadow: #000 1px 1px 1px;
	font-weight: 700;
	color: #fff;
	text-align: left;
	padding:0px;
	}

.widget_search:before {
	content: " " !important;
}
.widget_search:after {
  content: " " !important;
  width: 
}

.panel h1 {
	text-shadow: #f2f2f2 1px 1px 1px;
	font-weight: 700;
	color: rgb(0,79,107);
	margin:0;
	padding-left: 1.5rem;
}

.panel h2 {
	color: rgba(0,0,0,.6);
	font-size: 3.2rem;
	font-weight: 700 !important;
	padding: 2rem 0 0 0;
	line-height: 3.6rem;
	}

.panel .city {
	margin-bottom: 2rem;
	color: #666;
	font-size: 2.5rem;
	line-height: 3rem;
	display: inline-block;
	font-weight: 700 !important;
}

.panel .city a {
	display: inline-block;
	margin-bottom: 0;
}

.panel .title-link {
	margin-bottom: 2rem;
	font-size: 2.5rem;
	font-weight: 700 !important;
	display: block;
	line-height: 3rem;
}

.panel-icon {
	text-align: right;
}

.panel .btn {
	margin-bottom: 0;
}

.row h3 {
	margin:0 !important;
	padding-top: 0;
	padding-bottom: .5rem;
}

h3 {
	font-weight: 700;	
}

.strap {
	text-align: center;
	padding: 2rem;
	margin-top: 0;	
}

.strap h2 {
	margin-bottom: 0px;
}

#search-box {
	background-color: rgba(35, 82, 124, 0.8);
	padding: 3rem;
}

.shade {
	background-color: rgba(35, 82, 124, 0.5);
	padding: 3rem 0 0 0;
}

.shade h2 {
	padding: 0 2rem 2rem 2rem;
	line-height:4rem;
	}

.panel-turquoise {
	background-color: rgba(179, 255, 249, .8);
	border: rgba(179, 255, 249, .8) solid 2px !important;
}

.panel-turquoise:hover {
	border: #1CFFEF solid 2px !important;
}

.panel-orange {
	border: rgba(252, 219, 214, .8) solid 2px !important;
	background-color: rgba(252, 219, 214, .8);
}

.panel-orange:hover {
	border: #F79486 solid 2px !important;
}

.panel-pink {
	border: rgba(250,216,234,.8) solid 2px !important;
	background-color: rgba(250,216,234,.8);
}

.panel-pink:hover {
	border: #F08BC0 solid 2px !important;
}

.panel-blue {
	border: rgba(185,239, 255,.8) solid 2px !important;
	background-color: rgba(185,239, 255,.8);
}

.panel-blue:hover {
	border: #2FD1FF solid 2px !important;
}

.panel-green {
	border: rgba(235,255, 190,.8) solid 2px !important;
	background-color: rgba(235,255, 190,.8);
}

.panel-green:hover {
	border: #C4FF3E solid 2px !important;
}

.feedback .row {
	margin-bottom: 0;
}

.service-icon-container {
	padding-left:0;
}

.service-icon-md {
	width: 180px;
	height: 180px;
}

.service-icon-sm {
	width: 80px;
	height: 80px;
}

.subitem {
	padding-right: 4rem;
}

@media only screen and (min-width: 769px) {
	.subitem {
		transition: 400ms ease-out 100ms;
		min-height: 215px;
	}
}

@media only screen and (max-width: 769px) {
	.panel h2 {
		font-size: 2.2rem;
		font-weight: 700 !important;
		padding: 2rem 0 0 0;
		line-height: 3rem;
	}

	.panel .title-link {
		display: block;
		font-size: 2rem;
		line-height: 2.4rem;
		font-weight: 700 !important;
	}

	.panel .city {
		font-size: 2rem;
	}

	.visit-date {
		font-size: 1.4rem;
	}

	.service-icon-md {
	width: 80px;
	height: 80px;		
	}
}

.subitem:hover {
	background-color: rgba(0,0,0,.07);
}
</style>
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
		<!-- 2. Recent feedback -->
		<?php
$args = array(
	'status' => 'approve',
	'post_type' => 'local_services',
	'number' => 4,
);

// The Query
$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );

$reviewcount = 1;

// Comment Loop
if ( $comments ) {
	echo "<div class='feedback row'>";


	foreach ( $comments as $comment ) { ?>
			<?php if ($reviewcount == 1) { ?>
			<div class="col-md-12 col-sm-12 col-xs-12 panel">
				<div class="col-md-12 panel-title">
					<h2>Recent feedback from the public</h2>
				</div>
				<?php } else { ?>
				<div class="col-md-4 col-sm-4 hidden-xs">
					<?php } ?>
					<?php 										// Display icon for taxonomy term

$term_ids = get_the_terms( $comment->comment_post_ID, 'service_types' );	// Find taxonomies
$term_id = $term_ids[0]->term_id;											// Get taxonomy ID
$term_icon = get_term_meta( $term_id, 'icon', true );						// Get meta
		?>
					<div class="feedback row">
								<?php if ($reviewcount == 1) { ?>
									<?php if ( has_post_thumbnail($comment->comment_post_ID) ) { ?>
										<div class="service-icon-container text-center col-md-4 col-xs-12">
										<a href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_post_thumbnail($comment->comment_post_ID,[auto,180]); ?>
									<?php } else { ?>
										<div class="service-icon-container text-center col-md-3 col-sm-6 col-xs-12">
										<a href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<img class="service-icon-md" src="
											<?php echo $term_icon; ?>" alt="
											<?php echo get_the_title($comment->comment_post_ID); ?>" />
									<?php } ?>
								<?php } else { ?>
									<div class="service-icon-container text-center col-md-3 col-sm-6 col-xs-12">
										<a href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<img class="service-icon-sm" src="
											<?php echo $term_icon; ?>" alt="
											<?php echo get_the_title($comment->comment_post_ID); ?>" />
								<?php } ?>
							</a>
						</div>
						<?php if ($reviewcount == 1) { ?>
							<?php if ( has_post_thumbnail($comment->comment_post_ID) ) { ?>
								<div class="col-md-8 col-xs-12">
									<a class="title-link" href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_title($comment->comment_post_ID); ?>
									</a>
							<?php } else { ?>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<a class="title-link" href="
										<?php echo get_the_permalink($comment->comment_post_ID); ?>">
										<?php echo get_the_title($comment->comment_post_ID); ?>
									</a>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-9 col-sm-6 col-xs-12">
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
										<?php echo mb_strimwidth($comment->comment_content,0,200," ..."); ?>
									</p>
									<?php } ?>
									<?php // Display star rating
$individual_rating = get_comment_meta( $comment->comment_ID, 'feedback_rating', true ); ?>
									<?php if ($individual_rating) { ?>
									<p class="star-rating p-rating">
										<?php if ($individual_rating < 1.25 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 1.25 && $individual_rating < 1.75 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-half-empty fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 1.75 && $individual_rating < 2.25 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 2.25 && $individual_rating < 2.75 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-half-empty fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 2.75 && $individual_rating < 3.25 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 3.25 && $individual_rating < 3.75 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-half-empty fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 3.75 && $individual_rating < 4.25 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-o fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 4.25 && $individual_rating < 4.75 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star-half-empty fa-lg"></i>
										<?php } ?>
										<?php if ($individual_rating >= 4.75 ) { ?>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<i class="fa fa-star fa-lg"></i>
										<?php } ?>
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
							<div class="col-md-12 panel-title">
								<h2>Latest news</h2>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
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
							<div class="col-md-3 hidden-sm hidden-xs panel-icon">
								<a href="
									<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail([auto,180]); ?>
								</a>
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

		endif; wp_reset_query(); ?>
						</div>
						<!-- end of row --?></div>
						<!-- end of loop -->
						<!-- 5. Article -->
						<div class='row news'>
							<?php

		$news = new WP_Query(array(
			'showposts' 		=> 1,
			'post_type'      	=> 'post',
			'post_status'      	=> 'publish',
			'category__in'            	=> '119',
			)
		);

		if( $news->have_posts() ) :

		?>
							<?php while($news->have_posts()) : $news->the_post(); ?>
							<div class="panel col-md-12 col-sm-12 col-xs-12 panel-blue">
								<div class="col-md-12 panel-title">
									<h2>Latest article</h2>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-12">
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
								<div style="text-align: right;" class="col-md-3 hidden-sm hidden-xs">
									<a href="
										<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail([auto,180]); ?>
									</a>
								</div>
							</div>
							<!-- end of column -->
							<?php

		endwhile;

		endif; wp_reset_query(); ?>
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
						<?php

		$mlq = new WP_Query(array(
			'post_type' => 'Local_services',
			// 'orderby' => 'rand',
			'showposts' => 1,
			'meta_query' => array(
				array(
					'key'     => 'hw_services_overall_rating',
					'value'   => array( 4, 5 ),
					'compare' => 'IN',
						),
					),
			)
		);

		if( $mlq->have_posts() ) :
		?>
						<?php while($mlq->have_posts()) : $mlq->the_post(); ?>
						<div class="row news">
							<div class='panel col-md-12 col-sm-12 col-xs-12 panel-green' id='dignity-in-care'>
								<div class="col-md-12 panel-title">
									<h2>Lastest Dignity in Care visit</h2>
								</div>
								<div class="text-center col-md-4 col-sm-12">
									<a href="
										<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail([auto,180]); ?>
									</a>
								</div>
								<!-- end of col -->
								<div class="col-md-8 col-sm-12">
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
				echo "
										<i class='fa fa-star fa-2x green'></i> ";
				}
				for ($i = 1; $i <= (5 - $rating); ++$i)  {
				echo "
										<i class='fa fa-star-o fa-2x green'></i> ";
				}
			?>
									</p>
									<p class="visit-date">Visited on
										<?php echo the_date(); ?>
									</p>
									<?php // get_template_part("elements/comments-rating-average"); ?>
								</div>
								<!-- end of column -->
							</div>
							<!-- end of panel -->
							<?php
		endwhile; endif; wp_reset_query(); ?>
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
									<a href="https://www.healthwatchbucks.co.uk/service-guide/">Social Care in Bucks</a>
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

		$news = new WP_Query(array(
			'showposts' 		=> 1,
			'post_type'      	=> 'post',
			'post_status'      	=> 'publish',
			'category__in'            	=> '200',
			)
		);

		if( $news->have_posts() ) :

		?>
							<?php while($news->have_posts()) : $news->the_post(); ?>
							<div class="panel col-md-12 col-sm-12 col-xs-12 panel-blue">
								<div class="col-md-12 panel-title">
									<h2>Supporting Bucks PPGs</h2>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-12">
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
								<div style="text-align: right;" class="col-md-3 hidden-sm hidden-xs">
									<a href="
										<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail([auto,180]); ?>
									</a>
								</div>
							</div>
							<!-- end of column -->
							<?php

		endwhile;

		endif; wp_reset_query(); ?>
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
