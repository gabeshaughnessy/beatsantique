<?php
/*
Plugin Name: Beats Antique Custom Post Types
Plugin URI: http://beatsantique.com
Description: made by gabe for the beats antique web site
Version: 1.0
Author: Gabe Shaughnessy
Author URI: http://gabesimagination.com
License: GPL2
*/
 
// Set up Post Types
	add_action( 'init', 'ba_create_my_post_types' );	
	
	//Set up Taxonomies
	add_action( 'init', 'ba_create_my_taxonomies' );

	//Set up Meta Boxes
	add_action( 'init' , 'ba_create_metaboxes' );
function ba_create_my_post_types() {
	//Product Post Type
	$labels = array(
	    'name' => _x('Products', 'post type general name'),
	    'singular_name' => _x('Product', 'post type singular name'),
	    'add_new' => _x('Add New', 'Product'),
	    'add_new_item' => __('Add New Product'),
	    'edit_item' => __('Edit Product'),
	    'new_item' => __('New Product'),
	    'view_item' => __('View Product'),
	    'search_items' => __('Search Products'),
	    'not_found' =>  __('No Products found'),
	    'not_found_in_trash' => __('No Products found in Trash'), 
	    'parent_item_colon' => ''
	  );
	  $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true, 
	    'query_var' => true,
	    'rewrite' => true,
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'menu_position' => null,
		'taxonomies' => array( ),
	    'supports' => array('title','thumbnail','editor','revisions','excerpt', 'custom-fields')
	  ); 
	  register_post_type('ba_product',$args);
	
	//Profile Post Type   
	  	$labels = array(
	  	    'name' => _x('Profiles', 'post type general name'),
	  	    'singular_name' => _x('profile', 'post type singular name'),
	  	    'add_new' => _x('Add New', 'profile'),
	  	    'add_new_item' => __('Add New Profile'),
	  	    'edit_item' => __('Edit Profile'),
	  	    'new_item' => __('New Profile'),
	  	    'view_item' => __('View Profile'),
	  	    'search_items' => __('Search the Profiles'),
	  	    'not_found' =>  __('No Profiles found'),
	  	    'not_found_in_trash' => __('No Profiles found in Trash'), 
	  	    'parent_item_colon' => ''
	  	  );
	  	  $args = array(
	  	    'labels' => $labels,
	  	    'public' => true,
	  	    'publicly_queryable' => true,
	  	    'show_ui' => true, 
	  	    'query_var' => true,
	  	    'rewrite' => true,
	  	    'capability_type' => 'post',
	  	    'hierarchical' => false,
	  	    'menu_position' => null,
	  		'taxonomies' => array( ),
	  	    'supports' => array('title','thumbnail','editor','revisions','excerpt')
	  	  ); 
	  	  register_post_type('ba_profile',$args);
  	  }

function ba_create_my_taxonomies() {
	//Add Taxonomies for profiles 
	$labels = array(
	'separate_items_with_commas' => __( 'Choose a Profile Type, for example Musician, Visual Artist, Dancer, Designer, etc...' ),
	'choose_from_most_used' => __( 'Choose from the most used Profile Types.' )
	);
	register_taxonomy('profile_type', 'ba_profile', array(
	
	'hierarchical' => false,  'label' => 'Profile Type', 'labels' => $labels,
	
	'query_var' => true, 'rewrite' => true));
	
	//add taxonomies for products
	$labels = array(
	'separate_items_with_commas' => __( 'Choose one product type, for example Music, Clothing, Jewelry, Visual Art, etc...' ),
	'choose_from_most_used' => __( 'Choose from the most used Product Types' )
	);
	register_taxonomy('product_type', 'ba_product', array(
	
	'hierarchical' => false,  'label' => 'Product Type', 'labels' => $labels,
	
	'query_var' => true, 'rewrite' => true));
	
	$labels = array(
	'separate_items_with_commas' => __( 'Choose a product format, for example CD, T-shirt, Earrings, Poster, etc...' ),
	'choose_from_most_used' => __( 'Choose from the most used Product Formats' )
	);
	
	register_taxonomy('product_format', 'ba_product', array(
	
	'hierarchical' => false,  'label' => 'Product Format', 'labels' => $labels,
	
	'query_var' => true, 'rewrite' => true));
	
	$labels = array(
	'separate_items_with_commas' => __( 'For clothing, choose a gender, or unisex for when it does not matter!' ),
	'choose_from_most_used' => __( 'Choose from the list' )
	);
	register_taxonomy('product_gender', 'ba_product', array(
	
	'hierarchical' => false,  'label' => 'Mens/Womens',
	
	'query_var' => true, 'rewrite' => true));
	
	$labels = array(
	'separate_items_with_commas' => __( 'Here\'s where you give the artists credit for their work. This value links a community profile to a product, so pick a profile from the list below or add a new one here' ),
	'choose_from_most_used' => __( 'Choose from the existing community profiles' )
	);
	
	}
