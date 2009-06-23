<?php get_header() ?>

	<div id="posts" class="grid_10">
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post_<?php the_ID() ?>">
				<div class="postheader">
					<h2><?php the_title(); ?></h2>
					<p class="byline">
						By <?php the_author() ?>, <?php the_time("l, M d, Y") ?> in <?php the_category(", "); ?>
						| <?php comments_popup_link('no comments', '1 comment', '% comments'); ?>
					</p>
				</div>
				<div class="postbody">
					<?php the_content('continue reading &raquo;') ?>
				</div>
				<div class="postfooter">
					<?php comments_template(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	
<?php get_footer() ?>