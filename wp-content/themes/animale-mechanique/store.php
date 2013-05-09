<?php 
/*
Template Name: Store
*/

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="entry-content twelve columns">
<h2 class="page-title center"><?php the_title() ?></h2><hr>
<?php the_content(); ?>
<?php
endwhile;
endif;
?></div>
<div class="featured products twelve columns">
<?php
global $music;
$args = array(
'post_type'=>'ba_product',
'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'product_type',
			'field' => 'slug',
			'terms' => 'music'
		),
		array(
					'taxonomy' => 'product_type',
					'field' => 'slug',
					'terms' => 'killthe8',
					'operator' => 'NOT IN'
				),
		
			),
 'posts_per_page' => 1
);
?>
<h3 class="center">New Release:</h3><hr> <?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//the music products
			get_template_part( 'listing', 'music_product-featured');	
			$music[] = $post->ID;			
endwhile;
// Reset Post Data
wp_reset_postdata();
?>
</div>
<?php
global $music;
$args = array(
'post_type'=>'ba_product',
'offset'=> 1,
'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'product_type',
			'field' => 'slug',
			'terms' => 'music'
		),
		array(
					'taxonomy' => 'product_type',
					'field' => 'slug',
					'terms' => 'killthe8',
					'operator' => 'NOT IN'
				),
			),
 'posts_per_page' => 10
);
?><div class="music products twelve columns">
<h3 class="center">Music:</h3><hr> <?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//the music products
			get_template_part( 'listing', 'music_product');	
			$music[] = $post->ID;			
endwhile;
// Reset Post Data
wp_reset_postdata();
?><hr /></div><?php
$args = array(
 'post_type' => 'ba_product',
 'posts_per_page' => -1,
 'post__not_in' => $music,
 'tax_query' => array(
 		array(
 			'taxonomy' => 'product_type',
 			'field' => 'slug',
 			'terms' => 'killthe8'
 		)
 	)
);
?>

<div class="twelve columns">
<h3 class="center">Everything Else:</h3><hr>
<p class="three columns"><em>Filter products by:</em></p>
<ul id="profile-filter" class="filter-menu button-group nine columns">
<?php echo isotope_filter_menu('product_type'); ?>
</ul>
<div class="products filter-target row">
<?php  
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
			//everyone else
			get_template_part( 'listing', 'product-killthe8' );
			
endwhile;
// Reset Post Data
wp_reset_postdata();
?></div>
<p>We have tons of merch available at our partner store with Killthe8.com, including <a href="http://www.kt8merch.com/store/pages/17718">Bundles,</a> <a href="http://www.kt8merch.com/store/pages/17718?t=guys">Men's</a> and <a href="http://www.kt8merch.com/store/pages/17718?t=girls">Women's Clothing,</a> <a href="http://www.kt8merch.com/store/pages/17718?t=accessories">Accessories</a> and <a href="http://www.kt8merch.com/store/pages/gift-certificate">Gift Cards.</a> </p><a class="button" href="http://www.kt8merch.com/store/pages/beatsantique"><strong> Check it out!</strong></a> 
</div>
<?php
get_footer();
?>