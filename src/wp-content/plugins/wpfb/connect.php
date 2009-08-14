<?php 
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

$wpfb_comments_api_key = get_option('wpfb.comments_api_key'); 
?>

<?php if ($wpfb_comments_api_key): ?>
	<div id="facebook-comment">
		<h2 style="padding-bottom: 10px;"><?php echo get_option("wpfb.comments_template_title", "Comments:") ?></h2>
	 	<fb:comments 
	 		xid="<?php wpfb_comment_xid() ?>"
	 		numposts="<?php echo get_option('wpfb.comments_numposts', '10') ?>"
	 		width="<?php echo get_option('wpfb.comments_width', '550px') ?>" 
	 		css="<?php wpfb_comment_css_url() ?>"
	 		reverse="<?php echo get_option('wpfb.comments_reverse', 'false') ?>"
	 		quiet="<?php echo get_option('wpfb.comments_quiet', 'false') ?>"></fb:comments>
		<script type="text/javascript">
			jQuery(function() {
  				FB.init('<?php echo $wpfb_comments_api_key ?>', '<?php wpfb_xd_receiver_url() ?>');
			});
		</script>
	</div>
<?php else: ?>
	<p style="padding:10px; background-color:#ffc; color:black;">Please finishing configuring the WPFB plugin: you must provide a valid Facebook API key.</p>
<?php endif; ?>
 