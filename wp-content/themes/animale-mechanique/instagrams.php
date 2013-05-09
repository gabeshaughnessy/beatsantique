<div class="twelve columns highlight" >
<div class="section latest-instagrams twelve columns">

<h2 class="section-title twelve columns center"><a href="http://instagram.com/beatsantique" title="view the bands Instagram profile" target="_blank" rel="author" ><span class="center">The Latest</span> <span class="camera graphic"></span> <span class="center">Instagrams:</span></a></h2><hr>
<?php
//four of the latest band instagrams
//instagrams using instagrate so they are actually image format posts


//Get the latest Image Post
// The Query
$args = array(
'tax_query' => array(
	'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => array( 'image' )
			),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-image' )
		)
	),
 'posts_per_page' => 4
);
$the_query = new WP_Query( $args );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
	?>
			<div class="post listing three columns">
			<a href="<?php the_permalink() ?>" title="get the track">
			<?php if(has_post_thumbnail()){?>
				 <div class="image-wrapper" >
					 <?php the_post_thumbnail('three-col'); ?>
				 </div>
				 <?php } 
			?></a>
			</div>
		
	
	<?php
endwhile;

// Reset Post Data
wp_reset_postdata();
?>
<div class="twelve columns">
	<a href="<?php echo get_home_url() . '/type/image'; ?>" class="two columns centered block center read-more">More Pictures<span class="arrow down"></span></a>
</div>
</div> <!-- end of instgrams section -->