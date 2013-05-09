<?php 
/*
Template Name: Video Archive
*/

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2><hr>

<div class="media embed video fit-vid"><?php ba_media_embed( 750, 423 ,'video_url');
?></div>
<hr>
<?php the_content(); ?>
<?php
endwhile;
endif;
?></div><?php
// The Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
'paged' => $paged,
'tax_query' => array(
'relation' => 'OR',
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( 'videos' )
		),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-video' )
		)
	),
 'posts_per_page' => 6
);
$the_query = new WP_Query( $args );
query_posts($args);
// The Loop
if ( have_posts() ) : while ( have_posts() ) : the_post();
	get_template_part('listing', 'video');
	endwhile;	
?>
<div class="twelve columns right">
<?php
wp_pagenavi();
?>
</div>
<?php
// Reset Post Data
wp_reset_query();
endif;
?>

<?php
get_footer();
?>