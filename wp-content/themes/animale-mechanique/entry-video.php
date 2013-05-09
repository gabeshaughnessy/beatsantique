<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2>
<hr />
 <?php 	if( get_post_meta($post->ID, 'video_url', true)) { ?>
 		<div class="media embed audio fit-vid">
 			<?php ba_media_embed(960, 450, 'video_url') ?>
 		</div> <?php }
 	
 	?>

 <?php the_content(); ?>
<?php comments_template(); // Get wp-comments.php template ?>  
 </div>