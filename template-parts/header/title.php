<?php if ( get_theme_mod( 'ikonwp_header_title_display', true ) ): ?>

    <div <?php ikonwp_header_title_class( 'header__title' ); ?>>
        <div class="container">

			<?php if ( function_exists( 'lana_breadcrumb' ) ) : ?>
                <div <?php ikonwp_breadcrumb_class( array( 'row' ) ); ?>>
                    <div class="col-12">
						<?php echo lana_breadcrumb(); ?>
                    </div>
                </div>
			<?php endif; ?>

            <h1>
				<?php ikonwp_the_title(); ?>
            </h1>

            <p>
				<?php ikonwp_the_subtitle(); ?>
            </p>
        </div>
    </div>
<?php endif; ?>