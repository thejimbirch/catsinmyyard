<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<button type="button" class="btn comment-button" data-toggle="collapse" data-target="#comments-<?php the_ID(); ?>">Comments <?php comments_number( '', '[1]', '[%]' ); ?></button>

<!--<button type="button" class="btn comments-count">
	<?php comments_number( '', 'One Comment', '% Comments' ); ?>
</button>-->

<div id="comments-<?php the_ID(); ?>" class="comments-area collapse">

	<?php if ( have_comments() ) : ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfourteen' ); ?></h3>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyfourteen' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyfourteen' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<div class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'div',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
		?>
	</div><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfourteen' ); ?></h3>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyfourteen' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyfourteen' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfourteen' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(array('comment_notes_after' => '')); ?>

</div><!-- #comments -->