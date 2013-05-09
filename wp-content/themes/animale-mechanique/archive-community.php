<?php 
/*
Template Name: Community Archive
*/


get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="entry-content twelve columns">
<?php the_content(); ?>
<?php
endwhile;
endif;
?></div><?php
global $bandposts;
$bandposts = array();
$args = array(
'post_type'=>'ba_profile',
'tax_query' => array(
		array(
			'taxonomy' => 'profile_type',
			'field' => 'slug',
			'terms' => 'band-member'
		),
			),
 'posts_per_page' => -1
);
?>
<h3 class="center">Band Members</h3><hr><div class="band-members twelve columns"> <?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//the band members
			get_template_part( 'listing', 'band_profile' );	
			$bandposts[] = $post->ID;			
endwhile;
// Reset Post Data
wp_reset_postdata();
?></div><?php
global $bandposts;
$args = array(
 'post_type' => 'ba_profile',
 'posts_per_page' => -1,
 /*'tax_query' => array(
 		array(
 			'taxonomy' => 'profile_type',
 			'field' => 'slug',
 			'terms' => 'band-member'
 		),
 			),*/
 			'post__not_in' => $bandposts
);
?>
<div class="twelve columns">
<h3 class="center">Everyone Else</h3><hr>
<p class="three columns"><em>Filter profiles by:</em></p>
<ul id="profile-filter" class="filter-menu button-group nine columns">
<?php echo isotope_filter_menu('profile_type'); ?>
</ul>

<div class="everyone-else filter-target row"><?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//everyone else
			get_template_part( 'listing', 'profile' );
			
endwhile;
// Reset Post Data
wp_reset_postdata();
?></div></div>
<?php
get_footer();
?>