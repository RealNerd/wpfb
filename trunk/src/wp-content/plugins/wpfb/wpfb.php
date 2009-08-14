<?php
/*
Plugin Name: WPFB
Plugin URI: http://wpfb.googlecode.com
Description: Wordpress Facebook Connect Integration Platform
Author: Aaron Collegeman, Blake Schwendiman 
Version: 0.1.0
Author URI: http://aaroncollegeman.com, http://thewhyandthehow.com
*/

/**
 * Wordpress Facebook Connect Integration Platform
 * Copyright (C)2009 Collegeman.net, LLC.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA. 
 */

// our comment template is stored at ./wpfb/connect.php
$wpfb_comments_template = dirname(__FILE__).'/connect.php';

// enqueue the FacebookLoader Javascript
wp_enqueue_script('FacebookFeatureLoader', 'http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php', array('jquery'));

// legacy comment template support: filter the comment template name and replace it with our connect.php
add_filter('comments_template', 'wpfb_legacy_comments');
function wpfb_legacy_comments($file) {
	global $wpfb_comments_template;
	return $wpfb_comments_template;
}

// filter language_attributes() function, to provide fb namespace
add_filter('language_attributes', 'wpfb_language_attributes');
function wpfb_language_attributes($output) {
	return $output . ' xmlns:fb="http://www.facebook.com/2008/fbml"';
}

// function for printing the current URL, for fb:comments xid attribute
function get_wpfb_current_url() {
	return
		'http'.($_SERVER['HTTPS'] == 'on' ? 's' : '') .
		'://' .
		$_SERVER['SERVER_NAME'] .
		($_SERVER['SERVER_PORT'] != '80' ? ':'.$_SERVER['SERVER_PORT'] : '') .
		$_SERVER['PATH_INFO'] .
		($_REQUEST['p'] ? '/?p='.$_REQUEST['p'] : '');
}

function wpfb_current_url() {
	echo get_wpfb_current_url();
}

function wpfb_xd_receiver_url() {
	echo get_bloginfo('home') . '/wp-content/plugins/wpfb/xd_receiver.htm';
}

function wpfb_comment_css_url() {
	echo get_bloginfo('home') . '/wp-content/plugins/wpfb/style.css?' . filemtime(realpath(dirname(__FILE__)).'/style.css');
}

function get_wpfb_comment_xid() {
 	if (!($permalink = get_permalink())) {
 		$permalink = get_wpfb_current_url();	
 	}
 	return md5($permalink + get_option('wpfb.api_key'));
}

function wpfb_comment_xid() {
	echo get_wpfb_comment_xid();
}

add_action('admin_menu', 'wpfb_plugin_menu');
function wpfb_plugin_menu() {
	add_menu_page('Connect', 'Connect', 8, __FILE__, 'wpfb_connect_options_form', get_bloginfo('home') . '/wp-content/plugins/wpfb/facebook_icon.png');
	
	wp_enqueue_script('jQueryValidity', get_bloginfo('home').'/wp-content/plugins/wpfb/jquery.validity.min.js', array('jquery'));
}

