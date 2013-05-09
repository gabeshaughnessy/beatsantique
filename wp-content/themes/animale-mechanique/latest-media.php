<div class="twelve columns highlight">
<div class="section latest-media twelve columns ">

<?php 
//latest video and audio feature post at the top of the home page
//latest video - title, embed, excerpt, link
//latest audio - title, embed, excerpt, link
	
	//Get the latest Video Post
	// The Query
	$args = array(
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
	 'posts_per_page' => 1
	);
	$the_query = new WP_Query( $args );
	?>
	<div class="videos six columns">
	<?php
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
				<div class="post listing">
				<a href="<?php the_permalink(); ?>" title="read more"><h3>Latest Video</h3></a>
				<div class="projector"></div>
				<div class="media embed video fit-vid eleven columns offset-by-two"><?php ba_media_embed(200, 200 ,'video_url');
				?></div>
				<p class="details twelve columns align-right"><a href="<?php the_permalink(); ?>" title="read more"><?php 
				$read_more_text = get_post_meta($post->ID, 'read_more_text', true);
				if($read_more_text) {echo $read_more_text;} else {echo 'Read about the video &#187;';} ?></a></p>
				</div>
			
		
		<?php
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	?>
	</div>
	<div class="audios six columns">
	<?php
	//Get the latest Audio Post
	// The Query
	$args = array(
	'tax_query' => array(
		'relation' => 'OR',
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => array( 'music' )
				),
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-audio' )
			)
		),
	 'posts_per_page' => 1
	);
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
				<div class="post listing">
				<a href="<?php the_permalink(); ?>" title="read more">
				<div class="gramophone"></div></a>
				<!--<div class="overlay"><h3><?php the_title(); ?></h3></div>-->
				<div class="media embed audio eight columns">
				<a href="<?php the_permalink() ?>" title="get the track">
				<?php if(has_post_thumbnail()){?>
					 <div class="image-wrapper" >
						 <?php the_post_thumbnail('four-col'); ?>
					 </div>
					 <?php } 
				
				// ba_media_embed(250, 250 ,'audio_embed');
				?></a></div>
				<p class="details twelve columns"><a href="<?php the_permalink(); ?>" title="read more"><?php 
				$read_more_text = get_post_meta($post->ID, 'read_more_text', true);
				if($read_more_text) {echo $read_more_text;} else {echo 'Get the Track &#187;';} ?></a></p>
				</div>
			
		
		<?php
	endwhile;
	?>
	</div><?php
	// Reset Post Data
	wp_reset_postdata();
?></div></div><!-- end latest media section -->