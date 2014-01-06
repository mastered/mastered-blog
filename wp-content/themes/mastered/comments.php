<?php
/* Comments area */
// Do not delete these lines...
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<p>This post is password protected. Enter the password to view comments.</p>
  <?php
    return;
  }
?>
<!-- Editable things below... -->
<?php if ( have_comments() ) : ?>
	<h3>
		<?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;
	</h3>
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=bones_comments'); ?>
	</ol>
	<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->
		<p>No comments yet. Why not leave one?</p>
	<?php else : // comments are closed ?>
		<p>Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<section id="respond">
	<h3>
		<?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?>
	</h3>
	<p><?php cancel_comment_reply_link(); // Inline reply ?></p>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) : ?>
		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out?</a></p>
		<?php else : ?>
		<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
		<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="Your Name" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email">Mail <?php if ($req) echo "(required)"; ?></label>
		<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="Your Email" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<small>(will not be published)</small>
		<label for="url">Website</label>
		<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="Your Website" tabindex="3" />
		<?php endif; ?>
		<textarea name="comment" id="comment" placeholder="Your Comment Here..." tabindex="4"></textarea>
		<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
		<?php comment_id_fields(); ?>
		<div>
		<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>
		</div>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	<?php endif; // If registration required and not logged in ?>
</section>
<?php endif; // Rather important ?>