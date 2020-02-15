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

                            <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'postbox' ) ); ?>>

								<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                    <figure>
                                        <a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'post-thumbnail', array(
												'class' => 'img-fluid'
											) ); ?>
                                        </a>
                                    </figure>
								<?php endif; ?>

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
                    <aside <?php ikonwp_right_sidebar_col_class( array( 'right-sidebar', 'widget-sidebar' ) ); ?> role="complementary">
						<?php dynamic_sidebar( 'right' ); ?>
                    </aside>
				<?php endif; ?>

            </div>
        </div>
    </main>

<?php get_footer(); ?>