<?php
/*
Template Name: home page 
*/

get_header();
get_template_part('hero');
get_template_part('latest', 'media');
get_template_part('latest', 'news');
get_template_part('instagrams');
get_template_part('menu', 'social');
get_template_part('community');
get_template_part('upcoming_shows');
//the main loop - we aren't using this
 if ( have_posts() ) : while ( have_posts() ) : the_post();

endwhile;
?>
<?php
endif;

get_footer();
?>