/* Meta Boxes */
function ba_create_metaboxes() {
	$prefix = 'ba_';
	$meta_boxes = array();

	$meta_boxes[] = array(
		'id' => 'ba_profile_meta_box',
		'title' => 'Media Players',
		'pages' => array('ba_profile'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			array(
				'name' => 'Skills',
				'desc' => 'What are they good at? What are they known for?',
				'id' => $prefix . 'profile_skills',
				'type' => 'textarea', // skills
				'std' => ''
			),
	
			array(
				'name' => 'Playlist',
				'desc' => 'You can paste the embed code for a playlist on Soundcloud or another site here',
				'id' => $prefix . 'profile_playlist',
				'type' => 'textarea', // playlist
				'std' => ''
			),
			array(
				'name' => 'Vimeo Video',
				'desc' => 'Alternately, you can put the ID# of a video on Vimeo.com here. You can find the ID in the url for the video, its the eight digits after vimeo.com/',
				'id' => $prefix . 'vimeo_video',
				'type' => 'text', // video
				'std' => ''
			),
			array(
				'name' => 'Youtube Video',
				'desc' => 'Same goes for YouTube, although vimeo is prefered, you can put the ID# of a video on youtube video here. You can find the ID in the url for the video, its the digits after youtube.com/watch?v=',
				'id' => $prefix . 'youtube_video',
				'type' => 'text', // video
				'std' => ''
			),
			array(
				'name' => 'Slideshow or Flash Movie',
				'desc' => 'You can paste the embed code for a slideshow or flash movie here',
				'id' => $prefix . 'profile_slideshow',
				'type' => 'textarea', // other embeddable media
				'std' => ''
			),
			
		)
		);
		// featured
	$meta_boxes[] = array(
		'id' => 'ba_featured_meta_box',
		'title' => 'Featured on Community Page?',
		'pages' => array('ba_profile'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'side',
		'show_names' => true, // Show field names on the left
		'priority' => 'low',
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			array(
				'name' => 'Featured?',
				'desc' => 'Should this community member appear in the community page? ',
				'id' => $prefix . 'featured',
				'type' => 'checkbox', // featured?
				'std' => 'true'
			)
		)
		);
	
		// product link meta box
	$meta_boxes[] = array(
		'id' => 'product_meta_box',
		'title' => 'Product Info',
		'pages' => array('ba_profile'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'show_names' => true, // Show field names on the left
		'priority' => 'high',
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			
			array(
				'name' => 'Item Number',
				'desc' => 'Get the Item Number for the product(s) from phpurchase that you want to link this artist too. You can use multiple item numbers, just separate them with a comma.',
				'id' => $prefix . 'item_numbers',
				'type' => 'text', //product id
				'std' => ''
			)
									
		)
	);	// social meta box
	$meta_boxes[] = array(
		'id' => 'ba_links_meta_box',
		'title' => 'Profile Links',
		'pages' => array('ba_profile'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			array(
				'name' => 'Website',
				'desc' => 'do they have their own site? if so, paste the url here',
				'id' => $prefix . 'profile_site',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'Facebook Link',
				'desc' => 'do they have a facebook page? if so, paste the url here',
				'id' => $prefix . 'facebook',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'Twitter Link',
				'desc' => 'do they have a twitter profile? if so, paste the url here',
				'id' => $prefix . 'twitter',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'Myspace Link',
				'desc' => 'do they have a Myspace profile? if so, paste the url here',
				'id' => $prefix . 'myspace',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'SoundCloud Link',
				'desc' => 'are they on soundcloud? if so, paste the url here, or paste the url to a soundcloud set with their music in it if you want',
				'id' => $prefix . 'soundcloud',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'Last FM Link',
				'desc' => 'are they on last fm? if so, paste the url here',
				'id' => $prefix . 'lastfm',
				'type' => 'text', // text box
				'std' => ''
			),
			array(
				'name' => 'Bandcamp Link',
				'desc' => 'do they have a Bandcamp page? if so, paste the url here',
				'id' => $prefix . 'bandcamp',
				'type' => 'text', // text box
				'std' => ''
			),
				array(
				'name' => 'Vimeo Link',
				'desc' => 'Do they have a Vimeo profile or channel? Paste the URL here',
				'id' => $prefix . 'vimeo',
				'type' => 'text', // text box
				'std' => ''
			)
		)
	
	);
	
	//Product Meta Boxes
	
	$meta_boxes[] = array(
		'id' => 'product_meta_box',
		'title' => 'Product Info',
		'pages' => array('ba_product'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			array(
				'name' => 'TopSpin Embed Code',
				'desc' => 'Paste the Embed code from the TopSpin Offer here.',
				'id' => $prefix . 'topspin_code',
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'name' => 'Item Number',
				'desc' => 'grab the Item Number for the product from phpurchase that corresponds with the product and paste it here.',
				'id' => $prefix . 'product_id',
				'type' => 'text', //product id
				'std' => ''
			),
			array(
				'name' => 'Purchase Link',
				'desc' => 'The default purchase link, if the item is only available in one place, for backwards compatibility. ',
				'id' => $prefix . 'product_link',
				'type' => 'text', //product link
				'std' => ''
			),
			array(
				'name' => 'CD Purchase Link',
				'desc' => 'The link to buy the physical CD.',
				'id' => $prefix . 'cd_product_link',
				'type' => 'text', //product link
				'std' => ''
			),
			array(
				'name' => 'Digital Purchase Link',
				'desc' => 'The Digital Download product link',
				'id' => $prefix . 'digital_product_link',
				'type' => 'text', //product link
				'std' => ''
			),
			array(
				'name' => 'Vinyl Purchase Link',
				'desc' => 'The link for the old-skool vinyl purchase.',
				'id' => $prefix . 'vinyl_product_link',
				'type' => 'text', //product link
				'std' => ''
			),
									
		)
	);
	//release details meta box starts here
	$meta_boxes[] = array(
		'id' => 'release_details_meta_box',
		'title' => 'Release Details',
		'pages' => array('ba_product'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
			
			array(
				'name' => 'Release Date',
				'id' => $prefix . 'release_date',
				'type' => 'text', //release date
				'std' => 'MM/DD/YYYY'
			),
			array(
				'name' => 'Playlist',
				'desc' => 'paste the embed code for a playlist on Soundcloud or another site here',
				'id' => $prefix . 'product_playlist',
				'type' => 'textarea', // playlist
				'std' => ''
			)
									
		)
	);
	//tracklist meta box starts here
	//Tracklist loop
	/*
	global $tracks;
	$tracks[] = array();
	$tracks[1] = array();
	$tracks[2] = array();
	$tracks[3] = array();
	$tracks[4] = array();
	  $track_count = 4;
	 $current_track = 1;
	 while($current_track < $track_count){
	 
		$tracks[] = 
			array(
		'name' => 'Track '.$current_track.' Title',
				'id' => $prefix . 'track_'.$current_track.'_title',
				'type' => 'text', //track title
				'std' => ''
			); /*,  
			array(
		'name' => 'Track '.$current_track.' Duration',
			'id' => $prefix . 'track_'.$current_track.'_duration',
			'type' => 'text', //track duration
			'std' => ''
		), 
		array(
		'name' => 'Track '.$current_track.' Liner Notes',
		'desc' => 'Credits, guest musicians, or other notes about the track. ',
		'id' => $prefix . 'track_'.$current_track.'_notes',
		'type' => 'textarea', //collaborators
		'std' => ''
		)
		
	 $current_track ++;
		
	 }//end of tracklist loop
	*/
	$trackcount = 1;
	while($trackcount < 20){
	$meta_boxes[] = array(
		'id' => 'tracklist'.$trackcount.'_meta_box',
		'title' => 'Track '.$trackcount,
		'pages' => array('ba_product'), // multiple post types -----edit this to change which post type the custom meta box appears on
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array( /*$tracks;*/
		 //field declarations create the fields in the metabox then get content from the callback function below
			
			array(
			'name' => 'Track '.$trackcount.' Title',
				'id' => $prefix . '_track_'.$trackcount.'_title',
				'type' => 'text', //track title
				'std' => ''
			),
			array(
			'name' => 'Duration',
				'id' => $prefix . 'track_'.$trackcount.'_duration',
				'type' => 'text', //track duration
				'std' => ''
						),
			array(
			'name' => 'Liner Notes',
			'desc' => 'Credits, guest musicians, or other notes about the track. ',
			'id' => $prefix . 'track_'.$trackcount.'_notes',
			'type' => 'textarea', //collaborators
			'std' => ''
			),
			array(
			'name' => 'Individual Track Item Number',
			'desc' => 'get the item number from phpurchase for the corresponding digital download product for THIS TRACK',
			'id' => $prefix . 'track_'.$trackcount.'_product_link',
			'type' => 'text', //item number from the store
			'std' => ''
			),
			array(
			'name' => 'MP3 sample file',
			'desc' => 'Paste the link to an mp3 sample here. you need the full url, starting with http:// and it should end with .mp3',
			'id' => $prefix . 'track_'.$trackcount.'_sample_mp3',
			'type' => 'text', //mp3 sample file
			'std' => ''
			),
			array(
			'name' => 'WAV sample file',
			'desc' => 'Paste the link to a WAV sample here. you need the full url, starting with http:// and it should end with .wav',
			'id' => $prefix . 'track_'.$trackcount.'_sample_wav',
			'type' => 'text', //wav sample file
			'std' => ''
			)
			)
			);
			++ $trackcount;
			}
		
 	
 	require_once('metabox/init.php'); 
}

?>