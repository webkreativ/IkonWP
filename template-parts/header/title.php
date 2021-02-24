<?php if ( get_theme_mod( 'ikonwp_header_title_display', true ) ): ?>

    <div <?php ikonwp_header_title_class( 'header__title' ); ?>>
        <div class="container">

			<?php do_action( 'ikonwp_breadcrumb' ); ?>

            <h1>
				<?php ikonwp_the_title(); ?>
            </h1>

            <p>
				<?php ikonwp_the_subtitle(); ?>
            </p>
        </div>
    </div>
<?php endif; ?>