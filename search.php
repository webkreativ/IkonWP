<?php
global $wp_query;

/** set title */
$ikonwp_the_title    = __( 'Search', 'ikonwp' );
$ikonwp_the_subtitle = sprintf( __( '%1$s results found for: &#8220;%2$s&#8220;', 'ikonwp' ), $wp_query->found_posts, get_search_query() );
?>

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

							<?php get_template_part( 'template-parts/search/content', get_post_type() ); ?>

						<?php endwhile; ?>

						<?php
						/** get posts links */
						the_posts_pagination( array(
							'type' => 'list'
						) );
						?>

					<?php else : ?>
                        <div class="no-posts">
                            <h2>
								<?php _e( 'No Posts!', 'ikonwp' ); ?>
                            </h2>
                            <h4>
								<?php _e( 'Sorry, but nothing matched your search criteria.', 'ikonwp' ); ?>
                            </h4>
                            <p>
								<?php _e( 'Please try again with some different keywords.', 'ikonwp' ); ?>
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