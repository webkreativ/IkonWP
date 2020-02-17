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

		/**
		 * Site Identity
		 */
		$wp_customize->get_setting( 'custom_logo' )->transport     = 'refresh';
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		/**
		 * Display
		 * -- Layout (select: Full Width, Boxed)
		 *
		 * Header
		 * -- Default
		 * ---- Background Type (select: Theme Color, Custom Background Image, Custom Background Color)
		 * ---- Background Image (image)
		 * ---- Background Color (alphacolor)
		 * ---- Text Color (color)
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
		 * Sidebars
		 * -- Default
		 * ---- Right Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 * -- Post
		 * ---- Right Sidebar - Archive - Display (select: Enabled, Disabled)
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 * -- Page
		 * ---- Right Sidebar - Singular - Display (select: Enabled, Disabled)
		 *
		 * Footer
		 * -- Footer Text
		 */

		/**
		 * Display
		 * options
		 */
		$wp_customize->add_section( 'ikonwp_display', array(
			'title'      => __( 'Display', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_display_layout_select', array(
			'label'       => __( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_display',
			'settings'    => 'ikonwp_display_layout',
			'type'        => 'select',
			'choices'     => array(
				'full_width' => __( 'Full Width', 'ikonwp' ),
				'boxed'      => __( 'Boxed', 'ikonwp' )
			),
			'description' => __( 'Select the body display layout', 'ikonwp' )
		) );

		/**
		 * Header
		 * options
		 */
		$wp_customize->add_panel( 'ikonwp_header', array(
			'title'    => __( 'Header', 'ikonwp' ),
			'priority' => 45
		) );

		/**  header - default */
		$wp_customize->add_section( 'ikonwp_header_default', array(
			'title'      => __( 'Default', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_header_default_background_type_select', array(
			'label'       => __( 'Background Type', 'ikonwp' ),
			'section'     => 'ikonwp_header_default',
			'priority'    => 1,
			'settings'    => 'ikonwp_header_default_background_type',
			'type'        => 'select',
			'choices'     => array(
				'theme_color'  => __( 'Theme Color', 'ikonwp' ),
				'custom_image' => __( 'Custom Background Image', 'ikonwp' ),
				'custom_color' => __( 'Custom Background Color', 'ikonwp' )
			),
			'description' => __( 'Select the header background type option', 'ikonwp' )
		) );

		/** header - default - background color */
		$wp_customize->add_setting( 'ikonwp_header_default_background_color', array(
			'sanitize_callback' => 'ikonwp_sanitize_rgba_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Alpha_Color_Control( $wp_customize, 'ikonwp_header_default_background_color_color', array(
			'label'       => __( 'Background Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_default',
			'settings'    => 'ikonwp_header_default_background_color',
			'description' => esc_html__( 'Select the header background color', 'ikonwp' ),
			'priority'    => 12
		) ) );

		/** header - default - background image */
		$wp_customize->get_control( 'header_image' )->label    = __( 'Background Image', 'ikonwp' );
		$wp_customize->get_control( 'header_image' )->section  = 'ikonwp_header_default';
		$wp_customize->get_control( 'header_image' )->priority = 3;

		/** header - default - text color */
		$wp_customize->get_control( 'header_textcolor' )->label    = __( 'Text Color', 'ikonwp' );
		$wp_customize->get_control( 'header_textcolor' )->section  = 'ikonwp_header_default';
		$wp_customize->get_control( 'header_textcolor' )->priority = 20;

		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		/**  header - navbar */
		$wp_customize->add_section( 'ikonwp_header_navbar', array(
			'title'      => __( 'Navbar', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_header_navbar_layout_select', array(
			'label'       => __( 'Layout', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'settings'    => 'ikonwp_header_navbar_layout',
			'type'        => 'select',
			'choices'     => array(
				'full_width'    => __( 'Full Width', 'ikonwp' ),
				'content_width' => __( 'Content Width', 'ikonwp' )
			),
			'description' => __( 'Select the navbar layout', 'ikonwp' )
		) );

		/** header - navbar - background type */
		$wp_customize->add_setting( 'ikonwp_header_navbar_background_type', array(
			'default'           => 'theme_color',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_navbar_background_type_select', array(
			'label'       => __( 'Background Type', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'settings'    => 'ikonwp_header_navbar_background_type',
			'type'        => 'select',
			'choices'     => array(
				'theme_color'  => __( 'Theme Color', 'ikonwp' ),
				'transparent'  => __( 'Transparent', 'ikonwp' ),
				'custom_color' => __( 'Custom Background Color', 'ikonwp' )
			),
			'description' => __( 'Select the navbar background type option', 'ikonwp' )
		) );

		/** header - navbar - background color */
		$wp_customize->add_setting( 'ikonwp_header_navbar_background_color', array(
			'sanitize_callback' => 'ikonwp_sanitize_rgba_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Alpha_Color_Control( $wp_customize, 'ikonwp_header_navbar_background_color_color', array(
			'label'       => __( 'Background Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'settings'    => 'ikonwp_header_navbar_background_color',
			'description' => esc_html__( 'Select the navbar background color', 'ikonwp' )
		) ) );

		/** header - navbar - text color */
		$wp_customize->add_setting( 'ikonwp_header_navbar_text_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_header_navbar_text_color_color', array(
			'label'       => __( 'Text Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_navbar',
			'settings'    => 'ikonwp_header_navbar_text_color',
			'description' => esc_html__( 'Select the navbar text color', 'ikonwp' ),
		) ) );

		/**  header - title */
		$wp_customize->add_section( 'ikonwp_header_title', array(
			'title'      => __( 'Title', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_header_title_display_select', array(
			'label'       => __( 'Display', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'priority'    => 1,
			'settings'    => 'ikonwp_header_title_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the header title display option', 'ikonwp' )
		) );

		/** header - title - text color */
		$wp_customize->add_setting( 'ikonwp_header_title_text_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_header_title_text_color_color', array(
			'label'       => __( 'Text Color', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'settings'    => 'ikonwp_header_title_text_color',
			'description' => esc_html__( 'Select the title text color', 'ikonwp' ),
		) ) );

		/** header - title - text align */
		$wp_customize->add_setting( 'ikonwp_header_title_text_align', array(
			'default'           => 'center',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_header_title_text_align_select', array(
			'label'       => __( 'Text Align', 'ikonwp' ),
			'section'     => 'ikonwp_header_title',
			'settings'    => 'ikonwp_header_title_text_align',
			'type'        => 'select',
			'choices'     => array(
				'left'   => __( 'Left', 'ikonwp' ),
				'center' => __( 'Center', 'ikonwp' ),
				'right'  => __( 'Right', 'ikonwp' )
			),
			'description' => __( 'Select the header title text align option', 'ikonwp' )
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

		$wp_customize->add_control( 'ikonwp_colors_theme_color_select', array(
			'label'       => esc_html__( 'Theme Color', 'ikonwp' ),
			'section'     => 'colors',
			'settings'    => 'ikonwp_colors_theme_color',
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

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color_color', array(
			'label'       => __( 'Primary Color', 'ikonwp' ),
			'section'     => 'colors',
			'settings'    => 'ikonwp_colors_primary_color',
			'description' => esc_html__( 'Select the primary color, and the first gradient color', 'ikonwp' )
		) ) );

		/** colors - primary color - hover */
		$wp_customize->add_setting( 'ikonwp_colors_primary_color_hover', array(
			'default'           => '#6F6F6F',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color_hover_color', array(
			'label'       => __( 'Primary Color - Hover Color', 'ikonwp' ),
			'section'     => 'colors',
			'settings'    => 'ikonwp_colors_primary_color_hover',
			'description' => esc_html__( 'Select the primary hover color', 'ikonwp' )
		) ) );

		/** colors - primary color - gradient */
		$wp_customize->add_setting( 'ikonwp_colors_primary_color_gradient', array(
			'default'           => '#555555',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ikonwp_colors_primary_color_gradient_color', array(
			'label'       => __( 'Primary Color - Second Gradient Color', 'ikonwp' ),
			'section'     => 'colors',
			'settings'    => 'ikonwp_colors_primary_color_gradient',
			'description' => esc_html__( 'Select the second color for the gradient', 'ikonwp' )
		) ) );

		/**
		 * Typography
		 * options
		 */
		$google_fonts         = ikonwp_get_google_fonts();
		$google_fonts_subsets = ikonwp_get_google_fonts_subsets();

		$wp_customize->add_panel( 'ikonwp_typography', array(
			'title'    => __( 'Typography', 'ikonwp' ),
			'priority' => 45
		) );

		/** typography - body */
		$wp_customize->add_section( 'ikonwp_typography_body', array(
			'title'      => __( 'Body', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_typography_body_font_family_select', array(
			'label'       => __( 'Font Family', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'settings'    => 'ikonwp_typography_body_font_family',
			'type'        => 'select',
			'choices'     => array_merge( array(
				'' => __( 'None - Theme Default', 'ikonwp' )
			), $google_fonts ),
			'description' => __( 'Select the body font family', 'ikonwp' )
		) );

		/** typography - body - font subsets */
		$wp_customize->add_setting( 'ikonwp_typography_body_font_subsets', array(
			'sanitize_callback' => 'ikonwp_sanitize_checkbox_multiple',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Checkbox_Multiple_Control( $wp_customize, 'ikonwp_typography_body_font_subsets_checkbox_multiple', array(
			'label'       => __( 'Font Subsets', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'settings'    => 'ikonwp_typography_body_font_subsets',
			'choices'     => $google_fonts_subsets,
			'description' => __( 'Select the body font subsets (Note: \'Latin\' always chosen by default)', 'ikonwp' )
		) ) );

		/** typography - body - line height */
		$wp_customize->add_setting( 'ikonwp_typography_body_line_height', array(
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_body_line_height_text', array(
			'label'       => __( 'Line Height', 'ikonwp' ),
			'section'     => 'ikonwp_typography_body',
			'settings'    => 'ikonwp_typography_body_line_height',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 0.1
			)
		) );

		/** typography - header */
		$wp_customize->add_section( 'ikonwp_typography_header', array(
			'title'      => __( 'Header', 'ikonwp' ),
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

		$wp_customize->add_control( 'ikonwp_typography_header_font_family_select', array(
			'label'       => __( 'Font Family', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'settings'    => 'ikonwp_typography_header_font_family',
			'type'        => 'select',
			'choices'     => array_merge( array(
				'' => __( 'None - Theme Default', 'ikonwp' )
			), $google_fonts ),
			'description' => __( 'Select the header font family', 'ikonwp' )
		) );

		/** typography - header - font subsets */
		$wp_customize->add_setting( 'ikonwp_typography_header_font_subsets', array(
			'sanitize_callback' => 'ikonwp_sanitize_checkbox_multiple',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( new IkonWP_Customize_Checkbox_Multiple_Control( $wp_customize, 'ikonwp_typography_header_font_subsets_checkbox_multiple', array(
			'label'       => __( 'Font Subsets', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'settings'    => 'ikonwp_typography_header_font_subsets',
			'choices'     => $google_fonts_subsets,
			'description' => __( 'Select the header font subsets (Note: \'Latin\' always chosen by default)', 'ikonwp' )
		) ) );

		/** typography - header - line height */
		$wp_customize->add_setting( 'ikonwp_typography_header_line_height', array(
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_typography_header_line_height_text', array(
			'label'       => __( 'Line Height', 'ikonwp' ),
			'section'     => 'ikonwp_typography_header',
			'settings'    => 'ikonwp_typography_header_line_height',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'step' => 0.1
			)
		) );

		/**
		 * Sidebars
		 * options
		 */
		$wp_customize->add_panel( 'ikonwp_sidebars', array(
			'title'    => __( 'Sidebars', 'ikonwp' ),
			'priority' => 109
		) );

		/** sidebars - default */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_default', array(
			'title'      => __( 'Default', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 1,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - default - right sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display_select', array(
			'label'       => __( 'Right Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'settings'    => 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the right sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - default - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display_select', array(
			'label'       => __( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_default',
			'settings'    => 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - post */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_post', array(
			'title'      => __( 'Post', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 2,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - post - right sidebar - archive - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display_select', array(
			'label'       => __( 'Right Sidebar - Archive - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'settings'    => 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the right sidebar display in archive template option', 'ikonwp' )
		) );

		/** sidebars - post - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display_select', array(
			'label'       => __( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_post',
			'settings'    => 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/** sidebars - page */
		$wp_customize->add_section( 'ikonwp_sidebars_post_type_page', array(
			'title'      => __( 'Page', 'ikonwp' ),
			'panel'      => 'ikonwp_sidebars',
			'priority'   => 3,
			'capability' => 'edit_theme_options'
		) );

		/** sidebars - page - right sidebar - singular - display */
		$wp_customize->add_setting( 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display', array(
			'default'           => '1',
			'sanitize_callback' => 'ikonwp_sanitize_select',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options'
		) );

		$wp_customize->add_control( 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display_select', array(
			'label'       => __( 'Right Sidebar - Singular - Display', 'ikonwp' ),
			'section'     => 'ikonwp_sidebars_post_type_page',
			'settings'    => 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display',
			'type'        => 'select',
			'choices'     => array(
				'0' => __( 'Disabled', 'ikonwp' ),
				'1' => __( 'Enabled', 'ikonwp' )
			),
			'description' => __( 'Select the right sidebar display in singular template option', 'ikonwp' )
		) );

		/**
		 * Footer
		 * options
		 */
		$wp_customize->add_section( 'ikonwp_footer', array(
			'title'      => __( 'Footer', 'ikonwp' ),
			'priority'   => 110,
			'capability' => 'edit_theme_options'
		) );

		/** footer - text */
		$wp_customize->add_setting( 'ikonwp_footer_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( 'ikonwp_footer_text_text', array(
			'label'    => __( 'Footer Text', 'ikonwp' ),
			'section'  => 'ikonwp_footer',
			'settings' => 'ikonwp_footer_text',
			'type'     => 'text'
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
				  border: 1px solid ' . $primary_color_hover . ';
				}
			';

			wp_add_inline_style( 'ikonwp-theme', $custom_color_css );
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
			wp_add_inline_style( 'ikonwp-theme', self::generate_css( '.header.bg--custom_color', 'background-color', 'ikonwp_header_default_background_color', '', '', '!important' ) );
		}

		/** navbar custom background color */
		if ( 'custom_color' == $ikonwp_header_navbar_background_type ) {
			wp_add_inline_style( 'ikonwp-theme', self::generate_css( '.header .header__navbar.bg--custom_color', 'background-color', 'ikonwp_header_navbar_background_color', '', '', '!important' ) );
		}

		/** header css selector */
		$header_selector = array(
			/** header */
			'.header.text--custom_color'
		);

		/** header navbar css selector */
		$header_navbar_selector = array(
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

			/** header navbar nav mobile smartmenus */
			'.header.text--custom_color .header__navbar .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item,
			.header .header__navbar.text--custom_color .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item',

			/** header icons */
			'.header.text--custom_color .header__navbar .header__icons, 
			.header.text--custom_color .header__navbar .header__icons a,
			.header .header__navbar.text--custom_color .header__icons, 
			.header .header__navbar.text--custom_color .header__icons a'
		);

		/** header title css selector */
		$header_title_selector = array(
			/** header title */
			'.header.text--custom_color .header__title',
			'.header .header__title.text--custom_color'
		);

		/** header text color */
		$header_text_color_selector = array( $header_selector );

		/** add navbar text color to header default */
		if ( ! get_theme_mod( 'ikonwp_header_navbar_text_color' ) ) {
			$header_text_color_selector[] = $header_navbar_selector;
		}

		/** add title text color to header default */
		if ( ! get_theme_mod( 'ikonwp_header_title_text_color' ) ) {
			$header_text_color_selector[] = $header_title_selector;
		}

		wp_add_inline_style( 'ikonwp-theme', self::generate_css( implode( ', ', array_merge( $header_selector, $header_navbar_selector, $header_title_selector ) ), 'color', 'header_textcolor', '', '#', '!important' ) );

		/** header navbar text color */
		wp_add_inline_style( 'ikonwp-theme', self::generate_css( implode( ', ', $header_navbar_selector ), 'color', 'ikonwp_header_navbar_text_color', '', '', '!important' ) );

		/** header title text color */
		wp_add_inline_style( 'ikonwp-theme', self::generate_css( implode( ', ', $header_title_selector ), 'color', 'ikonwp_header_title_text_color', '', '', '!important' ) );

		/** typography */
		$google_fonts = ikonwp_get_google_fonts();

		/** typography - body */
		$ikonwp_typography_body_font_family  = get_theme_mod( 'ikonwp_typography_body_font_family', false );
		$ikonwp_typography_body_font_subsets = get_theme_mod( 'ikonwp_typography_body_font_subsets', '' );
		$ikonwp_typography_body_line_height  = get_theme_mod( 'ikonwp_typography_body_line_height', false );

		/** typography - body - font family */
		if ( $ikonwp_typography_body_font_family ) {
			$ikonwp_typography_google_fonts_id = sanitize_key( str_replace( ' ', '-', $ikonwp_typography_body_font_family ) );

			$ikonwp_typography_body_google_fonts_url = 'https://fonts.googleapis.com/css?' . http_build_query( array(
					'family'  => $ikonwp_typography_body_font_family . ':400,400i,500,500i,700,700i',
					'display' => 'swap',
					'subset'  => $ikonwp_typography_body_font_subsets
				) );

			wp_register_style( $ikonwp_typography_google_fonts_id . '-google-fonts', esc_url( $ikonwp_typography_body_google_fonts_url ) );
			wp_enqueue_style( $ikonwp_typography_google_fonts_id . '-google-fonts' );

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
			$ikonwp_typography_google_fonts_id = sanitize_key( str_replace( ' ', '-', $ikonwp_typography_header_font_family ) );

			$ikonwp_typography_header_google_fonts_url = 'https://fonts.googleapis.com/css?' . http_build_query( array(
					'family'  => $ikonwp_typography_header_font_family . ':400,400i,500,500i,700,700i',
					'display' => 'swap',
					'subset'  => $ikonwp_typography_header_font_subsets
				) );

			wp_register_style( $ikonwp_typography_google_fonts_id . '-google-fonts', esc_url( $ikonwp_typography_header_google_fonts_url ) );
			wp_enqueue_style( $ikonwp_typography_google_fonts_id . '-google-fonts' );

			wp_add_inline_style( 'ikonwp-theme', '.header {
				font-family: ' . $google_fonts[ $ikonwp_typography_header_font_family ] . '
			}' );
		}

		/** typography - header - line height */
		if ( $ikonwp_typography_header_line_height ) {
			wp_add_inline_style( 'ikonwp-theme', self::generate_css( '.header', 'line-height', 'ikonwp_typography_header_line_height', '', '', '!important' ) );
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
 * scripts
 */
function ikonwp_customize_controls_scripts() {

	wp_enqueue_script( 'ikonwp-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array(
		'jquery',
		'wp-color-picker'
	), IKONWP_VERSION, true );

	wp_localize_script( 'ikonwp-customize-controls', 'ikonwp_l10n', array(
		'ikonwp_label'           => __( 'IkonWP', 'ikonwp' ),
		'post_type_label'        => __( 'Post Type', 'ikonwp' ),
		'custom_post_type_label' => __( 'Custom Post Type', 'ikonwp' )
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
	$select_control = $setting->manager->get_control( $setting->id . '_select' );

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
	$select_control = $setting->manager->get_control( $setting->id . '_select' );

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

	if ( get_theme_mod( 'header_textcolor', false ) ) {
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