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
		<div class="row">
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
