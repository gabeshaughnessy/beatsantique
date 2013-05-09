<?php 	
		$topspin_code = get_post_meta($post->ID, 'ba_topspin_code',$single=true);
	
		$product_id = get_post_meta($post->ID, 'ba_product_id',$single=true);
		$product_link = get_post_meta($post->ID, 'syndication_permalink',$single=true);
		
		$product_thumb = get_post_meta($post->ID, 'post_thumb', true);
		
?>
<div class="four columns product listing <?php
echo print_the_terms('product_type', ' ');
 ?>">
 <a href="<?php echo $product_link; ?>" title="view product" target="_blank" class="row eleven columns offset-by-one">


<div class="featured-image">

	 <div class="image-wrapper" >
		<?php echo $product_thumb ?>
	 </div>
	 </div></a>
	
<?php echo '<a href="'.$product_link.'" title="get it here" class="row twelve columns" target="_blank">'; ?> <h5 class="entry-title"><?php the_title(); ?></h5></a>


</div>
