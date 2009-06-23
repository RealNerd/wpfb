<?php
add_action('thesis_hook_after_post', 'fb_comment_box');
add_action('thesis_hook_after_post', 'fb_comment_plug');
add_filter('language_attributes', 'add_fb_xml_ns');


function add_fb_xml_ns($content) {
  return ' xmlns:fb="http://www.facebook.com/2008/fbml" ' . $content;
}

function fb_comment_box() {
  if (is_single() || is_page()) {
  ?>
<a name="fb_comments"></a>
<p class="fb-comments">Comments:</p>
<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<fb:comments></fb:comments>
<script type="text/javascript"> FB.init("[facebook_application_id]", "[path_to_xd_receiver]"); </script>
  <?php
  }
}

function fb_comment_plug() {
  if (!is_single() && !is_page()) {
?>
  <p class="fb-comments"><a href="<?php echo get_permalink(); ?>#fb_comments">Add a comment</a></p>
<?
  }
}

