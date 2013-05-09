<?php 
add_action( 'after_setup_theme', 'animale_setup' );

if ( ! function_exists( 'animale_setup' ) ):

function animale_setup(){
// Load up our theme options page and related code.
//require( get_template_directory() . 'optons.php' );

/* Menus */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main_menu' => 'Main Menu',
		  'social_menu' => 'Social Links Menu'
		)
	);
}
add_theme_support( 'post-thumbnails' );
add_theme_support('post-formats', array('video', 'image', 'gallery', 'audio'));
set_post_thumbnail_size(960, 300, true);
add_image_size('two-col', 475, 475, true);
add_image_size('three-col', 300, 300, true);
add_image_size('four-col', 230, 230, true);

//add thumbnail image column
require_once('thumb_column.php');

//set up metaboxes for additional post/page content
//require_once('theme-metaboxes.php');
}


endif; // end animale_setup

add_action( 'wp_enqueue_scripts', 'enqueue_my_scripts');
if( ! function_exists('enqueue_my_scripts')):
function enqueue_my_scripts(){
//Load Javascripts
wp_enqueue_script('jquery');
wp_enqueue_script('isotope', get_bloginfo('stylesheet_directory') .'/js/isotope.min.js', 'jquery');//isotope from metafizzy
wp_enqueue_script('foundation-nav', get_bloginfo('stylesheet_directory').'/foundation/javascripts/jquery.foundation.navigation.js', 'jquery');
wp_enqueue_script('scroll-to', get_bloginfo('stylesheet_directory').'/js/jquery.scrollTo-1.4.3-min.js', 'jquery');
wp_enqueue_script('local-scroll', get_bloginfo('stylesheet_directory').'/js/jquery.localscroll-1.2.7-min.js', 'scroll-to');

//do this one last
wp_enqueue_script('custom',  get_bloginfo('stylesheet_directory') .'/js/custom.js', array('jquery', 'isotope'));
}

endif;

add_action( 'wp_enqueue_scripts', 'enqueue_my_styles');

if( ! function_exists('enqueue_my_styles')):
function enqueue_my_styles(){
//Load Javascripts
wp_enqueue_style('foundations', get_bloginfo('stylesheet_directory') .'/foundation/stylesheets/foundation.min.css', 'foundations');//Zurb Foundation base styles
wp_enqueue_style('foundations_app', get_bloginfo('stylesheet_directory') .'/foundation/stylesheets/app.css', 'foundations-app');//Zurb Foundation app styles

wp_enqueue_style('theme-styles', get_bloginfo('stylesheet_url'));//theme styles
}

endif;

//Helper Functions - not loaded with theme setup

function ba_media_embed($width, $height, $source){//displays the multi-media content
global $post;
$media_source = get_post_meta($post->ID, $source, true);
$media_width = $width;
$media_height = $height;
if($source == 'video_url'){
$wp_embed = new WP_Embed();
$the_media = $wp_embed->run_shortcode( '[embed width='. $media_width . ' height='. $media_height .']' . $media_source . '[/embed]' );
 echo $the_media; 
 }
 elseif($source == 'audio_embed'){ 
 echo $media_source;
 }
}//end media_embed

//prints out a list of taxonomy terms for use in front-end filters, among other things
function print_the_terms($taxonomy, $separator){
global $terms;
global $post;
$terms = get_the_terms($post->ID, $taxonomy); 
if ( $terms && ! is_wp_error( $terms ) ) : 
	
	foreach ( $terms as $term ) {
		$tax_items[] = $term->slug;
	}
						
	$the_terms = join($tax_items, $separator);
	return $the_terms;
	endif;
}

function isotope_filter_menu($taxonomy){
global $terms;
global $post;
$terms = get_terms($taxonomy); 
if ( $terms && ! is_wp_error( $terms ) ) { 
	
	foreach ( $terms as $term ) {
	if($term->slug != 'killthe8'){
		$tax_items[] = "<li><a href='#' class='tiny button secondary' data-filter='.".$term->slug."'>".$term->name." </a></li>";
		
		$the_terms = join($tax_items, ' ');
	}
	}
	$tax_items[] = "<li><a href='#' class='tiny button' data-filter='*'>show all</a></li>";
	$the_terms = join($tax_items, ' ');
	return $the_terms;
}
else {
return "no terms";
}

}

/* Nav Menu Walkers */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu flyout\">\n";
  }
 
  // add main/sub classes to li's and links
   function start_el( &$output, $item, $depth, $args ) {
      global $wp_query;
      $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
    
      // depth dependent classes
      $depth_classes = array(
          ( $depth == 0 ? 'has-flyout main-menu-item' : 'has-flyout sub-menu-item' ),
          ( $depth >=2 ? 'has-flyout sub-sub-menu-item' : '' ),
          ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
          'menu-item-depth-' . $depth
      );
      $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
    
      // passed classes
      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    
      // build html
      $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="dropdown ' . $depth_class_names . ' ' . $class_names . '">';
    
      // link attributes
      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
      
     

      
      $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',  
          
          $args->before,
          ' class="flyout-toggle"'. $attributes, 
          $args->link_before,
          
          apply_filters( 'the_title', $item->title, $item->ID ),
          $args->link_after,
          $args->after
      );
    
      // build html
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  }

?>