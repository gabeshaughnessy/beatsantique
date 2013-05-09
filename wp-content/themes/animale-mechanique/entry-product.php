<?php 
$topspin_code = get_post_meta($post->ID, 'ba_topspin_code',$single=true);
$product_link = get_post_meta($post->ID, 'ba_product_link',$single=true);
$product_tracklist = get_post_meta($post->ID, 'ba_product_tracklist',$single=true); 
$release_date = get_post_meta($post->ID, 'ba_release_date', $single=true);

$prefix = 'ba_';
	$track_titles = array();
	$track_durations = array();
	$trackcount = 1;
while($trackcount < 20){
//do stuff
if($prefix . '_track_'.$trackcount.'_title' == true){
$track_titles[] = get_post_meta($post->ID, $prefix . '_track_'.$trackcount.'_title', $single=true);
}
if($prefix . '_track_'.$trackcount.'_duration' == true){
//do stuff
$track_durations[] = get_post_meta($post->ID, $prefix . '_track_'.$trackcount.'_duration', $single=true);
}

++ $trackcount;
}

 ?>
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
 
 <div class="add_to_cart"><?php
 if($topspin_code == true){
 echo $topspin_code; }
  	else {
 	?>
 	<strong>You can buy <?php the_title(); ?> <a class="buy_link" href="<?php echo $product_link; ?>" Title="Purchase Beats Antique products from a distributor">here</a></strong>
 	<?php
 	}
 ?></div>
 
 <?php 	if( get_post_meta($post->ID, 'audio_embed', true)) { ?>
 		<div class="media embed audio">
 			<?php ba_media_embed(300, 300, 'audio_embed') ?>
 		</div> <?php }
 	
 	?>
 <?php 	if( get_post_meta($post->ID, 'ba_release_date', true)) { ?>
 <p><em class="release_date">released: <?php echo $release_date; ?></em></p>
 <?php } ?>
 <div class="entry product_tracklist">
 	    <h2 >Tracklist</h2>
 	    <ol class="tracklist">
 	    <?php
 	    $i=1;
 	     foreach($track_titles as $track_title){?>
 	     <?php if($track_title == true){?>
 	    <li  class="track" >
 	    <?php echo $track_title;
 	    ?>
 	    <em>
 	    <?php 
 	    echo $track_durations[0];
 	    $i++;
 	    ?></em></li> <?php } ?>
 	    <?php } ?></ol><!-- end of tracklist -->
 	</div>
 

 <?php the_content(); ?>
 </div>