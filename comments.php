		<?php // Do not delete these lines
			if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
				die ('Please do not load this page directly. Thanks!');
			if ( post_password_required() ) {
				return;
			}
		?>
			<section class="comments" id="comments">
		<?php if ( have_comments() ) : ?>
			<h1 class="comments-title post-title">Comments</h1>
			<?php wp_list_comments(array('walker' => new comment_walker() ));
				// 'style=section&callback=better_comment&end-callback=better_comment_close');
			?>
		<?php endif; ?>
		<?php
    		if ( ! comments_open() ) : // There are comments but comments are now closed
				echo '<p class="comments-closed">Comments are closed.</p>';
    		endif; 
		?>
		<?php if ('open' == $post->comment_status) : ?>
			<div class="comments-respond" id="respond">
				<h2 class="comments-respond-title"><?php comment_form_title( 'Leave a Comment', 'Reply to %s' ); ?> <?php cancel_comment_reply_link('(Cancel reply)') ?></h2>
				<form class="comments-respond-form" id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" role="form">
				<?php if ( $user_ID ) : ?>
					<p class="comments-respond-form-row">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
				<?php else : ?>
					<p class="comments-respond-form-row">
						<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label>
					</p>
					<p class="comments-respond-form-row">
						<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="email"><small>Email (will not be published) <?php if ($req) echo "(required)"; ?></small></label>
					</p>
					<p class="comments-respond-form-row">
						<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
						<label for="url"><small>Website</small></label>
					</p>
				<?php endif; ?>
					<?php if ( function_exists(cs_print_smilies) ) {cs_print_smilies();} ?>
					<p class="comments-respond-form-row">
						<textarea name="comment" id="comment" cols="30" rows="10" tabindex="4"></textarea>
					</p>
					<p class="comments-respond-form-row">
						<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment">
					</p>
					<?php comment_id_fields( $post_id ); ?>
					<?php do_action( 'comment_form', $post_id ); ?>
				</form>
			</div>
		</section>
	<?php endif; ?>