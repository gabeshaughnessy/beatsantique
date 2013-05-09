<?php 	
	$skills = get_post_meta($post->ID, 'ba_profile_skills',$single=true);
?>
<div class=" four columns profile listing <?php echo print_the_terms('profile_type', ' '); ?>">
<a href="<?php the_permalink(); ?>" title="view profile">
<div class="entry-details">
	<h5 class="entry-title center"><?php the_title(); ?></h5>
		<p class="skills"><?php echo $skills; ?></p>
</div>
	<div class="featured-image">
	<?php if(has_post_thumbnail()){?>
		 <div class="image-wrapper" >
			 <?php the_post_thumbnail('four-col'); ?>
		 </div>
	 <?php } ?></div></a>
 </div>
