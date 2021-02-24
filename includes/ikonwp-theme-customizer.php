<?php
defined( 'ABSPATH' ) or die();

/**
 * Class IkonWP_Customize
 */
class IkonWP_Customize {

	/**
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function register( $wp_customize ) {

		/** inlcude customize control files */
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-alpha-color-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-checkbox-multiple-control.php';

		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-blank-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-builder-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-dimension-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-dimensions-control.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-slider-control.php';

		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-pro-link-section.php';
		require_once get_template_directory() . '/includes/customize-controls/class-ikonwp-customize-spacer-section.php';

		/** register section types */
		$wp_customize->register_section_type( 'IkonWP_Customize_Pro_Link_Section' );
		$wp_customize->register_section_type( 'IkonWP_Customize_Spacer_Section' );

		/** register control types */
		$wp_customize->register_control_type( 'IkonWP_Customize_Builder_Control' );
		$wp_customize->register_control_type( 'IkonWP_Customize_Dimension_Control' );
		$wp_customize->register_control_type( 'IkonWP_Customize_Dimensions_Control' );
		$wp_customize->register_control_type( 'IkonWP_Customize_Slider_Control' );

		/**
		 * IkonPro
		 */
		if ( ! apply_filters( 'ikonwp_is_pro', false ) ) {

			$wp_customize->add_section( new IkonWP_Customize_Pro_Link_Section( $wp_customize, 'ikonwp_pro_link_section', array(
				'title'    => esc_html_x( 'More Options Available in IkonPro', 'IkonPro upsell', 'ikonwp' ),
				'url'      => esc_url( add_query_arg( array(
					'utm_source'   => 'ikonwp-customizer',
					'utm_medium'   => 'learn-more',
					'utm_campaign' => 'theme-upsell'
				), IKONPRO_URL ) ),
				'priority' => 0
			) ) );

			$wp_customize->add_section( new IkonWP_Customize_Spacer_Section( $wp_customize, 'ikonwp_spacer_pro_link_section', array(
				'priority' => 0
			) ) );
		}

		/**
		 * Site Identity
		 * -- Mobile Logo (image)
		 *
		 * Display
		 * -- Layout (select: Full Width, Boxed)
		 *
		 * Header
		 * -- Default
		 * ---- Background Type (select: Theme Color, Custom Background Image, Custom Background Color)
		 * ---- Background Image (image)
		 * ---- Background Color (alphacolor)
		 * ---- Text Color (color)
		 * -- Top
		 * ---- Layout (select: Full Width, Content Width)
		 * -- Navbar
		 * ---- Layout (select: Full Width, Content Width)
		 * ---- Background Type (select: Transparent, Custom Background Color)
		 * ---- Background Color (alphacolor)
		 * ---- Text Color (color)
		 * -- Title
		 * ---- Display (select: Enabled, Disabled)
		 * ---- Text Color (color)
		 * ---- Text Align (select: Left, Center, Right)
		 *
		 * Colors
		 * -- Theme Color (select: Default, Blue, Orange, Green, Magenta, Custom)
		 * -- Custom Color (color, condition: theme color)
		 * -- Primary Color (color)
		 * -- Secondary Color (color)
		 *
		 * Typography
		 * -- Body
		 * ---- Font Family (select)
		 * ---- Font Subset (select)
		 * ---- Line Height (input: number)
		 * -- Header
		 * ---- Font Family (select)
		 * ---- Font Subset (select)
		 * ---- Line Height (input: number)
		 * ---- Text Transform (select)
		 *
		 * Blog
		 * -- Layout (select: Default, Grid)
		 * -- Grid Columns (select: 2)
		 *
		 * Sidebars
		 * -- Default
		 * ---- Left Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Left Sidebar - Singular - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 * -- Post
		 * ---- Left Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Left Sidebar - Singular - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 * -- Page
		 * ---- Left Sidebar - Singular - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 *
		 * Footer
		 * -- Footer Text
		 */

		/**
		 * Site Identity
		 */
		$wp_customize->get_setting( 'custom_logo' )->transport     = 'refresh';
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		$custom_logo_args = get_theme_support( 'custom-logo' );

