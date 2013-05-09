<?php
/*
Template Name: Splash Page
*/
get_template_part('header', 'splash');

 if ( have_posts() ) : while ( have_posts() ) : the_post();
			get_template_part( 'entry', 'splash' );
			endwhile;
?>

<?php
endif;

get_template_part('footer', 'splash');
?>