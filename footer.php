<footer class="footer" role="contentinfo">

    <aside class="footer__top" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'ikonwp' ); ?>">
        <div <?php ikonwp_footer_top_container_class( 'container' ); ?>>
            <div <?php ikonwp_footer_top_row_class( 'row' ); ?>>
				<?php if ( is_active_sidebar( 'footer-first' ) ) : ?>
                    <div class="col">
						<?php dynamic_sidebar( 'footer-first' ); ?>
                    </div>
				<?php endif ?>

				<?php if ( is_active_sidebar( 'footer-second' ) ) : ?>
                    <div class="col">
						<?php dynamic_sidebar( 'footer-second' ); ?>
                    </div>
				<?php endif ?>

				<?php if ( is_active_sidebar( 'footer-third' ) ) : ?>
                    <div class="col">
						<?php dynamic_sidebar( 'footer-third' ); ?>
                    </div>
				<?php endif ?>

				<?php if ( is_active_sidebar( 'footer-fourth' ) ) : ?>
                    <div class="col">
						<?php dynamic_sidebar( 'footer-fourth' ); ?>
                    </div>
				<?php endif ?>
            </div>
        </div>
    </aside>

    <div class="footer__bottom">
        <div <?php ikonwp_footer_bottom_container_class( 'container' ); ?>>
            <div class="row">
                <div <?php ikonwp_footer_text_col_class( 'col' ); ?>>
                    <p class="footer__text">
						<?php if ( get_theme_mod( 'ikonwp_footer_text' ) ) : ?>
							<?php echo get_theme_mod( 'ikonwp_footer_text' ); ?>
						<?php endif; ?>

						<?php if ( ! get_theme_mod( 'ikonwp_footer_text' ) ) : ?>
							<?php _e( 'Copyright', 'ikonwp' ); ?>
                            &copy;
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php bloginfo( 'name' ); ?>
                            </a>
							<?php echo date_i18n( __( 'Y', 'ikonwp' ) ); ?>
						<?php endif; ?>
                    </p>
                </div>

				<?php if ( has_nav_menu( 'ikonwp_footer' ) ): ?>
                    <div <?php ikonwp_footer_nav_col_class( 'col' ); ?>>
                        <nav class="footer-navigation"
                             aria-label="<?php esc_attr_e( 'Footer Menu', 'ikonwp' ); ?>">
							<?php ikonwp_footer_nav_menu(); ?>
                        </nav>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>