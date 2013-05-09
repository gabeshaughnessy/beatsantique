<?php 
/*
Template Name: Partner Archive
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
$args = array(
'post_type'=>'ba_profile',
'tax_query' => array(
		array(
			'taxonomy' => 'profile_type',
			'field' => 'slug',
			'terms' => 'partner'
		),
			),
 'posts_per_page' => -1
);
?>
<hr><div class="partners twelve columns"> <?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//the band members
			get_template_part( 'listing', 'partner_profile' );				
endwhile;
// Reset Post Data
wp_reset_postdata();
?></div>
<?php
get_footer();
?>