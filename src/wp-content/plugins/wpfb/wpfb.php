<?php
/*
Plugin Name: WPFB
Plugin URI: http://wpfb.googlecode.com
Description: Wordpress Facebook Connect Integration Platform
Author: Aaron Collegeman, Blake Schwendiman 
Version: 1.0
Author URI: http://aaroncollegeman.com, http://thewhyandthehow.com
*/

// our connect template is stored at ./wpfb/connect.php
$wpfb_connect_template = dirname(__FILE__).'/connect.php';

// enqueue the FacebookLoader Javascript
wp_enqueue_script('FacebookFeatureLoader', 'http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php', array('jquery'));
wp_enqueue_style('WPFB', get_bloginfo('home').'/wp-content/plugins/wpfb/style.css');

// legacy comment template support: filter the comment template name and replace it with our connect.php
add_filter('comments_template', 'wpfb_legacy_comments');
function wpfb_legacy_comments($file) {
	global $wpfb_connect_template;
	return $wpfb_connect_template;
}

// filter language_attributes() function, to provide fb namespace
add_filter('language_attributes', 'wpfb_language_attributes');
function wpfb_language_attributes($output) {
	return $output . ' xmlns:fb="http://www.facebook.com/2008/fbml"';
}

// function for printing the current URL, for fb:comments xid attribute
function wpfb_current_url() {
	echo
		'http'.($_SERVER['HTTPS'] == 'on' ? 's' : '') .
		'://' .
		$_SERVER['SERVER_NAME'] .
		($_SERVER['SERVER_PORT'] != '80' ? ':'.$_SERVER['SERVER_PORT'] : '') .
		$_SERVER['PATH_INFO'] .
		($_REQUEST['p'] ? '/?p='.$_REQUEST['p'] : '');
}

function wpfb_xd_receiver_url() {
	echo get_bloginfo('home') . '/wp-content/plugins/wpfb/xd_receiver.htm';
}


