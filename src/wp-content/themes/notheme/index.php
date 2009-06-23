<?php get_header(); ?>

	<div id="posts" class="grid_10">
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post() ?>
				<div id="post_<?php the_ID() ?>" class="post">
					<div class="postheader">
						<h3><a href="<?php permalink_link(); ?>"><?php the_title() ?></a></h3>
						<p class="byline">
							By <?php the_author() ?>, <?php the_time("l, M d, Y") ?> in <?php the_category(", "); ?>
							| <?php comments_popup_link('no comments', '1 comment', '% comments'); ?>
						</p>
					</div>
					<div class="postbody">
						<?php the_content('Continue reading...') ?>
					</div>
					<div class="postfooter">
						<?php edit_post_link('Edit', '', ' | '); ?>
						<?php comments_popup_link('Leave a comment &raquo;', '1 Comment &raquo;', '% Comments &raquo;'); ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>