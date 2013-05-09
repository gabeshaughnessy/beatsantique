<?php 
/*
Template Name: Press Page
*/

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="entry-content twelve columns">
<div class="featured-image ">
	<?php if(has_post_thumbnail()){?>
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail(); ?>
	 </div>
	 <?php } ?>
 </div>
<?php the_content(); ?>
<?php
endwhile;
endif;

$args = array(
'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => 'press'
		),
			),
 'posts_per_page' => -1
);
?><div class="press"> <?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//the music products
			get_template_part( 'listing', 'press' );				
endwhile;
// Reset Post Data
wp_reset_postdata();
?></div>
<?php
get_footer();
?>