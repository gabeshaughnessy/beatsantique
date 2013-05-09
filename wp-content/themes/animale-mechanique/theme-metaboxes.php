<?php
//FIRST THING FIRST, SET UP THE METABOXES FROM WPALCHEMY	

 add_action( 'add_meta_boxes', 'ga_metabox_init' );

function ga_metabox_init() {
	// Register
	wp_register_script( 'metabox', get_bloginfo('stylesheet_directory') . '/wpalchemy/MetaBox.js',		'jquery', '1.0',	true );
	wp_register_style(  'metabox',  get_bloginfo('stylesheet_directory') . '/wpalchemy/MetaBox.css' );
	wp_register_style(  'metabox-custom',  get_bloginfo('stylesheet_directory') . '/wpalchemy/metabox-custom.css' );
	
	// Enqueue
	wp_enqueue_script( 'metabox' );
	wp_enqueue_style( 'metabox' );
	wp_enqueue_style( 'metabox-custom' );
}


/**
 * WPAlchemy Metabox Class
 *
 * http://farinspace.com/wpalchemy-metabox/
 *
 * @access    public
 * @since     1.0
 */

include_once ('wpalchemy/MetaBox.php');


/**
 * WPAlchemy MediaAccess Class
 *
 * http://farinspace.com/wpalchemy-metabox/
 *
 * @access    public
 * @since     1.0
 */

include_once  ('wpalchemy/MediaAccess.php');

/* Define a media acess object */
//$wpalchemy_media_access = new WPAlchemy_MediaAccess();

//Okay now we get to the part where we create the meta boxes using the WPAlchemy Class


/**
 * Media Embed Metabox
 *
 * @access    public
 * @since     1.0
 */

$media_embed_mb = new WPAlchemy_MetaBox( array(
  'id'       => '_media_embed_mb',
  'title'    => 'Media Embed',
  'types'    => array( 'page', 'post' ),
  'context'  => 'side',
  'template' => STYLESHEETPATH. '/wpalchemy/metabox-media-embed.php'
));
?>