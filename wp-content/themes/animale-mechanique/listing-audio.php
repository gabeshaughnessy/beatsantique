<div class="post listing six columns">
<a href="<?php the_permalink(); ?>" title="read more"><?php the_title(); ?></a>
<?php if (get_post_meta($post->ID, 'audio_embed', true)){?><div class="media embed audio"><?php ba_media_embed(300, 300 ,'audio_embed');
?></div><?php } else {
?>
<div class="featured-image">
	<?php if(has_post_thumbnail()){?>
	<a href="<?php the_permalink(); ?>">
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('three-col'); ?>
	 </div></a>
	 <?php } ?>
 </div>

<?php
}?>
<p class="details"><span class="short-description"><?php the_excerpt(); ?></span><a href="<?php the_permalink(); ?>" title="read more">Read More</a></p>
</div>