<?php get_header(); ?>

    <main id="content" <?php ikonwp_main_class( array( 'main', 'section' ) ); ?> role="main">
        <div class="container">
            <div class="row">

				<?php if ( is_active_sidebar( 'left' ) ) : ?>
                    <aside <?php ikonwp_left_sidebar_col_class( array( 'left-sidebar', 'widget-sidebar' ) ); ?>
                            role="complementary">
						<?php dynamic_sidebar( 'left' ); ?>
                    </aside>
				<?php endif; ?>

                <section <?php ikonwp_content_col_class(); ?>>

	                <?php if ( ! get_theme_mod( 'ikonwp_header_title_display', true ) ): ?>

                        <div <?php ikonwp_content_title_class( 'content__title' ); ?>>
                            <h1>
				                <?php ikonwp_the_title(); ?>
                            </h1>
                        </div>
	                <?php endif; ?>

					<?php if ( have_posts() ) : ?>

                        <div class="row">

							<?php while ( have_posts() ) : ?>
								<?php the_post(); ?>

								<?php get_template_part( 'template-parts/post/content-grid', get_post_format() ); ?>

							<?php endwhile; ?>
                        </div>

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
                    <aside <?php ikonwp_right_sidebar_col_class( array( 'right-sidebar', 'widget-sidebar' ) ); ?>
                            role="complementary">
						<?php dynamic_sidebar( 'right' ); ?>
                    </aside>
				<?php endif; ?>

            </div>
        </div>
    </main>

<?php get_footer(); ?>