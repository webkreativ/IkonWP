<div <?php ikonwp_header_navbar_class( array( 'header__navbar' ) ); ?>>
    <div <?php ikonwp_header_navbar_container_class( array(
		'header__navbar_container',
		'd-flex',
		'justify-content-between'
	) ); ?>>

        <div class="header__navbar--left d-none d-lg-flex justify-content-start">
			<?php ikonwp_header_builder_get_elements_html( 'main_left' ); ?>
        </div>
        <div class="header__navbar--center d-none d-lg-flex justify-content-center">
			<?php ikonwp_header_builder_get_elements_html( 'main_center' ); ?>
        </div>
        <div class="header__navbar--right d-none d-lg-flex justify-content-end">
			<?php ikonwp_header_builder_get_elements_html( 'main_right' ); ?>
        </div>

        <div class="header__navbar--left header__navbar_mobile--left d-flex d-lg-none justify-content-start">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'main_left' ); ?>
        </div>
        <div class="header__navbar--center header__navbar_mobile--center d-flex d-lg-none justify-content-center">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'main_center' ); ?>
        </div>
        <div class="header__navbar--right header__navbar_mobile--right d-flex d-lg-none justify-content-end">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'main_right' ); ?>
        </div>
    </div>

    <nav id="ikonwp-main-navbar-mobile" <?php ikonwp_main_navbar_class( array(
		'navbar',
		'navbar__mobile',
		'navbar-collapse',
		'collapse'
	) ); ?>>
		<?php ikonwp_main_nav_menu(); ?>
    </nav>

    <form id="header-search" class="header__search d-none input-icon"
          action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
        <input type="text" class="form-control" name="s" value="<?php the_search_query(); ?>"
               placeholder="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"
               aria-label="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"/>
        <button class="btn">
            <i class="icon-search-line"></i>
            <span class="sr-only"><?php _e( 'Search', 'ikonwp' ); ?></span>
        </button>
    </form>
</div>