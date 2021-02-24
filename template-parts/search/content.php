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
            <i class="icon-calendar-line"></i>
            <a href="<?php the_permalink(); ?>">
                <time datetime="<?php echo get_the_date( 'Y-m-d H:i' ); ?>">
					<?php echo get_the_date(); ?>
                </time>
            </a>
        </li>

        <li>
            <i class="icon-user-line"></i>
			<?php the_author_posts_link(); ?>
        </li>

		<?php if ( has_category() ) : ?>
            <li>
                <i class="icon-folders-line"></i>
				<?php the_category( ', ' ); ?>
            </li>
		<?php endif; ?>

		<?php if ( ! post_password_required() ) : ?>
            <li>
                <i class="icon-discuss-line"></i>
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
            <i class="icon-arrow-right"></i>
        </a>
    </p>

	<?php if ( has_tag() ): ?>
        <ul class="list-icon list-icon--inline">
			<?php the_tags( '<li><i class="icon-tag-line"></i>', ', ', '</li>' ); ?>
        </ul>
	<?php endif; ?>
</article>

