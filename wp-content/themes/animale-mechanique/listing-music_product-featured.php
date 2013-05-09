<?php 	
		$topspin_code = get_post_meta($post->ID, 'ba_topspin_code',$single=true);
	
		$product_id = get_post_meta($post->ID, 'ba_product_id',$single=true);
		$cd_product_link = get_post_meta($post->ID, 'ba_cd_product_link',$single=true);
		$digital_product_link = get_post_meta($post->ID, 'ba_digital_product_link',$single=true);
		$vinyl_product_link = get_post_meta($post->ID, 'ba_vinyl_product_link',$single=true);
		$product_link = get_post_meta($post->ID, 'ba_product_link',$single=true);
?>
<div class="twelve center columns product listing <?php
echo print_the_terms('product_type', ' ');
 ?>">
 <a href="<?php echo $digital_product_link ?>" title="view product">


<div class="featured-image">
<?php if(has_post_thumbnail()){?>
	 <div class="image-wrapper" >
		 <?php the_post_thumbnail('two-col'); ?>
	 </div>
	 <?php } ?></div></a>
 <h4 class="entry-title"><?php the_title(); ?></h4>
 <div class="topspin_purchase_wrapper">
 <?php 
 if($digital_product_link || $cd_product_link || $vinyl_product_link){
 if($digital_product_link){echo '<a href="'.$digital_product_link.'" title="digital files for you!">MP3 | </a>';
 } 
 if($cd_product_link){
 echo '<a href="'.$cd_product_link.'" title="get CD action here">CD</a>';
 } 
  if($vinyl_product_link){echo '<a href="'.$vinyl_product_link.'" title="get some vinyl in your life"> | VINYL</a>';
  } 
  }
  elseif ($product_link) { 
  echo '<a href="'.$product_link.'" title="get it here">Get it here</a>';
  }
 ?></div>

</div>
