<?php $wpfb_api_key = 'c3a61c0df2c8f21e4446424bfffa4193'; //get_option('wpfb.api_key'); ?>

<?php if ($wpfb_api_key): ?>
	<div id="facebook-comment">
		<h2><?php echo get_option("wpfb.comment_template_title", "Comments:") ?></h2>
	 	<fb:comments width="<?php echo get_option('wpfb.box_width', '475px') ?>"></fb:comments>
		<script type="text/javascript">
			jQuery(function() {
  				FB.init('<?php echo $wpfb_api_key ?>', '<?php wpfb_xd_receiver_url() ?>');
			});
		</script>
	</div>
<?php else: ?>
	<p style="padding:10px; background-color:#ffc; color:black;">Please finishing configuring the WPFB plugin: you must provide a valid Facebook API key.</p>
<?php endif; ?>
 