function wpfb_connect_options_form() {
	
	$submitted = false;
	
	if (isset($_REQUEST['nonce']) && ($nonce = $_REQUEST['nonce'])) {
		if (wp_verify_nonce($nonce, 'wpfb')) {
			$submitted = true;
			
			update_option('wpfb.comments_box_enabled', $_REQUEST['use_connect_comments']);
			update_option('wpfb.comments_api_key', trim($_REQUEST['comments_api_key']));
			update_option('wpfb.comments_template_title', trim($_REQUEST['comments_template_title']));
			update_option('wpfb.comments_width', trim($_REQUEST['comments_width']));
			update_option('wpfb.comments_numposts', trim($_REQUEST['comments_numposts']));
			update_option('wpfb.comments_reverse', isset($_REQUEST['comments_reverse']) ? 'true' : 'false');
			update_option('wpfb.comments_quiet', isset($_REQUEST['comments_quiet']) ? 'true' : 'false');
		}
	}
	
	
	?>
		<script type="text/javascript">
			$j = jQuery.noConflict();
			$j(function() {
				$j('#wpfb_settings').validity(function() {
					var width = $j('#comments_width');
					if (!width.val().match(/px$/))
						width.val($j.trim(width.val())+'px');
					
					if ($j("input[name='use_connect_comments']:checked").val() == 'true') {
						$j('#comments_api_key').require("Required.");
						$j('#comments_numposts').require("Required.").match("number", "Must be a number.");
					}	
				});
			});

		</script>
		
		<form id="wpfb_settings" action="admin.php?page=wpfb/wpfb.php" method="post">
		
			<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('wpfb') ?>" />
	
			<div class="wrap">
				<div id="icon-options-general" class="icon32"><br /></div>
				<h2>Facebook Connect</h2>
				
				<?php if ($submitted): ?>
					<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><strong>Settings saved.</strong></p></div>
				<?php endif; ?>
				
				<fieldset style="padding: 10px; margin-top:10px; background-color: white; border: 1px solid #ccc;" >
					<div style="float: right;">
						<label><input type="radio" name="use_connect_comments" value="true" <?php if (get_option("wpfb.comments_box_enabled", 'true', true) == 'true') echo 'checked="checked"' ?> /> Enabled</label>
						&nbsp; <label><input type="radio" name="use_connect_comments" value="false" <?php if (get_option("wpfb.comments_box_enabled", 'true', true) == 'false') echo 'checked="checked"' ?> /> Disabled</label>
					</div>
				
					<h3 style="margin-top:0; padding-top:0;">Comments Box</h3>
					
					<p>Replace your themes' comment template with Facebook-style comments.</p>
					
					<table class="form-table">
					
						<tr>
							<th><label for="comments_api_key">Your Facebook API key</label></th>
							<td><input type="text" name="comments_api_key" id="comments_api_key" style="width:300px;" value="<?php echo get_option("wpfb.comments_api_key", '') ?>" />
								&nbsp; <a href="http://developers.facebook.com/get_started.php" target="_blank">Get one now</a>
								<p style="width: 350px;"><em>Once you've created your new Facebook Application, you'll need to set the
								new application's </em>Connect URL<em> to the URL of your Wordpress installation:</em><br /><br />
								<b><?php bloginfo('home') ?></b>
								</p>
							</td>
						</tr>
						
						<tr>
							<th><label for="comments_template_title">Comments Title</label></th>
							<td><input type="text" name="comments_template_title" id="comments_template_title" value="<?php echo get_option("wpfb.comments_template_title", "Comments:") ?>" /></td>
						</tr>
						
						<tr>
							<th><label for="comments_width">Width of Comment Box</label></th>
							<td><input type="text" name="comments_width" id="comments_width" value="<?php echo get_option("wpfb.comments_width", '550px') ?>" /></td>
						</tr>
						
						<tr>
							<th><label for="comments_numposts">Number of Posts to Display</label></th>
							<td><input type="text" name="comments_numposts" id="comments_numposts" value="<?php echo get_option("wpfb.comments_numposts", 10) ?>" /></td>
						</tr>
						
						<tr>
							<th></th>
							<td>
								<label for="comments_reverse">
									<input type="checkbox" name="comments_reverse" id="comments_reverse" value="true" <?php if (get_option("wpfb.comments_reverse", 'false') == 'true') echo 'checked="checked"' ?> />
									Display Comments in Ascending Order by Date
								</label>
							</td>
						</tr>
						
						<tr>
							<th></th>
							<td>
								<label for="comments_quiet">
									<input type="checkbox" name="comments_quiet" id="comments_quiet" value="true" <?php if (get_option("wpfb.comments_quiet", 'false') == 'true') echo 'checked="checked"' ?> />
									Don't display comments on commenters' Facebook walls
								</label>
							</td>
						</tr>
					
					</table>
				</fieldset>
				
				<p class="submit">
					<input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
				</p>
			
			</div>
		
		</form>
	<?php 
	
}

