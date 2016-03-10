<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Please do not load this page directly. Thanks!');
	}

	if ( post_password_required() ) {
		return;
	}

	if ( ! comments_open() ) {
		echo '<p>Comments are closed.</p>';
	}

	if ('open' == $post->comment_status) :

?>
	<section class="comments-respond" id="respond">
		<h1 class="comments-respond__title"><?php comment_form_title( 'Leave a Comment', 'Reply to %s' ); ?></h1>
		<form class="comments-respond__form" id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
		<?php if ( $user_ID ) : ?>
			<p class="comments-respond__form-row">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
		<?php else : ?>
			<label for="author">Name</label>
			<input type="text" autocorrect="off" autocomplete="name" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
			<label for="email">Email (will not be published)</label>
			<input type="email" autocapitalize="off" autocorrect="off" autocomplete="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
			<label for="url">Website (optional)</label>
			<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3">
		<?php endif; ?>
			<label for="comment">Comment</label>
			<textarea class="comments-respond__text" name="comment" id="comment" cols="30" rows="5" tabindex="4"></textarea>
			<button name="submit" type="submit" id="submit" tabindex="5" class="btn">Submit Comment</button>
			<?php cancel_comment_reply_link('Cancel Reply') ?>
			<?php comment_id_fields( $post_id ); ?>
			<?php do_action( 'comment_form', $post_id ); ?>
		</form>
	</section>
	<?php if ( have_comments() ) : ?>
		<section class="comments" id="comments">
			<h1 class="comments__title">Comments on this post</h1>
			<?php wp_list_comments(array('walker' => new comment_walker() )); ?>
		</section>
	<?php endif; ?>
<?php endif; ?>