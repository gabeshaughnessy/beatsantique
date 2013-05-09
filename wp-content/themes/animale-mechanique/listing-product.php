<?php 	
		$topspin_code = get_post_meta($post->ID, 'ba_topspin_code',$single=true);
	
		$product_id = get_post_meta($post->ID, 'ba_product_id',$single=true);
		$product_link = get_post_meta($post->ID, 'ba_product_link',$single=true);
?>
<div class="four columns product listing <?php
echo print_the_terms('product_type', ' ');
 ?>">
 <a href="<?php the_permalink(); ?>" title="view product">


<div class="featured-image">
<?php if(has_post_thumbnail()){?>
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('two-col'); ?>
	 </div>
	 <?php } ?></div></a>
 <h5 class="entry-title"><?php the_title(); ?></h5>
 <div class="topspin_purchase_wrapper"><?php if($topspin_code){echo $topspin_code;} elseif($product_link){echo '<a href="'.$product_link.'" title="get it here">Get it Here</a>';} ?></div>

</div>
