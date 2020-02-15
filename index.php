<?php get_header(); ?>

    <header <?php ikonwp_header_class( 'header' ); ?> role="banner">
		<?php get_template_part( 'template-parts/header/navbar' ); ?>
		<?php get_template_part( 'template-parts/header/title' ); ?>
    </header>

    <main id="content" <?php ikonwp_main_class( array( 'main', 'section' ) ); ?> role="main">
        <div class="container">
            <div class="row">

                <section <?php ikonwp_content_col_class(); ?>>

					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

							<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>

						<?php endwhile; ?>

						<?php
						/** get posts links */
						the_posts_pagination( array(
							'type' => 'list'
						) );
						?>

					<?php else : ?>
                        <div class="no-posts">
                            <h3>
								<?php _e( 'No Posts', 'ikonwp' ); ?>
                            </h3>
                            <p>
								<?php _e( 'Sorry, What you were looking for is not here.', 'ikonwp' ); ?>
                            </p>
                        </div>
					<?php endif; ?>

                </section>

				<?php if ( is_active_sidebar( 'right' ) ) : ?>
                    <aside <?php ikonwp_right_sidebar_col_class( array( 'right-sidebar', 'widget-sidebar' ) ); ?> role="complementary">
						<?php dynamic_sidebar( 'right' ); ?>
                    </aside>
				<?php endif; ?>

            </div>
        </div>
    </main>

<?php get_footer(); ?>