<div <?php ikonwp_header_navbar_class( array( 'header__navbar' ) ); ?>>
    <div <?php ikonwp_header_navbar_container_class( array(
		'header__navbar_container',
		'd-flex',
		'justify-content-between'
	) ); ?>>

        <nav id="ikonwp-main-navbar" <?php ikonwp_main_navbar_class( array(
			'navbar',
			'navbar-expand-xl'
		) ); ?>>

			<?php if ( has_custom_logo() ) : ?>
                <div class="header__logo navbar-brand">
					<?php the_custom_logo(); ?>
                </div>
			<?php else : ?>
				<?php if ( display_header_text() ) : ?>
                    <div class="header__logo header__text navbar-brand flex-column">
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

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ikonwp-navbar"
                    aria-controls="ikonwp-navbar" aria-expanded="false"
                    aria-label="<?php esc_attr_e( 'Toggle navigation', 'ikonwp' ); ?>">
                <i class="fa fa-bars"></i>
                <i class="d-none fa fa-times"></i>
                <span class="sr-only"><?php _e( 'Menu', 'ikonwp' ); ?></span>
            </button>

            <div id="ikonwp-navbar" class="navbar-collapse collapse">
                <form class="header__mobile_search d-xl-none input-icon"
                      action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                    <input type="text" class="form-control" name="s" value="<?php the_search_query(); ?>"
                           placeholder="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"
                           aria-label="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"/>
                    <button class="btn">
                        <i class="fa fa-search"></i>
                        <span class="sr-only"><?php _e( 'Search', 'ikonwp' ); ?></span>
                    </button>
                </form>

				<?php ikonwp_main_nav_menu(); ?>
            </div>
        </nav>

        <ul class="header__icons">
            <li class="d-none d-xl-block">
                <a href="#" data-toggle="header-search">
                    <i class="fa fa-search"></i>
                    <i class="d-none fa fa-times"></i>
                    <span class="sr-only"><?php _e( 'Search', 'ikonwp' ); ?></span>
                </a>
            </li>
        </ul>
    </div>

    <form id="header-search" class="header__search d-none input-icon"
          action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
        <input type="text" class="form-control" name="s" value="<?php the_search_query(); ?>"
               placeholder="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"
               aria-label="<?php esc_attr_e( 'Find what you seek...', 'ikonwp' ); ?>"/>
        <button class="btn">
            <i class="fa fa-search"></i>
            <span class="sr-only"><?php _e( 'Search', 'ikonwp' ); ?></span>
        </button>
    </form>
</div>