		/** site identity - mobile custom logo */
		$wp_customize->add_setting( 'mobile_custom_logo', array(
			'sanitize_callback' => 'absint',
			'theme_supports'    => array( 'custom-logo' )
		) );

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'mobile_custom_logo', array(
			'label'         => esc_html__( 'Mobile Logo', 'ikonwp' ),
			'section'       => 'title_tagline',
			'priority'      => 8,
			'height'        => $custom_logo_args[0]['height'],
			'width'         => $custom_logo_args[0]['width'],
			'flex_height'   => $custom_logo_args[0]['flex-height'],
			'flex_width'    => $custom_logo_args[0]['flex-width'],
			'button_labels' => array(
				'select'       => esc_html__( 'Select logo', 'ikonwp' ),
				'change'       => esc_html__( 'Change logo', 'ikonwp' ),
				'placeholder'  => esc_html__( 'No logo selected', 'ikonwp' ),
				'frame_title'  => esc_html__( 'Select logo', 'ikonwp' ),
				'frame_button' => esc_html__( 'Choose logo', 'ikonwp' )
			)
		) ) );

		$wp_customize->selective_refresh->add_partial( 'mobile_custom_logo', array(
			'settings'            => array( 'mobile_custom_logo' ),
			'selector'            => '.mobile-custom-logo-link',
			'render_callback'     => array( $wp_customize, '_render_custom_logo_partial' ),
			'container_inclusive' => true
		) );

		/**
		 * Display
		 * options
		 */
		$wp_customize->add_section( 'ikonwp_display', array(
			'title'      => esc_html__( 'Display', 'ikonwp' ),
			'priority'   => 35,
			'capability' => 'edit_theme_options'
		) );

		/** theme - layout */
		$wp_customize->add_setting( 'ikonwp_display_layout', array(
			'default'           => 'full_width',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_display_layout', array(
			'label'       => esc_html__( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_display',
			'type'        => 'select',
			'choices'     => array(
				'full_width' => esc_html__( 'Full Width', 'ikonwp' ),
				'boxed'      => esc_html__( 'Boxed', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the body display layout', 'ikonwp' )
		) );

		/**
		 * Header
		 * options
		 */
		$wp_customize->add_panel( 'ikonwp_header', array(
			'title'    => esc_html__( 'Header', 'ikonwp' ),
			'priority' => 45
		) );

		/**  header - builder */
		$wp_customize->add_section( 'ikonwp_header_builder', array(
			'title'      => esc_html__( 'Builder', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'priority'   => 0,
			'capability' => 'edit_theme_options'
		) );

		/**
		 * IkonWP Header Builder
		 * switcher html
		 */
		ob_start(); ?>
        <div class="ikonwp-responsive-switcher nav-tab-wrapper wp-clearfix">
            <a href="#" class="nav-tab preview-desktop ikonwp-responsive-switcher-button" data-device="desktop">
                <span class="dashicons dashicons-desktop"></span>
                <span><?php esc_html_e( 'Desktop', 'ikonwp' ); ?></span>
            </a>
            <a href="#" class="nav-tab preview-tablet preview-mobile ikonwp-responsive-switcher-button"
               data-device="tablet">
                <span class="dashicons dashicons-smartphone"></span>
                <span><?php esc_html_e( 'Tablet / Mobile', 'ikonwp' ); ?></span>
            </a>
        </div>
        <span class="button button-secondary ikonwp-builder-hide ikonwp-builder-toggle">
            <span class="dashicons dashicons-no"></span>
            <?php esc_html_e( 'Hide', 'ikonwp' ); ?>
        </span>
        <span class="button button-primary ikonwp-builder-show ikonwp-builder-toggle">
            <span class="dashicons dashicons-edit"></span>
            <?php esc_html_e( 'Header Builder', 'ikonwp' ); ?>
        </span>
		<?php
		$ikonwp_header_builder_switcher = ob_get_clean();

		$wp_customize->add_control( new IkonWP_Customize_Blank_Control( $wp_customize, 'ikonwp_header_builder_actions', array(
			'section'     => 'ikonwp_header_builder',
			'settings'    => array(),
			'description' => $ikonwp_header_builder_switcher,
			'priority'    => 10
		) ) );

		$ikonwp_header_builder_settings = array(
			'top_left'    => 'ikonwp_header_builder_elements_top_left',
			'top_center'  => 'ikonwp_header_builder_elements_top_center',
			'top_right'   => 'ikonwp_header_builder_elements_top_right',
			'main_left'   => 'ikonwp_header_builder_elements_main_left',
			'main_center' => 'ikonwp_header_builder_elements_main_center',
			'main_right'  => 'ikonwp_header_builder_elements_main_right'
		);

		$ikonwp_header_builder_defaults = array(
			'ikonwp_header_builder_elements_top_left'    => array(),
			'ikonwp_header_builder_elements_top_center'  => array(),
			'ikonwp_header_builder_elements_top_right'   => array(),
			'ikonwp_header_builder_elements_main_left'   => array( 'logo' ),
			'ikonwp_header_builder_elements_main_center' => array( 'menu-1' ),
			'ikonwp_header_builder_elements_main_right'  => array( 'search-dropdown' )
		);

		foreach ( $ikonwp_header_builder_settings as $setting ) {
			$wp_customize->add_setting( $setting, array(
				'default'           => ikonwp_array_value( $ikonwp_header_builder_defaults, $setting ),
				'sanitize_callback' => 'ikonwp_sanitize_builder'
			) );
		}

		$wp_customize->add_control( new IkonWP_Customize_Builder_Control( $wp_customize, 'ikonwp_header_builder_elements', array(
			'settings' => $ikonwp_header_builder_settings,
			'section'  => 'ikonwp_header_builder',
			'label'    => esc_html__( 'Desktop Header', 'ikonwp' ),
			'choices'  => array(
				'logo'            => '<span class="dashicons dashicons-admin-home"></span>' . esc_html__( 'Logo', 'ikonwp' ),
				'menu-1'          => '<span class="dashicons dashicons-admin-links"></span>' . sprintf( esc_html__( 'Menu %s', 'ikonwp' ), 1 ),
				'search-dropdown' => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Dropdown', 'ikonwp' )
			),
			'labels'   => array(
				'top_left'    => esc_html__( 'Top - Left', 'ikonwp' ),
				'top_center'  => esc_html__( 'Top - Center', 'ikonwp' ),
				'top_right'   => esc_html__( 'Top - Right', 'ikonwp' ),
				'main_left'   => esc_html__( 'Main - Left', 'ikonwp' ),
				'main_center' => esc_html__( 'Main - Center', 'ikonwp' ),
				'main_right'  => esc_html__( 'Main - Right', 'ikonwp' )
			),
			'priority' => 10
		) ) );

		$ikonwp_header_builder_mobile_settings = array(
			'top_left'    => 'ikonwp_header_builder_mobile_elements_top_left',
			'top_center'  => 'ikonwp_header_builder_mobile_elements_top_center',
			'top_right'   => 'ikonwp_header_builder_mobile_elements_top_right',
			'main_left'   => 'ikonwp_header_builder_mobile_elements_main_left',
			'main_center' => 'ikonwp_header_builder_mobile_elements_main_center',
			'main_right'  => 'ikonwp_header_builder_mobile_elements_main_right'
		);

		$ikonwp_header_builder_mobile_defaults = array(
			'ikonwp_header_builder_mobile_elements_top_left'    => array(),
			'ikonwp_header_builder_mobile_elements_top_center'  => array(),
			'ikonwp_header_builder_mobile_elements_top_right'   => array(),
			'ikonwp_header_builder_mobile_elements_main_left'   => array( 'logo' ),
			'ikonwp_header_builder_mobile_elements_main_center' => array( 'menu-1' ),
			'ikonwp_header_builder_mobile_elements_main_right'  => array( 'search-dropdown' )
		);

		foreach ( $ikonwp_header_builder_mobile_settings as $setting ) {
			$wp_customize->add_setting( $setting, array(
				'default'           => ikonwp_array_value( $ikonwp_header_builder_mobile_defaults, $setting ),
				'sanitize_callback' => 'ikonwp_sanitize_builder'
			) );
		}

		$wp_customize->add_control( new IkonWP_Customize_Builder_Control( $wp_customize, 'ikonwp_header_builder_mobile_elements', array(
			'settings' => $ikonwp_header_builder_mobile_settings,
			'section'  => 'ikonwp_header_builder',
			'label'    => esc_html__( 'Mobile Header', 'ikonwp' ),
			'choices'  => array(
				'logo'            => '<span class="dashicons dashicons-admin-home"></span>' . esc_html__( 'Logo', 'ikonwp' ),
				'menu-1'          => '<span class="dashicons dashicons-admin-links"></span>' . sprintf( esc_html__( 'Menu %s', 'ikonwp' ), 1 ),
				'search-dropdown' => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Dropdown', 'ikonwp' )
			),
			'labels'   => array(
				'top_left'    => esc_html__( 'Top - Left', 'ikonwp' ),
				'top_center'  => esc_html__( 'Top - Center', 'ikonwp' ),
				'top_right'   => esc_html__( 'Top - Right', 'ikonwp' ),
				'main_left'   => esc_html__( 'Main - Left', 'ikonwp' ),
				'main_center' => esc_html__( 'Main - Center', 'ikonwp' ),
				'main_right'  => esc_html__( 'Main - Right', 'ikonwp' )
			),
			'priority' => 10
		) ) );

		/**  header - default */
		$wp_customize->add_section( 'ikonwp_header_default', array(
			'title'      => esc_html__( 'Default', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'priority'   => 1,
			'capability' => 'edit_theme_options'
		) );

		/** header - default - background type */
		$wp_customize->add_setting( 'ikonwp_header_default_background_type', array(
			'default'           => 'theme_color',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_default_background_type', array(
			'label'       => esc_html__( 'Background Type', 'ikonwp' ),
			'section'     => 'ikonwp_header_default',
			'priority'    => 1,
			'type'        => 'select',
			'choices'     => array(
				'theme_color'  => esc_html__( 'Theme Color', 'ikonwp' ),
				'custom_image' => esc_html__( 'Custom Background Image', 'ikonwp' ),
				'custom_color' => esc_html__( 'Custom Background Color', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the header background type option', 'ikonwp' )
		) );

		/** header - default - background color */
		$wp_customize->add_setting( 'ikonwp_header_default_background_color', array(
			'sanitize_callback' => 'ikonwp_sanitize_rgba_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Alpha_Color_Control( $wp_customize, 'ikonwp_header_default_background_color', array(
			'label'       => esc_html__( 'Background Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_default',
			'description' => esc_html__( 'Select the header background color', 'ikonwp' ),
			'priority'    => 12
		) ) );

		/** header - default - background image */
		$wp_customize->get_control( 'header_image' )->label    = esc_html__( 'Background Image', 'ikonwp' );
		$wp_customize->get_control( 'header_image' )->section  = 'ikonwp_header_default';
		$wp_customize->get_control( 'header_image' )->priority = 3;

		/** header - default - text color */
		$wp_customize->get_control( 'header_textcolor' )->label    = esc_html__( 'Text Color', 'ikonwp' );
		$wp_customize->get_control( 'header_textcolor' )->section  = 'ikonwp_header_default';
		$wp_customize->get_control( 'header_textcolor' )->priority = 20;

		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		/**  header - top */
		$wp_customize->add_section( 'ikonwp_header_top', array(
			'title'      => esc_html__( 'Top', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'priority'   => 1,
			'capability' => 'edit_theme_options'
		) );

		/** header - top - layout */
		$wp_customize->add_setting( 'ikonwp_header_top_layout', array(
			'default'           => 'full_width',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_top_layout', array(
			'label'       => esc_html__( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_header_top',
			'type'        => 'select',
			'choices'     => array(
				'full_width'    => esc_html__( 'Full Width', 'ikonwp' ),
				'content_width' => esc_html__( 'Content Width', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the top layout', 'ikonwp' )
		) );

		/**  header - navbar */
		$wp_customize->add_section( 'ikonwp_header_navbar', array(
			'title'      => esc_html__( 'Navbar', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'priority'   => 2,
			'capability' => 'edit_theme_options'
		) );

		/** header - navbar - layout */
		$wp_customize->add_setting( 'ikonwp_header_navbar_layout', array(
			'default'           => 'full_width',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_navbar_layout', array(
			'label'       => esc_html__( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'type'        => 'select',
			'choices'     => array(
				'full_width'    => esc_html__( 'Full Width', 'ikonwp' ),
				'content_width' => esc_html__( 'Content Width', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the navbar layout', 'ikonwp' )
		) );

		/** header - navbar - background type */
		$wp_customize->add_setting( 'ikonwp_header_navbar_background_type', array(
			'default'           => 'theme_color',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_navbar_background_type', array(
			'label'       => esc_html__( 'Background Type', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'type'        => 'select',
			'choices'     => array(
				'theme_color'  => esc_html__( 'Theme Color', 'ikonwp' ),
				'transparent'  => esc_html__( 'Transparent', 'ikonwp' ),
				'custom_color' => esc_html__( 'Custom Background Color', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the navbar background type option', 'ikonwp' )
		) );

		/** header - navbar - background color */
		$wp_customize->add_setting( 'ikonwp_header_navbar_background_color', array(
			'sanitize_callback' => 'ikonwp_sanitize_rgba_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Alpha_Color_Control( $wp_customize, 'ikonwp_header_navbar_background_color', array(
			'label'       => esc_html__( 'Background Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'description' => esc_html__( 'Select the navbar background color', 'ikonwp' )
		) ) );

		/** header - navbar - text color */
		$wp_customize->add_setting( 'ikonwp_header_navbar_text_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_header_navbar_text_color', array(
			'label'       => esc_html__( 'Text Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'description' => esc_html__( 'Select the navbar text color', 'ikonwp' )
		) ) );

		/**  header - title */
		$wp_customize->add_section( 'ikonwp_header_title', array(
			'title'      => esc_html__( 'Title', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'priority'   => 3,
			'capability' => 'edit_theme_options'
		) );

		/** header - title - display */
		$wp_customize->add_setting( 'ikonwp_header_title_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_title_display', array(
			'label'       => esc_html__( 'Display', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'priority'    => 1,
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the header title display option', 'ikonwp' )
		) );

		/** header - title - text color */
		$wp_customize->add_setting( 'ikonwp_header_title_text_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_header_title_text_color', array(
			'label'       => esc_html__( 'Text Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'description' => esc_html__( 'Select the title text color', 'ikonwp' )
		) ) );

		/** header - title - text align */
		$wp_customize->add_setting( 'ikonwp_header_title_text_align', array(
			'default'           => 'center',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_title_text_align', array(
			'label'       => esc_html__( 'Text Align', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'type'        => 'select',
			'choices'     => array(
				'left'   => esc_html__( 'Left', 'ikonwp' ),
				'center' => esc_html__( 'Center', 'ikonwp' ),
				'right'  => esc_html__( 'Right', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the header title text align option', 'ikonwp' )
		) );

		/**  header - elements: menu(s) */
		$wp_customize->add_section( 'ikonwp_header_elements_menu', array(
			'title'      => esc_html__( 'Elements: Menu(s)', 'ikonwp' ),
			'panel'      => 'ikonwp_header',
			'capability' => 'edit_theme_options'
		) );

		/** header - elements: (menu) - menu 1 - breakpoint */
		$wp_customize->add_setting( 'ikonwp_header_elements_menu_1_breakpoint', array(
			'default'           => 'lg',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_elements_menu_1_breakpoint', array(
			'label'       => esc_html__( 'Menu 1 - Breakpoint', 'ikonwp' ),
			'section'     => 'ikonwp_header_elements_menu',
			'type'        => 'select',
			'choices'     => array(
				'sm' => esc_html__( 'Small (576px)', 'ikonwp' ),
				'md' => esc_html__( 'Medium (768px)', 'ikonwp' ),
				'lg' => esc_html__( 'Large (992px)', 'ikonwp' ),
				'xl' => esc_html__( 'Extra large (1200px)', 'ikonwp' )
			),
			'description' => esc_html__( 'Breakpoint, the menu below this value changes to mobile view', 'ikonwp' )
		) );

		/**
		 * Colors
		 * options
		 */

		/** colors - theme color */
		$wp_customize->add_setting( 'ikonwp_colors_theme_color', array(
			'default'           => 'orange',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_colors_theme_color', array(
			'label'       => esc_html__( 'Theme Color', 'ikonwp' ),
			'section'     => 'colors',
			'type'        => 'select',
			'choices'     => array(
				''        => esc_html__( 'Grey', 'ikonwp' ),
				'blue'    => esc_html__( 'Blue', 'ikonwp' ),
				'orange'  => esc_html__( 'Orange', 'ikonwp' ),
				'green'   => esc_html__( 'Green', 'ikonwp' ),
				'magenta' => esc_html__( 'Magenta', 'ikonwp' ),
				'custom'  => esc_html__( 'Custom', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the theme colors style', 'ikonwp' )
		) );

		/** colors - primary color */
		$wp_customize->add_setting( 'ikonwp_colors_primary_color', array(
			'default'           => '#555555',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color', array(
			'label'       => esc_html__( 'Primary Color', 'ikonwp' ),
			'section'     => 'colors',
			'description' => esc_html__( 'Select the primary color, and the first gradient color', 'ikonwp' )
		) ) );

		/** colors - primary color - hover */
		$wp_customize->add_setting( 'ikonwp_colors_primary_color_hover', array(
			'default'           => '#6F6F6F',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color_hover', array(
			'label'       => esc_html__( 'Primary Color - Hover Color', 'ikonwp' ),
			'section'     => 'colors',
			'description' => esc_html__( 'Select the primary hover color', 'ikonwp' )
		) ) );

		/** colors - primary color - gradient */
		$wp_customize->add_setting( 'ikonwp_colors_primary_color_gradient', array(
			'default'           => '#555555',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color_gradient', array(
			'label'       => esc_html__( 'Primary Color - Second Gradient Color', 'ikonwp' ),
			'section'     => 'colors',
			'description' => esc_html__( 'Select the second color for the gradient', 'ikonwp' )
		) ) );

		/**
		 * Typography
		 * options
		 */
		$google_fonts         = ikonwp_get_google_fonts();
		$google_fonts_subsets = ikonwp_get_google_fonts_subsets();

		$wp_customize->add_panel( 'ikonwp_typography', array(
			'title'    => esc_html__( 'Typography', 'ikonwp' ),
			'priority' => 45
		) );

		/** typography - body */
		$wp_customize->add_section( 'ikonwp_typography_body', array(
			'title'      => esc_html__( 'Body', 'ikonwp' ),
			'panel'      => 'ikonwp_typography',
			'priority'   => 1,
			'capability' => 'edit_theme_options'
		) );

		/** typography - body - font family */
		$wp_customize->add_setting( 'ikonwp_typography_body_font_family', array(
			'sanitize_callback' => 'ikonwp_sanitize_google_fonts',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_body_font_family', array(
			'label'       => esc_html__( 'Font Family', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'type'        => 'select',
			'choices'     => array_merge( array(
				'' => esc_html__( 'None - Theme Default', 'ikonwp' )
			), $google_fonts ),
			'description' => esc_html__( 'Select the body font family', 'ikonwp' )
		) );

		/** typography - body - font subsets */
		$wp_customize->add_setting( 'ikonwp_typography_body_font_subsets', array(
			'sanitize_callback' => 'ikonwp_sanitize_checkbox_multiple',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Checkbox_Multiple_Control( $wp_customize, 'ikonwp_typography_body_font_subsets', array(
			'label'       => esc_html__( 'Font Subsets', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'choices'     => $google_fonts_subsets,
			'description' => esc_html__( 'Select the body font subsets (Note: \'Latin\' always chosen by default)', 'ikonwp' )
		) ) );

		/** typography - body - line height */
		$wp_customize->add_setting( 'ikonwp_typography_body_line_height', array(
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_body_line_height', array(
			'label'       => esc_html__( 'Line Height', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 0.1
			)
		) );

		/** typography - header */
		$wp_customize->add_section( 'ikonwp_typography_header', array(
			'title'      => esc_html__( 'Header', 'ikonwp' ),
			'panel'      => 'ikonwp_typography',
			'priority'   => 2,
			'capability' => 'edit_theme_options'
		) );

		/** typography - header - font family */
		$wp_customize->add_setting( 'ikonwp_typography_header_font_family', array(
			'sanitize_callback' => 'ikonwp_sanitize_google_fonts',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_header_font_family', array(
			'label'       => esc_html__( 'Font Family', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'type'        => 'select',
			'choices'     => array_merge( array(
				'' => esc_html__( 'None - Theme Default', 'ikonwp' )
			), $google_fonts ),
			'description' => esc_html__( 'Select the header font family', 'ikonwp' )
		) );

		/** typography - header - font subsets */
		$wp_customize->add_setting( 'ikonwp_typography_header_font_subsets', array(
			'sanitize_callback' => 'ikonwp_sanitize_checkbox_multiple',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Checkbox_Multiple_Control( $wp_customize, 'ikonwp_typography_header_font_subsets', array(
			'label'       => esc_html__( 'Font Subsets', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'choices'     => $google_fonts_subsets,
			'description' => esc_html__( 'Select the header font subsets (Note: \'Latin\' always chosen by default)', 'ikonwp' )
		) ) );

		/** typography - header - line height */
		$wp_customize->add_setting( 'ikonwp_typography_header_line_height', array(
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_header_line_height', array(
			'label'       => esc_html__( 'Line Height', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 0.1
			)
		) );

		/**
		 * Blog
		 * options
		 */
		$wp_customize->add_section( 'ikonwp_blog', array(
			'title'      => esc_html__( 'Blog', 'ikonwp' ),
			'priority'   => 105,
			'capability' => 'edit_theme_options'
		) );

		/** blog - layout */
		$wp_customize->add_setting( 'ikonwp_blog_layout', array(
			'default'           => '',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_blog_layout', array(
			'label'       => esc_html__( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_blog',
			'type'        => 'select',
			'choices'     => array(
				''     => esc_html__( 'Default (List)', 'ikonwp' ),
				'grid' => esc_html__( 'Grid', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the blog layout', 'ikonwp' )
		) );

		/** blog - grid columns */
		$wp_customize->add_setting( 'ikonwp_blog_grid_columns', array(
			'default'           => '2',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_blog_grid_columns', array(
			'label'       => esc_html__( 'Grid Columns', 'ikonwp' ),
			'section'     => 'ikonwp_blog',
			'type'        => 'select',
			'choices'     => array(
				'2' => esc_html__( '2 columns', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the blog grid columns', 'ikonwp' )
		) );

		/**
		 * Sidebars
		 * options
		 */
		$wp_customize->add_panel( 'ikonwp_sidebars', array(
			'title'    => esc_html__( 'Sidebars', 'ikonwp' ),
			'priority' => 109
		) );

		/** sidebars - default */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_default', array(
			'title'      => esc_html__( 'Default', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 1,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - default - left sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_left_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_left_sidebar_archive_display', array(
			'label'       => esc_html__( 'Left Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the left sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - default - right sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display', array(
			'label'       => esc_html__( 'Right Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the right sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - default - left sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_left_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_left_sidebar_singular_display', array(
			'label'       => esc_html__( 'Left Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the left sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - default - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display', array(
			'label'       => esc_html__( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - post */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_post', array(
			'title'      => esc_html__( 'Post', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 2,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - post - left sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_left_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_left_sidebar_archive_display', array(
			'label'       => esc_html__( 'Left Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the left sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - post - right sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display', array(
			'label'       => esc_html__( 'Right Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the right sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - post - left sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_left_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_left_sidebar_singular_display', array(
			'label'       => esc_html__( 'Left Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the left sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - post - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display', array(
			'label'       => esc_html__( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - page */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_page', array(
			'title'      => esc_html__( 'Page', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 3,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - page - left sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_page_left_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_page_left_sidebar_singular_display', array(
			'label'       => esc_html__( 'Left Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_page',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the left sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - page - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display', array(
			'label'       => esc_html__( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_page',
			'type'        => 'select',
			'choices'     => array(
				'0' => esc_html__( 'Disabled', 'ikonwp' ),
				'1' => esc_html__( 'Enabled', 'ikonwp' )
			),
			'description' => esc_html__( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/**
		 * Footer
		 * options
		 */
		$wp_customize->add_section( 'ikonwp_footer', array(
			'title'      => esc_html__( 'Footer', 'ikonwp' ),
			'priority'   => 110,
			'capability' => 'edit_theme_options'
		) );

		/** footer - text */
		$wp_customize->add_setting( 'ikonwp_footer_text', array(
			'sanitize_callback' => 'wp_kses_post',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( 'ikonwp_footer_text', array(
			'label'   => esc_html__( 'Footer Text', 'ikonwp' ),
			'section' => 'ikonwp_footer',
			'type'    => 'text'
		) );
	}

	/**
	 * Inline style
	 * custom WordPress settings
	 * Used by hook: 'wp_enqueue_scripts'
	 * @see add_action('wp_enqueue_scripts',$func)
	 */
	public static function custom_inline_style() {

		/** colors */
		if ( 'custom' == get_theme_mod( 'ikonwp_colors_theme_color' ) ) {

			$primary_color          = get_theme_mod( 'ikonwp_colors_primary_color', '#555555' );
			$primary_color_hover    = get_theme_mod( 'ikonwp_colors_primary_color_hover', '#6F6F6F' );
			$primary_color_gradient = get_theme_mod( 'ikonwp_colors_primary_color_gradient', '#555555' );

			/** default primary color */
			if ( empty( $primary_color ) ) {
				$primary_color = '#555555';
			}

			/** default primary hover color */
			if ( empty( $primary_color_hover ) ) {
				$primary_color_hover = $primary_color;
			}

			/** default primary gradient color */
			if ( empty( $primary_color_gradient ) ) {
				$primary_color_gradient = $primary_color;
			}

			$custom_color_css = '
				h1,h2,h3,h4,h5,h6,
				.postbox__title a {
				  color: ' . $primary_color . ';
				}
				
				.postbox__title a,
				.btn--text {
				  color: ' . $primary_color . ';
				}
				
				.postbox__title a:hover,
				.btn--text:hover {
				  color: ' . $primary_color_hover . ';
				}
				
				.comment-list .comment .comment-title a {
				  color: ' . $primary_color . ' !important;
				}
				
				.comment-list .comment .comment-title a:hover, .comment-list .comment .comment-title a:focus {
				  color: ' . $primary_color_hover . ' !important;
				}
				
				.header__navbar a.header__logo:hover, .header__navbar a.header__logo:focus {
				  color: ' . $primary_color_hover . ';
				}
				
				.header__navbar .header__logo a:hover, .header__navbar .header__logo a:focus {
				  color: ' . $primary_color_hover . ';
				}
				
				.header__navbar .navbar-nav .nav-link:hover, .header__navbar .navbar-nav .nav-link:focus {
				  color: ' . $primary_color_hover . ';
				}
				
				.header__navbar .header__icons a:hover, .header__navbar .header__icons a:focus {
				  color: ' . $primary_color_hover . ';
				}
				
				.btn-primary, .btn-primary:focus {
				  border-color: ' . $primary_color . ';
				  background: ' . $primary_color . ';
				}
				
				.btn-primary:hover, .btn-primary:active {
				  border-color: ' . $primary_color_hover . ';
				  background: ' . $primary_color_hover . ';
				}
				
				.header.bg--theme_color {
				  background: ' . $primary_color_gradient . ';
				  background: -webkit-linear-gradient(left, ' . $primary_color . ' 0%, ' . $primary_color_gradient . ' 100%);
				  background: -o-linear-gradient(left, ' . $primary_color . ' 0%, ' . $primary_color_gradient . ' 100%);
				  background: linear-gradient(to right, ' . $primary_color . ' 0%, ' . $primary_color_gradient . ' 100%);
				}
				
				.widget.widget_calendar #calendar_wrap table#wp-calendar caption {
				  background: ' . $primary_color . ';
				  border: 1px solid ' . $primary_color . ';
				}
			';

			wp_add_inline_style( 'ikonwp-theme-color', $custom_color_css );
		}

		/** header */
		$ikonwp_header_default_background_type = get_theme_mod( 'ikonwp_header_default_background_type', 'theme_color' );
		$ikonwp_header_navbar_background_type  = get_theme_mod( 'ikonwp_header_navbar_background_type', 'theme_color' );

		/** header custom background image */
		if ( 'custom_image' == $ikonwp_header_default_background_type ) {

			/** check header image */
			if ( has_header_image() ) {
				$header_image = get_header_image();

				wp_add_inline_style( 'ikonwp-theme', '.header.bg--custom_image {
					background-image: url("' . esc_url( $header_image ) . '");
					background-size: cover; 
					background-position: center center;
				}' );
			}
		}

		/** header custom background color */
		if ( 'custom_color' == $ikonwp_header_default_background_type ) {
			wp_add_inline_style( 'ikonwp-theme-color', self::generate_css( '.header.bg--custom_color', 'background-color', 'ikonwp_header_default_background_color', '', '', '!important' ) );
		}

		/** navbar custom background color */
		if ( 'custom_color' == $ikonwp_header_navbar_background_type ) {
			wp_add_inline_style( 'ikonwp-theme-color', self::generate_css( '.header .header__navbar.bg--custom_color', 'background-color', 'ikonwp_header_navbar_background_color', '', '', '!important' ) );
		}

		/** header css selector */
		$header_text_custom_color_selector = array(
			/** header */
			'.header.text--custom_color'
		);

		/** header navbar css selector */
		$header_navbar_text_custom_color_selector = array(
			/** header logo */
			'.header.text--custom_color .header__navbar .header__logo, 
			.header.text--custom_color .header__navbar .header__logo a,
			.header .header__navbar.text--custom_color .header__logo, 
			.header .header__navbar.text--custom_color .header__logo a',

			/** header navbar toggler */
			'.header.text--custom_color .header__navbar .navbar-toggler,
			.header .header__navbar.text--custom_color .navbar-toggler',

			/** header navbar nav */
			'.header.text--custom_color .header__navbar .navbar-nav .nav-link,
			.header .header__navbar.text--custom_color .navbar-nav .nav-link',

			/** header html */
			'.header.text--custom_color .header__navbar .header__html,
			.header .header__navbar.text--custom_color .header__html',

			/** header icons */
			'.header.text--custom_color .header__navbar .header__icons, 
			.header.text--custom_color .header__navbar .header__icons a,
			.header .header__navbar.text--custom_color .header__icons, 
			.header .header__navbar.text--custom_color .header__icons a'
		);

		/** header title css selector */
		$header_title_text_custom_color_selector = array(
			/** header title */
			'.header.text--custom_color .header__title',
			'.header .header__title.text--custom_color'
		);

		/** check header text color */
		if ( 'blank' !== get_theme_mod( 'header_textcolor', false ) ) {

			/** add header text color */
			wp_add_inline_style( 'ikonwp-theme-color', self::generate_css( implode( ', ', array_merge( $header_text_custom_color_selector, $header_navbar_text_custom_color_selector, $header_title_text_custom_color_selector ) ), 'color', 'header_textcolor', '', '#', '!important' ) );
		}

		/** header navbar text color */
		wp_add_inline_style( 'ikonwp-theme-color', self::generate_css( implode( ', ', $header_navbar_text_custom_color_selector ), 'color', 'ikonwp_header_navbar_text_color', '', '', '!important' ) );

		/** header title text color */
		wp_add_inline_style( 'ikonwp-theme-color', self::generate_css( implode( ', ', $header_title_text_custom_color_selector ), 'color', 'ikonwp_header_title_text_color', '', '', '!important' ) );

		/** typography */
		$google_fonts = ikonwp_get_google_fonts();

		/** header typography selector */
		$header_typography_selector = array(
			'.header',

			/** text and title tags */
			'.header .header__text h1',
			'.header .header__title h1',

			/** h tags */
			'.header h1',
			'.header h2',
			'.header h3',
			'.header h4',
			'.header h5',
			'.header h6'
		);

		/** typography - body */
		$ikonwp_typography_body_font_family  = get_theme_mod( 'ikonwp_typography_body_font_family', false );
		$ikonwp_typography_body_font_subsets = get_theme_mod( 'ikonwp_typography_body_font_subsets', '' );
		$ikonwp_typography_body_line_height  = get_theme_mod( 'ikonwp_typography_body_line_height', false );

		/** typography - body - font family */
		if ( $ikonwp_typography_body_font_family ) {
			$ikonwp_typography_body_google_fonts_id = sanitize_key( str_replace( ' ', '-', $ikonwp_typography_body_font_family ) );

			$ikonwp_typography_body_google_fonts_url = 'https://fonts.googleapis.com/css?' . http_build_query( array(
					'family'  => $ikonwp_typography_body_font_family . ':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
					'display' => 'swap',
					'subset'  => $ikonwp_typography_body_font_subsets
				) );

			wp_register_style( $ikonwp_typography_body_google_fonts_id . '-google-fonts', esc_url( $ikonwp_typography_body_google_fonts_url ) );
			wp_enqueue_style( $ikonwp_typography_body_google_fonts_id . '-google-fonts' );

			wp_add_inline_style( 'ikonwp-theme', 'body {
				font-family: ' . $google_fonts[ $ikonwp_typography_body_font_family ] . '
			}' );
		}

		/** typography - body - line height */
		if ( $ikonwp_typography_body_line_height ) {
			wp_add_inline_style( 'ikonwp-theme', self::generate_css( 'body', 'line-height', 'ikonwp_typography_body_line_height', '', '', '!important' ) );
		}

		/** typography - header */
		$ikonwp_typography_header_font_family  = get_theme_mod( 'ikonwp_typography_header_font_family', false );
		$ikonwp_typography_header_font_subsets = get_theme_mod( 'ikonwp_typography_header_font_subsets', '' );
		$ikonwp_typography_header_line_height  = get_theme_mod( 'ikonwp_typography_header_line_height', false );

		/** typography - header - font family */
		if ( $ikonwp_typography_header_font_family ) {
			$ikonwp_typography_header_google_fonts_id = sanitize_key( str_replace( ' ', '-', $ikonwp_typography_header_font_family ) );

			$ikonwp_typography_header_google_fonts_url = 'https://fonts.googleapis.com/css?' . http_build_query( array(
					'family'  => $ikonwp_typography_header_font_family . ':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
					'display' => 'swap',
					'subset'  => $ikonwp_typography_header_font_subsets
				) );

			wp_register_style( $ikonwp_typography_header_google_fonts_id . '-google-fonts', esc_url( $ikonwp_typography_header_google_fonts_url ) );
			wp_enqueue_style( $ikonwp_typography_header_google_fonts_id . '-google-fonts' );

			wp_add_inline_style( 'ikonwp-theme', implode( ', ', $header_typography_selector ) . '{
				font-family: ' . $google_fonts[ $ikonwp_typography_header_font_family ] . '
			}' );
		}

		/** typography - header - line height */
		if ( $ikonwp_typography_header_line_height ) {
			wp_add_inline_style( 'ikonwp-theme', self::generate_css( implode( ', ', $header_typography_selector ), 'line-height', 'ikonwp_typography_header_line_height', '', '', '!important' ) );
		}

	}

	/**
	 * This outputs the javascript needed to automate the live settings preview
	 * Used by hook: 'customize_preview_init'
	 * @see add_action('customize_preview_init',$func)
	 */
	public static function live_preview() {
		wp_enqueue_script( 'ikonwp-customizer-preview', get_template_directory_uri() . '/js/customize-preview.js', array(
			'jquery',
			'customize-preview'
		), IKONWP_VERSION, true );
	}

	/**
	 * This will generate a line of CSS for use in header output
	 * If the setting ($mod_name) has no defined value, the CSS will not be output
	 *
	 * @param $selector - CSS selector
	 * @param $style - CSS *property* to modify
	 * @param $theme_mod_name - 'theme_mod' name
	 * @param bool|false $theme_mod_default - 'theme_mod' default
	 * @param string $prefix - before the CSS property
	 * @param string $postfix - after the CSS property
	 * @param bool|true $echo
	 *
	 * @return string
	 * @uses get_theme_mod()
	 */
	public static function generate_css( $selector, $style, $theme_mod_name, $theme_mod_default = false, $prefix = '', $postfix = '', $echo = false ) {
		$return = '';
		$mod    = get_theme_mod( $theme_mod_name, $theme_mod_default );

		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix );
			if ( $echo ) {
				echo $return;
			}
		}

		return $return;
	}
}

add_action( 'customize_register', array( 'IkonWP_Customize', 'register' ) );
add_action( 'wp_enqueue_scripts', array( 'IkonWP_Customize', 'custom_inline_style' ), 20 );
add_action( 'customize_preview_init', array( 'IkonWP_Customize', 'live_preview' ) );

/**
 * IkonWP - Customize Controls
 * get data contexts
 */
function ikonwp_customize_controls_get_data_contexts() {
	$contexts = array(
		'ikonwp_blog_grid_columns'              => array(
			array(
				'setting' => 'ikonwp_blog_layout',
				'value'   => 'grid'
			)
		),
		'ikonwp_header_builder_elements'        => array(
			array(
				'setting' => '__device',
				'value'   => 'desktop'
			)
		),
		'ikonwp_header_builder_mobile_elements' => array(
			array(
				'setting'  => '__device',
				'operator' => 'in',
				'value'    => array( 'tablet', 'mobile' )
			)
		)
	);

	return apply_filters( 'ikonwp_customize_controls_get_data_contexts', $contexts );
}

/**
 * IkonWP - Customize Controls
 * scripts
 */
function ikonwp_customize_controls_scripts() {

	wp_enqueue_script( 'ikonwp-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array(
		'jquery',
		'wp-color-picker'
	), IKONWP_VERSION, true );

	wp_localize_script( 'ikonwp-customize-controls', 'ikonwp_l10n', array(
		'ikonwp_label'           => esc_html__( 'IkonWP', 'ikonwp' ),
		'post_type_label'        => esc_html__( 'Post Type', 'ikonwp' ),
		'custom_post_type_label' => esc_html__( 'Custom Post Type', 'ikonwp' )
	) );

	wp_localize_script( 'ikonwp-customize-controls', 'ikonwp_customizer_controls_data', array(
		'contexts' => ikonwp_customize_controls_get_data_contexts()
	) );
}

add_action( 'customize_controls_enqueue_scripts', 'ikonwp_customize_controls_scripts' );

/**
 * IkonWP - Customize Controls
 * styles
 */
function ikonwp_customize_controls_styles() {

	wp_enqueue_style( 'ikonwp-customize-controls', get_template_directory_uri() . '/css/customize-controls.css', array(), IKONWP_VERSION );
}

add_action( 'customize_controls_enqueue_scripts', 'ikonwp_customize_controls_styles' );

/**
 * Sanitize
 * image
 *
 * @param $input
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_image( $input, $setting ) {
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon'
	);

	$file = wp_check_filetype( $input, $mimes );

	/** check file type */
	if ( ! $file['type'] ) {
		return $setting->default;
	}

	return esc_url_raw( $input );
}

/**
 * Sanitize
 * select
 *
 * @param $value
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_select( $value, $setting ) {

	/**
	 * sanitize value
	 * @var string $value
	 */
	$value = sanitize_key( $value );

	/**
	 * get select control
	 * @var WP_Customize_Control $select_control
	 */
	$select_control = $setting->manager->get_control( $setting->id );

	/** check choices */
	if ( ! is_array( $select_control->choices ) ) {
		return $setting->default;
	}

	/** check choices */
	if ( ! array_key_exists( $value, $select_control->choices ) ) {
		return $setting->default;
	}

	return $value;
}

/**
 * Sanitize
 * checkbox multiple
 *
 * @param $values
 *
 * @return array
 */
function ikonwp_sanitize_checkbox_multiple( $values ) {

	/** check string */
	if ( is_string( $values ) ) {
		$values = explode( ',', $values );
	}

	/** check array */
	if ( ! is_array( $values ) ) {
		$values = array( $values );
	}

	/** check values */
	if ( empty( $values ) ) {
		return array();
	}

	/** sanitize values */
	$values = array_map( 'sanitize_text_field', $values );

	return $values;
}

/**
 * Sanitize
 * rgba color
 *
 * @param $value
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_rgba_color( $value, $setting ) {

	if ( empty( $value ) || is_array( $value ) ) {
		return $setting->default;
	}

	/** if string does not start with 'rgba', then treat as hex */
	if ( false === strpos( $value, 'rgba' ) ) {
		return sanitize_hex_color( $value );
	}

	/** sanitize rgba */
	$value = str_replace( ' ', '', $value );
	sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

	return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

/**
 * IkonWP
 * return array of Google Fonts list
 *
 * @param $value
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_google_fonts( $value, $setting ) {

	/**
	 * sanitize value
	 * @var string $value
	 */
	$value = sanitize_text_field( $value );

	/**
	 * get select control
	 * @var WP_Customize_Control $select_control
	 */
	$select_control = $setting->manager->get_control( $setting->id );

	/** check choices */
	if ( ! is_array( $select_control->choices ) ) {
		return $setting->default;
	}

	/** check choices */
	if ( ! array_key_exists( $value, $select_control->choices ) ) {
		return $setting->default;
	}

	return $value;
}

/**
 * validate number value
 *
 * @param string $number
 * @param array $range
 *
 * @return string
 */
function ikonwp_validate_number( $number, $range ) {
	if ( ! is_numeric( $number ) ) {
		return '';
	}

	$step = empty( $range['step'] ) ? 1 : $range['step'];
	$min  = empty( $range['min'] ) ? $number : $range['min'];
	$max  = empty( $range['max'] ) ? $number : $range['max'];

	if ( preg_match( '/\d*?\.(\d*)/', $step, $matches ) ) {
		$decimal_count = strlen( $matches[1] );
	} else {
		$decimal_count = 0;
	}

	/** make sure the number is divisible by the step value */
	if ( ! is_int( $number / $step ) ) {
		$number = round( $number / $step, $decimal_count ) * $step;
	}

	/** make sure the number is not smaller than min value */
	if ( $number < $min ) {
		$number = $min;
	}

	/** make sure the number is not higher than max value */
	if ( $number > $max ) {
		$number = $max;
	}

	return $number;
}

/**
 * validate dimension (number + unit) value
 *
 * @param string $dimension
 * @param array $available_units
 *
 * @return string
 */
function ikonwp_validate_dimension( $dimension, $available_units ) {
	$dimension_number = floatval( $dimension );
	$dimension_unit   = str_replace( $dimension_number, '', $dimension );

	/** check if no number found, then return empty string (without unit) */
	if ( $dimension_unit === $dimension ) {
		return '';
	}

	/** check if selected unit is invalid, then return empty string (without unit) */
	if ( ! array_key_exists( $dimension_unit, $available_units ) ) {
		return '';
	}

	$selected_unit = $available_units[ $dimension_unit ];

	$dimension_number = ikonwp_validate_number( $dimension_number, $selected_unit );

	/** check if number is invalid, then return empty string (without unit) */
	if ( '' === $dimension_number ) {
		return '';
	}

	$dimension = $dimension_number . $dimension_unit;

	return $dimension;
}

/**
 * sanitize dimension value
 *
 * @param string $value
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_dimension( $value, $setting ) {
	$control_id = preg_replace( '/__(tablet|mobile)/', '', $setting->id );

	$control = $setting->manager->get_control( $control_id );

	$value = ikonwp_validate_dimension( $value, $control->units );

	return $value;
}

/**
 * sanitize dimensions value
 *
 * @param string $value
 * @param WP_Customize_Setting $setting
 *
 * @return string
 */
function ikonwp_sanitize_dimensions( $value, $setting ) {
	if ( '' === trim( $value ) ) {
		return '';
	}

	$control_id = preg_replace( '/__(tablet|mobile)/', '', $setting->id );

	$control = $setting->manager->get_control( $control_id );

	/** elaborate each property */
	$props = explode( ' ', $value );
	if ( 4 > count( $props ) ) {
		return '';
	}

	/**
	 * validate each property
	 * @var int $i
	 */
	for ( $i = 0; $i < 4; $i ++ ) {
		$props[ $i ] = ikonwp_validate_dimension( $props[ $i ], $control->units );
	}

	$value = implode( ' ', $props );

	return $value;
}

/**
 * sanitize builder value
 *
 * @param array $value
 * @param WP_Customize_Setting $setting
 *
 * @return array
 */
function ikonwp_sanitize_builder( $value, $setting ) {
	/** check input is an array */
	$value = (array) $value;

	$valid_id = preg_match( '/(.*?)_((?:top|main|bottom|vertical).*)/', $setting->id, $matches );

	/** check setting id */
	if ( ! $valid_id ) {
		return array();
	}

	$control_id = $matches[1];
	$location   = $matches[2];

	$control = $setting->manager->get_control( $control_id );

	foreach ( $value as $i => $slug ) {
		if ( ! array_key_exists( $slug, $control->choices ) ) {
			unset( $value[ $i ] );
		}

		if ( array_key_exists( $location, ikonwp_array_value( $control->limitations, $slug, array() ) ) ) {
			unset( $value[ $i ] );
		}
	}

	return array_values( $value );
}

/**
 * IkonWP
 * return array of Google Fonts list
 *
 * @return array
 */
function ikonwp_get_google_fonts() {
	/** @var WP_Filesystem_Base $wp_filesystem */
	global $wp_filesystem;

	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	$json = $wp_filesystem->get_contents( get_template_directory() . '/includes/lists/google-fonts.json' );

	return json_decode( $json, true );
}

/**
 * IkonWP
 * return array of Google Fonts subsets
 *
 * Note: limited subsets
 *
 * @return array
 */
function ikonwp_get_google_fonts_subsets() {
	return array(
		// 'latin' always chosen by default
		'latin-ext'    => 'Latin Extended',
		//'arabic'       => 'Arabic',
		//'bengali'      => 'Bengali',
		'cyrillic'     => 'Cyrillic',
		'cyrillic-ext' => 'Cyrillic Extended',
		//'devaganari'   => 'Devaganari',
		'greek'        => 'Greek',
		'greek-ext'    => 'Greek Extended',
		//'gujarati'     => 'Gujarati',
		//'gurmukhi'     => 'Gurmukhi',
		//'hebrew'       => 'Hebrew',
		//'kannada'      => 'Kannada',
		//'khmer'        => 'Khmer',
		//'malayalam'    => 'Malayalam',
		//'myanmar'      => 'Myanmar',
		//'oriya'        => 'Oriya',
		//'sinhala'      => 'Sinhala',
		//'tamil'        => 'Tamil',
		//'telugu'       => 'Telugu',
		//'thai'         => 'Thai',
		'vietnamese'   => 'Vietnamese'
	);
}

/**
 * Add theme color class to body
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_body_theme_color_class( $classes ) {

	$ikonwp_colors_theme_color = get_theme_mod( 'ikonwp_colors_theme_color', 'orange' );

	if ( $ikonwp_colors_theme_color ) {
		$classes[] = 'ikonwp-theme-' . $ikonwp_colors_theme_color;
	}

	return $classes;
}

add_filter( 'body_class', 'ikonwp_body_theme_color_class' );

/**
 * Add display layout class to ikonwp wrapper
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_wrapper_display_layout_class( $classes ) {

	if ( get_theme_mod( 'ikonwp_display_layout', 'full_width' ) == 'full_width' ) {
		$classes[] = 'wrapper--full_width';
	}

	if ( get_theme_mod( 'ikonwp_display_layout', 'full_width' ) == 'boxed' ) {
		$classes[] = 'wrapper--boxed';
	}

	return $classes;
}

add_filter( 'ikonwp_wrapper_class', 'ikonwp_wrapper_display_layout_class' );

/**
 * Add header top layout class to ikonwp header top container
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_top_container_header_top_layout_class( $classes ) {

	if ( get_theme_mod( 'ikonwp_header_top_layout', 'full_width' ) == 'full_width' ) {
		$classes[] = 'header__top--full_width';
	}

	if ( get_theme_mod( 'ikonwp_header_top_layout', 'full_width' ) == 'content_width' ) {
		$classes[] = 'header__top--content_width';
		$classes[] = 'container';
	}

	return $classes;
}

add_filter( 'ikonwp_header_top_container_class', 'ikonwp_header_top_container_header_top_layout_class' );

/**
 * Add header navbar layout class to ikonwp header navbar container
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_navbar_container_header_navbar_layout_class( $classes ) {

	if ( get_theme_mod( 'ikonwp_header_navbar_layout', 'full_width' ) == 'full_width' ) {
		$classes[] = 'header__navbar--full_width';
	}

	if ( get_theme_mod( 'ikonwp_header_navbar_layout', 'full_width' ) == 'content_width' ) {
		$classes[] = 'header__navbar--content_width';
		$classes[] = 'container';
	}

	return $classes;
}

add_filter( 'ikonwp_header_navbar_container_class', 'ikonwp_header_navbar_container_header_navbar_layout_class' );

/**
 * Add header background type class to ikonwp header
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_background_type_class( $classes ) {

	$backround_type = get_theme_mod( 'ikonwp_header_default_background_type', 'theme_color' );

	/** custom image additional condition */
	if ( 'custom_image' == $backround_type ) {

		/** check header image */
		if ( ! get_header_image() ) {
			return $classes;
		}
	}

	/** custom color additional condition */
	if ( 'custom_color' == $backround_type ) {

		/** check background color */
		if ( ! get_theme_mod( 'ikonwp_header_default_background_color', false ) ) {
			return $classes;
		}
	}

	$classes[] = 'bg--' . $backround_type;

	return $classes;
}

add_filter( 'ikonwp_header_class', 'ikonwp_header_background_type_class' );

/**
 * Add header text color class to header
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_text_color_class( $classes ) {

	$header_textcolor = get_theme_mod( 'header_textcolor', false );

	if ( $header_textcolor && 'blank' !== $header_textcolor ) {
		$classes[] = 'text--custom_color';
	}

	return $classes;
}

add_filter( 'ikonwp_header_class', 'ikonwp_header_text_color_class' );

/**
 * Add header background type class to ikonwp header navbar
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_navbar_background_type_class( $classes ) {

	$backround_type = get_theme_mod( 'ikonwp_header_navbar_background_type', 'theme_color' );

	/** default bg */
	if ( 'theme_color' == $backround_type ) {
		if ( ! get_theme_mod( 'ikonwp_colors_theme_color', 'orange' ) ) {
			/** without color set bg white */
			$classes[] = 'bg-white';
		} else {
			/** with color set bg transparent */
			$classes[] = 'bg--transparent';
		}
	}

	/** custom color additional condition */
	if ( 'custom_color' == $backround_type ) {

		/** check background color */
		if ( ! get_theme_mod( 'ikonwp_header_navbar_background_color', false ) ) {
			return $classes;
		}
	}

	$classes[] = 'bg--' . $backround_type;

	return $classes;
}

add_filter( 'ikonwp_header_navbar_class', 'ikonwp_header_navbar_background_type_class' );

/**
 * Add header navbar text color class to header navbar
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_navbar_text_color_class( $classes ) {

	if ( get_theme_mod( 'ikonwp_header_navbar_text_color', false ) ) {
		$classes[] = 'text--custom_color';
	}

	return $classes;
}

add_filter( 'ikonwp_header_navbar_class', 'ikonwp_header_navbar_text_color_class' );

/**
 * Add header title text color class to header title
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_title_text_color_class( $classes ) {

	if ( get_theme_mod( 'ikonwp_header_title_text_color', false ) ) {
		$classes[] = 'text--custom_color';
	}

	return $classes;
}

add_filter( 'ikonwp_header_title_class', 'ikonwp_header_title_text_color_class' );

/**
 * Add header title text align class to header title
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_title_text_align_class( $classes ) {

	$classes[] = 'text-' . get_theme_mod( 'ikonwp_header_title_text_align', 'center' );

	return $classes;
}

add_filter( 'ikonwp_header_title_class', 'ikonwp_header_title_text_align_class' );

/**
 * Add header menu 1 brakpoint class to main navbar (alias menu 1)
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_header_menu_1_breakpoint_class( $classes ) {

	$classes[] = 'navbar-expand-' . get_theme_mod( 'ikonwp_header_elements_menu_1_breakpoint', 'lg' );

	return $classes;
}

add_filter( 'ikonwp_main_navbar_class', 'ikonwp_header_menu_1_breakpoint_class' );
add_filter( 'ikonwp_main_navbar_mobile_class', 'ikonwp_header_menu_1_breakpoint_class' );

/**
 * Add col class to ikonwp post grid
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_post_grid_col_class( $classes ) {

	$ikonwp_blog_grid_columns = get_theme_mod( 'ikonwp_blog_grid_columns', '2' );

	if ( '2' == $ikonwp_blog_grid_columns ) {
		$classes[] = 'col-md-6';
	}

	return $classes;
}

add_filter( 'ikonwp_post_grid_class', 'ikonwp_post_grid_col_class' );