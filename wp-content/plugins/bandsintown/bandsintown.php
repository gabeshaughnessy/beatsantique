<?php
/*
Plugin Name: Tour Dates
Plugin Description: Bandsintown's Tour Dates plugin makes it easy for artists to showcase their upcoming tour dates anywhere on their WordPress-powered blog or website. Easily display an automatically updated list of your tour dates to your fans using the widget, shortcode or template tag.
Plugin Author: Bandsintown.com
Author URI: http://www.bandsintown.com 
Version: 1.0.0
*/

//
// Bandsintown Plugin
//
class Bandsintown_JS_Plugin {
	
	function Bandsintown_JS_Plugin() {
		if ( is_admin() ) {
			add_action('admin_menu', array($this, 'admin_menu'));
		}
		else {
			add_action('wp_head', array($this, 'wp_head'));
		}
		
		// Shortcode
		add_shortcode('bandsintown_events', array($this, 'shortcode'));
		
		// Widget
		add_action('widgets_init', create_function('', 'return register_widget("Bandsintown_JS_Widget");'));
		
		$this->options = get_option('bitp_options');
	}
	
	// utility method for debugging
	function dump( $var ) { echo '<pre>'; var_dump($var); echo '</pre>'; }

	// rendering for views
	function render( $file, $output = true ) {
		if ( !$output ) {
			ob_start();
			include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . basename($file);
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
		else {
			include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . basename($file);
		}
	}

	// Admin menu management.
	function admin_menu() {
		add_options_page('Tour Dates', 'Tour Dates', 'administrator', 'bandsintown-settings', array($this, 'settings'));
	}
	
	function wp_head() {
		echo "\n<script type='text/javascript' src='http://www.bandsintown.com/javascripts/bit_widget.js'></script>\n";
	}
	
	// Manage plugin settings
	function settings() {
		if ( sizeof($_POST) ) {
			$options = $_POST['bitp_options'];
			$options['custom_css'] = stripslashes($options['custom_css']); 
			update_option('bitp_options', $options);
			$this->success = 'Your changes were saved.';
		}
		$this->options = get_option('bitp_options');
		$this->render('settings.php');
	}
	
	// [bandsintown] shortcode
	function shortcode( $atts, $content = null, $code = '' ) {
		return $this->template_tag($atts, false);
	}
	
	// actual processing of the template tag
	function template_tag( $params = array(), $echo = true ) {
		if ( !is_array( $params ) ) {
			$str = $params;
			$params = array();
			parse_str($str, $params);
		}
		if ( empty($params['artist']) ) {
			$params['artist'] = $this->options['artist'];
		}
		$output = "<script type='text/javascript'>var widget = new BIT.Widget({";
		if ( count($params) > 0 ) {
			$i = 0;
			foreach ( $params as $key => $val ) {
				$output .= "\"$key\": \"$val\", ";
			}
			if ( !isset($params['prefix']) ) {
				$output .= '"prefix": "wpjs", ';
			}
			$output = substr($output, 0, -2);
		}
		$output .= "});widget.insert_events();</script>";
		$options = get_option('bitp_options');
		if ( !empty($options['custom_css']) ) {
			$output .= '<style type="text/css">' . $options['custom_css'] . '</style>';
		}
		if ( $echo ) {
			echo $output;
		}
		else {
			return $output;
		}
	}
	
} // end Bandsintown_JS_Plugin

//
// Bandsintown Widget
//
class Bandsintown_JS_Widget extends WP_Widget {
	
	function Bandsintown_JS_Widget() {
		parent::WP_Widget(false, $name = 'Tour Dates');
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget;
		if ( $title ) 
			echo $before_title . $title . $after_title;
		the_bandsintown_events(array( 
			'artist' => $instance['artist'], 
			'display_limit' => $instance['display_limit'],
			'force_narrow_layout' => true 
		));
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['artist'] = strip_tags(stripslashes($new_instance['artist']));
		$instance['display_limit'] = strip_tags(stripslashes($new_instance['display_limit']));
		return $instance;
	}
	
	function form( $instance ) {
		if ( empty($instance['artist']) ) {
			$options = get_option('bitp_options');
			$instance['artist'] = $options['artist'];
		}
		include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'widget-form.php';
	}
	
} // end Bandsintown JS Widget


global $bitp;
$bitp = new Bandsintown_JS_Plugin();

// template tag wrapper
function the_bandsintown_events( $params = array(), $echo = true ) {
	global $bitp;
	return $bitp->template_tag( $params, $echo );
}
