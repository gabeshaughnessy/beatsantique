<?php 
/*
Template Name: Image Archive
*/

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2><hr>

<?php the_content(); ?>
<?php
endwhile;
endif;

// The Query
$args = array(

'tax_query' => array(
'relation' => 'OR',
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( 'images' )
		),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-image' )
		)
	),
 'posts_per_page' => -1
);
$the_query = new WP_Query( $args );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
	get_template_part('listing', 'image');
	endwhile;

// Reset Post Data
wp_reset_postdata();
?></div><?php
get_footer();
?>