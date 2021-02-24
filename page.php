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
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'postbox' ) ); ?>>

                                <div class="post-content">
									<?php the_content(); ?>
                                </div>

                                <div class="clearfix"></div>

								<?php wp_link_pages(); ?>

								<?php if ( comments_open() || get_comments_number() ) : ?>
                                    <div id="comments" class="comments mt--50">
										<?php comments_template(); ?>
                                    </div>
								<?php endif; ?>

                            </article>

						<?php endwhile; ?>

					<?php else : ?>
                        <div class="post no-post">
                            <h3>
								<?php _e( 'Oops!', 'ikonwp' ); ?>
                            </h3>
                            <p>
								<?php _e( 'Sorry, this page does not exist.', 'ikonwp' ); ?>
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