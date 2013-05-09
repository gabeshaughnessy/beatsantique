<?php 
//community feature shows four posts from the community section at random, but not the band members
?>
<div class="section community twelve columns">
<h2 class="section-title twelve columns center">Explore the Community:</h2> <hr>
<?php 

	// The Query
	$args = array(
	 'post_type' => 'ba_profile',
		 'posts_per_page' => 3,
		 'orderby' =>'rand'
	);
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		get_template_part('listing', 'profile');
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	
?>
<div class="twelve columns">
	<a href="<?php echo get_home_url() . '/community'; ?>" class="two columns centered block center read-more">More Profiles<span class="arrow down"></span></a>
</div></div><!-- end community section -->