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
            <i class="fa fa-file-alt"></i>
            <span><?php _e( 'Page', 'ikonwp' ); ?></span>
        </li>
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

	<?php if ( has_tag() ): ?>
        <ul class="list-icon list-icon--inline">
			<?php the_tags( '<li><i class="fa fa-tag"></i>', ', ', '</li>' ); ?>
        </ul>
	<?php endif; ?>
</article>

