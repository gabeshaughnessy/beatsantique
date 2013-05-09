<div class="post listing six columns">
<div class="featured-image">
	<?php if(has_post_thumbnail()){?>
	<a href="<?php the_permalink(); ?>">
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('three-col'); ?>
	 </div></a>
	 <?php } ?>
 </div>
 <a href="<?php the_permalink(); ?>" title="read more"><?php the_title(); ?></a>
 </div>