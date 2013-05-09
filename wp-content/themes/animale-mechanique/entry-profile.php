<?php 
$website = get_post_meta($post->ID, 'ba_profile_site',$single=true);
$facebook = get_post_meta($post->ID, 'ba_facebook',$single=true);
$soundcloud = get_post_meta($post->ID, 'ba_soundcloud',$single=true);
$twitter = get_post_meta($post->ID, 'ba_twitter',$single=true);
$lastfm = get_post_meta($post->ID, 'ba_lastfm',$single=true);
$myspace = get_post_meta($post->ID, 'ba_myspace',$single=true);
$bandcamp = get_post_meta($post->ID, 'ba_bandcamp',$single=true);
$vimeo = get_post_meta($post->ID, 'ba_vimeo',$single=true);
global $social_menu;
//build the social menu
 $social_menu .= '<ul class="social_link_list">';
 if ($facebook == true){
 $social_menu .= '<li class="facebook_link link first_link"><a href="'.$facebook.'"/>Facebook</a></li>';
 }
if ($twitter == true){
 $social_menu .= '<li class="twitter_link link"><a href="'.$twitter.'"/>Twitter</a></li>';
 }
 if ($lastfm == true){
 $social_menu .= '<li class="lastfm_link link"><a href="'.$lastfm.'"/>LastFM</a></li>';
 }
 if ($soundcloud == true){
 $social_menu .= '<li class="soundcloud_link link"><a href="'.$soundcloud.'"/>SoundCloud</a></li>';
 }
 if ($myspace== true){
 $social_menu .= '<li class="myspace_link link last_link"><a href="'.$myspace.'"/>Myspace</a></li>';
 }
 if ($bandcamp== true){
 $social_menu .= '<li class="bandcamp_link link last_link"><a href="'.$bandcamp.'"/>Bandcamp</a></li>';
 }
 if ($vimeo== true){
 $social_menu .= '<li class="vimeo_link link last_link"><a href="'.$vimeo.'"/>Vimeo</a></li>';
 }
$social_menu .= '</ul>';
 ?>
<div class="entry-content twelve columns">
<h2 class="entry-title center"><?php the_title(); ?></h2>
<hr />
<div class="row">
	<div class="featured-image four columns">
	<?php if(has_post_thumbnail()){?>
		 <div class="image-wrapper" >
			 <?php the_post_thumbnail('two-col'); ?>
		 </div>
		 <?php } ?></div>
	<div class="profile-box eight columns last">
	<div class="row">
	<?php if( get_post_meta($post->ID, 'video_url', true)) { ?>
		<div class="media embed video eight columns">
			<?php ba_media_embed(300, 300, 'video_url') ?>
		</div> <?php }
		elseif( get_post_meta($post->ID, 'audio_embed', true)) { ?>
			<div class="media embed audio nine columns">
				<?php ba_media_embed(300, 300, 'audio_embed') ?>
			</div> <?php }
		
		?>
		<?php if( get_post_meta($post->ID, 'ba_profile_site', true)) { ?>
		<div class="four columns last">
		<a href="<?php echo get_post_meta($post->ID, 'ba_profile_site', true); ?>" title="visit their site" >Visit their website &rArr;</a><?php } ?>
		<div class="social-links">	
			<h6 class="section-title left">Find them on:</h6>
			<hr/>
		<div class="menu-container">
		<?php echo $social_menu ?>
		</div>
		</div><!-- end of social links section -->
		</div>
	</div>
	</div>
</div>
<div class="content">
<?php the_content(); ?>
</div>
<div class="community">
<h4 class="section-title">Explore the Community:</h4>
<?php 
//latest video and audio feature post at the top of the home page
//latest video - title, embed, excerpt, link
//latest audio - title, embed, excerpt, link
	
	//Get the latest Video Post
	// The Query
	$args = array(
	 'post_type' => 'ba_profile',
		 'posts_per_page' => 4,
		 'orderby' => 'rand'
	);
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
				<div class="post listing three columns">
				<a href="<?php the_permalink(); ?>" title="read more">
				<?php if(has_post_thumbnail()){?>
					 <div class="image-wrapper" >
						 <?php the_post_thumbnail('four-col'); ?>
					 </div>
					 <?php } ?>
						</a>
				</div>
			
		
		<?php
	endwhile;
	
	// Reset Post Data
	wp_reset_postdata();
	
?></div><!-- end community section -->
</div>