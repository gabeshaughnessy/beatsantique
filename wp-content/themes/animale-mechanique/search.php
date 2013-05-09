<?php
get_header();

 if ( have_posts() ) : while ( have_posts() ) : the_post();

$format = get_post_format();
$format = ! empty( $format ) ? $format : 'default';

if ( isset( $post->post_type ) ) {
	switch( $post->post_type ) {
		case 'post' : 
			get_template_part( 'listing', $format );
			break;
		case 'page' : 
			get_template_part( 'listing', 'page' );
			break;
		case 'ba_profile' : 
			get_template_part( 'listing', 'profile' );
			break;
		case 'ba_product' : 
			get_template_part( 'listing', 'product' );
			break;
		default :
			get_template_part( 'listing' );
			break;
	}
}
endwhile;
?>
<?php
endif;

get_footer();
?>