<div class="section latest-news twelve columns">
<?php 
// template part that shows the latest news posts
//latest news posts - title, featured image, excerpt and link
	
	// The Query
	$args = array(
	'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => array( 'blog' )
			),
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-video', 'post-format-audio', 'post-format-image' ),
				'operator' => 'NOT IN'
			)
		),
	'posts_per_page' => 2
	);
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<div class="news post six columns">
				<a href="<?php the_permalink(); ?>" title="read more"><h3><?php the_title(); ?></h3></a>
				
				<?php if(has_post_thumbnail()){?>
					 <a href="<?php the_permalink(); ?>" title="read more"><div class="image-wrapper" >
						 <?php the_post_thumbnail('three-col'); ?>
					 </div></a>
					 <?php } 
				?>
				<p class="details"><span class="short-description"><?php the_excerpt(); ?></span><a href="<?php the_permalink(); ?>" title="read more">Read More</a></p>
			</div>
		
		<?php
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
?></div><!-- end latest news section -->
<div class="twelve columns">
	<a href="<?php echo get_home_url() . '/category/blog'; ?>" class="two columns centered block center read-more">More News<span class="arrow down"></span></a>
</div>
