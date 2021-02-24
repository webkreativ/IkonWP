<?php defined( 'ABSPATH' ) or die(); ?>

<div class="header__responsive_logo my-auto">

	<?php if ( has_custom_logo() ) : ?>
		<?php if ( apply_filters( 'ikonwp_display_logo', true ) ) : ?>

            <div <?php ikonwp_header_logo_class( array( 'header__logo', 'navbar-brand', 'align-items-center' ) ); ?>>
				<?php the_custom_logo(); ?>
            </div>

		<?php endif; ?>
	<?php else : ?>
		<?php if ( display_header_text() ) : ?>
            <div <?php ikonwp_header_text_class( array(
				'header__logo',
				'header__text',
				'navbar-brand',
				'flex-column'
			) ); ?>>
                <h1 class="header__blogname">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <small class="header__blogdescription">
					<?php bloginfo( 'description' ); ?>
                </small>
            </div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( $mobile_custom_logo = get_theme_mod( 'mobile_custom_logo' ) ) : ?>
        <a class="header__logo navbar-brand d-inline-flex d-md-none align-items-center"
           href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php echo wp_get_attachment_image( $mobile_custom_logo, 'full' ); ?>
        </a>
	<?php endif; ?>

</div>
