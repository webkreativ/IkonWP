<?php defined( 'ABSPATH' ) or die(); ?>

<nav id="ikonwp-main-navbar" <?php ikonwp_main_navbar_class( array(
	'navbar'
) ); ?>>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ikonwp-main-navbar-mobile"
            aria-controls="ikonwp-main-navbar-mobile" aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Toggle navigation', 'ikonwp' ); ?>">
        <i class="icon-menu-line"></i>
        <i class="icon-close-line d-none"></i>
        <span class="sr-only"><?php _e( 'Menu', 'ikonwp' ); ?></span>
    </button>

    <div id="ikonwp-navbar" class="navbar__desktop">
		<?php ikonwp_main_nav_menu(); ?>
    </div>
</nav>