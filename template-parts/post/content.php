<?php
/**
 * IkonWP Template
 * The default template for displaying content
 */

$ikonwp_post_content_display = apply_filters( 'ikonwp_post_content_display', array(
	'post_date',
	'post_comment',
	'post_author',
	'post_categories',
	'post_tags',
	'featured_image'
) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'postbox', 'mb--60' ) ); ?>>

	<?php if ( in_array( 'featured_image', $ikonwp_post_content_display ) && has_post_thumbnail() && ! post_password_required() ) : ?>
        <figure>
            <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array(
					'class' => 'img-fluid'
				) ); ?>
            </a>
        </figure>
	<?php endif; ?>

    <h3 class="postbox__title">
        <a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
        </a>
    </h3>

    <ul class="list-icon list-icon--inline mb-4">
		<?php if ( in_array( 'post_date', $ikonwp_post_content_display ) ) : ?>
            <li>
                <i class="icon-calendar-line"></i>
                <a href="<?php the_permalink(); ?>">
                    <time datetime="<?php echo get_the_date( 'Y-m-d H:i' ); ?>">
						<?php echo get_the_date(); ?>
                    </time>
                </a>
            </li>
		<?php endif; ?>

		<?php if ( in_array( 'post_author', $ikonwp_post_content_display ) ) : ?>
            <li>
                <i class="icon-user-line"></i>
				<?php the_author_posts_link(); ?>
            </li>
		<?php endif; ?>

		<?php if ( in_array( 'post_categories', $ikonwp_post_content_display ) && has_category() ) : ?>
            <li>
                <i class="icon-folders-line"></i>
				<?php the_category( ', ' ); ?>
            </li>
		<?php endif; ?>

		<?php if ( in_array( 'post_comment', $ikonwp_post_content_display ) ) : ?>
			<?php if ( ! post_password_required() ) : ?>
                <li>
                    <i class="icon-discuss-line"></i>
					<?php comments_popup_link( esc_html__( 'No Comments', 'ikonwp' ), esc_html__( '1 Comment', 'ikonwp' ), esc_html__( '% Comments', 'ikonwp' ) ); ?>
                </li>
			<?php endif; ?>
		<?php endif; ?>
    </ul>

	<?php ikonwp_post_content(); ?>

	<?php wp_link_pages(); ?>

	<?php if ( 'excerpt' == apply_filters( 'ikonwp_post_content', 'excerpt' ) ): ?>
        <p>
            <a href="<?php the_permalink(); ?>" class="btn btn--text more-link">
				<?php _e( 'Read more', 'ikonwp' ); ?>
                <span class="screen-reader-text"><?php the_title(); ?></span>
                <i class="icon-arrow-right"></i>
            </a>
        </p>
	<?php endif; ?>

    <ul class="list-icon list-icon--inline">
		<?php
		if ( in_array( 'post_tags', $ikonwp_post_content_display ) ) {
			the_tags( '<li><i class="icon-tag-line"></i>', ', ', '</li>' );
		}
		?>

		<?php edit_post_link( sprintf(
			wp_kses(
			/* translators: %s: Post title. Only visible to screen readers. */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'ikonwp' ),
				array(
					'span' => array(
						'class' => array()
					)
				)
			),
			get_the_title()
		), '<li><i class="icon-pencil"></i>', '</li>' ); ?>
    </ul>
</article>

