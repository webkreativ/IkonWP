<?php
/**
 * IkonWP Template
 * The default template for displaying content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'postbox', 'mb--60' ) ); ?>>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
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
        <li>
            <i class="fa fa-calendar-alt"></i>
            <a href="<?php the_permalink(); ?>">
                <time datetime="<?php echo get_the_date( 'Y-m-d H:i' ); ?>">
					<?php echo get_the_date(); ?>
                </time>
            </a>
        </li>

        <li>
            <i class="fa fa-user-circle"></i>
			<?php the_author_posts_link(); ?>
        </li>

		<?php if ( has_category() ) : ?>
            <li>
                <i class="fa fa-folder-open"></i>
				<?php the_category( ', ' ); ?>
            </li>
		<?php endif; ?>

		<?php if ( ! post_password_required() ) : ?>
            <li>
                <i class="fa fa-comment"></i>
				<?php comments_popup_link( esc_html__( 'No Comments', 'ikonwp' ), esc_html__( '1 Comment', 'ikonwp' ), esc_html__( '% Comments', 'ikonwp' ) ); ?>
            </li>
		<?php endif; ?>
    </ul>

	<?php the_excerpt(); ?>

	<?php wp_link_pages(); ?>

    <p>
        <a href="<?php the_permalink(); ?>" class="btn btn--text more-link">
			<?php _e( 'Read more', 'ikonwp' ); ?>
            <span class="screen-reader-text"><?php the_title(); ?></span>
            <i class="fa fa-angle-right"></i>
        </a>
    </p>

    <ul class="list-icon list-icon--inline">
		<?php the_tags( '<li><i class="fa fa-tag"></i>', ', ', '</li>' ); ?>

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
		), '<li><i class="fa fa-pencil-alt"></i>', '</li>' ); ?>
    </ul>
</article>

