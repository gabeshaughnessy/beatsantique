<?php // The Query
$sticky = get_option( 'sticky_posts' );
$args = array(
 'posts_per_page' =>1,
 'post_type' => 'post',
 'post__in'  => $sticky,
 'ignore_sticky_posts' => 1
);
$the_query = new WP_Query( $args );
?>
<?php

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();

	?>
		<div class="hero row overlay-wrapper<?php echo $i; ?>">
		<div class="overlay twelve columns">
			<div class="row"><h2 class=" center title ten columns centered"><?php the_title(); ?></h2></div>
			<div class="row"><div class=" center ten columns centered overlay-wrapper"><a href="<?php echo the_permalink(); ?>" class="overlay button secondary"><?php 
			$read_more_text = get_post_meta($post->ID, 'read_more_text', true);
			if($read_more_text) {echo $read_more_text;} else {echo 'Read More';} ?></a></div></div>
		</div>
		<div class="featured-image twelve columns">
			<?php if(has_post_thumbnail()){?>
			 <div class="image-wrapper" >
				 <?php the_post_thumbnail(); ?>
			 </div>
			 <?php } ?>
		 </div>
		</div>	<?php
		
		
endwhile;

// Reset Post Data
wp_reset_postdata();
?>
