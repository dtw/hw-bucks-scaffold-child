<?php get_header(); ?>

<!-- 1. Search form -->
<div class="widget widget-home widget_search">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12 shade">
				<h1>We are <?php echo get_bloginfo('title'); ?></h1>
				<h2>We make sure NHS leaders & decision makers hear your voice and use your feedback to improve care for everyone</h2>
				<?php // echo get_bloginfo('description'); ?>
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
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Front Page") ) : ?>
		<?php endif;?>
		</div>
	</div>
<!-- end of content column -->
<?php get_footer(); ?>
