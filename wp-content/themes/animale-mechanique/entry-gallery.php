<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2>
<hr />

<div class="featured-image">
	<?php if(has_post_thumbnail()){?>
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('two-col'); ?>
	 </div>
	 <?php } ?>
 </div>
 

 <?php the_content(); ?>
 </div>