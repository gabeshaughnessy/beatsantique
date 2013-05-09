<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2>
<hr />
<div class="row">
<div class="featured-image five columns">
	<?php if(has_post_thumbnail()){?>
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('two-col'); ?>
	 </div>
	 <?php } ?>
 </div>
 <div class="seven columns last">
 <?php 	if( get_post_meta($post->ID, 'audio_embed', true)) { ?>
 		
 		<div class="media embed audio row">
 			<?php ba_media_embed(300, 300, 'audio_embed') ?>
 		</div>
 		
 		 <?php }
 	
 	?>
<div class="row">
 <?php the_content(); ?>
 </div>
 </div>
<div class="twelve columns last"><?php comments_template(); // Get wp-comments.php template ?>  
 </div>
 </div>