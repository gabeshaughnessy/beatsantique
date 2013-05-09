<?php
get_header();

 if ( have_posts() ) : while ( have_posts() ) : the_post();


$format = get_post_format();
$format = ! empty( $format ) ? $format : 'default';

if ( isset( $post->post_type ) ) {
	switch( $post->post_type ) {
		case 'post' : 
			get_template_part( 'entry', $format );
			break;
		case 'page' : 
			get_template_part( 'entry', 'page' );
			break;
		case 'ba_profile' : 
			get_template_part( 'entry', 'profile' );
			break;
		case 'ba_product' : 
			get_template_part( 'entry', 'product' );
			break;
		default :
			get_template_part( 'entry' );
			break;
	}
}
endwhile;
?>

<?php
endif;

get_footer();
?>