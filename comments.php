<?php
/**
 * Comments template
 * ikonwp list comments and ikonwp comment form
 */

if ( post_password_required() ) {
	return;
}
?>

    <h3 class="comments-title">
		<?php _e( 'Comments', 'ikonwp' ); ?>
        <span class="comments-number"><?php comments_number( '(0)', '(1)', '(%)' ); ?></span>
    </h3>

<?php if ( have_comments() ) : ?>
    <ul class="comment-list list-unstyled">
		<?php wp_list_comments( 'callback=ikonwp_comment' ); ?>
    </ul>
    <hr/>
    <nav class="pagination comment-pagination">
        <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ikonwp' ); ?></h2>
		<?php paginate_comments_links(); ?>
    </nav>
<?php endif; ?>

<?php comment_form(); ?>