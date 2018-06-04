<?php // Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
        die ('Please do not load this page directly. Thanks!');
    }

    if ( post_password_required() ) {
        return;
    }

    if ('open' == $post->comment_status) :
?>
<section class="c-comment-form-container" id="respond">
    <h1><?php comment_form_title( 'Leave a Comment', 'Reply to %s' ); ?></h1>
    <form class="c-comment-form" id="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
    <?php if ( $user_ID ) : ?>
        <p>You are logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
    <?php else : ?>
        <div class="c-comment-form__item">
            <label class="c-input-label" for="author">Name</label>
            <input class="c-input" type="text" autocorrect="off" autocomplete="name" name="author" id="author" value="<?php echo $comment_author; ?>" <?php if ($req) echo "aria-required='true'"; ?>>
        </div>
        <div class="c-comment-form__item">
        <label class="c-input-label" for="email">Email (will not be published)</label>
            <input class="c-input" type="email" autocapitalize="off" autocorrect="off" autocomplete="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" <?php if ($req) echo "aria-required='true'"; ?>>
        </div>
        <div class="c-comment-form__item">
        <label class="c-input-label" for="url">Website (optional)</label>
            <input class="c-input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>">
        </div>
    <?php endif; ?>
        <div class="c-comment-form__item">
            <label class="c-input-label" for="comment">Comment</label>
            <textarea class="c-textarea" name="comment" id="comment" cols="30" rows="5"></textarea>
        </div>
        <button name="submit" type="submit" id="submit" class="btn">Submit Comment</button>
        <?php cancel_comment_reply_link('Cancel Reply') ?>
        <?php comment_id_fields( $post_id ); ?>
        <?php do_action( 'comment_form', $post_id ); ?>
    </form>
</section>
<?php endif; ?>
<?php if ( have_comments() ) : ?>
    <section class="comments" id="comments">
        <h1 class="comments__title">Comments on this post</h1>
        <?php wp_list_comments(array('walker' => new comment_walker() )); ?>
    </section>
<?php endif; ?>