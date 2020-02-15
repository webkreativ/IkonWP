<?php
defined( 'ABSPATH' ) or die();
define( 'IKONWP_VERSION', '2.0.3' );

/**
 * include
 * other functions
 */
include_once get_template_directory() . '/includes/ikonwp-menu.php';
include_once get_template_directory() . '/includes/ikonwp-theme.php';
include_once get_template_directory() . '/includes/ikonwp-theme-customizer.php';

/**
 * Language
 * load
 */
load_theme_textdomain( 'ikonwp', get_template_directory() . '/languages' );

/**
 * Setup
 * add theme support functions
 */
function ikonwp_after_setup_theme() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	/** post */
	add_theme_support( 'post-thumbnails' );

	/** customizer */
	add_theme_support( 'custom-logo', array(
		'width'       => 200,
		'height'      => 50,
		'flex-width'  => true,
		'flex-height' => true
	) );

	/** custom header */
	add_theme_support( 'custom-header', array(
		'header-text'        => true,
		'default-text-color' => false,
		'width'              => 1920,
		'height'             => 560,
		'flex-width'         => true,
		'flex-height'        => true
	) );

	/** admin bar */
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
}

add_action( 'after_setup_theme', 'ikonwp_after_setup_theme' );

/**
 * Content width
 */
function ikonwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ikonwp_content_width', 1140 );
}

add_action( 'after_setup_theme', 'ikonwp_content_width', 0 );

/**
 * Styles
 * load in theme
 */
function ikonwp_styles() {

	wp_enqueue_style( 'ikonwp-style', get_stylesheet_uri() );

	wp_register_style( 'montserrat-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,700,700i&display=swap&subset=latin-ext' );
	wp_enqueue_style( 'montserrat-google-fonts' );

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '5.12.0' );
	wp_enqueue_style( 'font-awesome' );

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.4.1' );
	wp_enqueue_style( 'bootstrap' );

	wp_register_style( 'ikonwp-theme', get_template_directory_uri() . '/css/ikonwp-theme.min.css', array(), IKONWP_VERSION );
	wp_enqueue_style( 'ikonwp-theme' );

	/** ikonwp theme color */
	$ikonwp_theme_color = get_theme_mod( 'ikonwp_colors_theme_color', false );

	if ( $ikonwp_theme_color ) {
		wp_register_style( 'ikonwp-theme-color', get_template_directory_uri() . '/css/ikonwp-theme-' . esc_attr( $ikonwp_theme_color ) . '.min.css', array( 'ikonwp-theme' ), IKONWP_VERSION );
		wp_enqueue_style( 'ikonwp-theme-color' );
	}
}

add_action( 'wp_enqueue_scripts', 'ikonwp_styles' );

/**
 * Print styles
 * load in theme
 */
function ikonwp_print_styles() {

	wp_register_style( 'ikonwp-print', get_template_directory_uri() . '/css/ikonwp-print.min.css', array(), IKONWP_VERSION, 'print' );
	wp_enqueue_style( 'ikonwp-print' );
}

add_action( 'wp_enqueue_scripts', 'ikonwp_print_styles' );

/**
 * IkonWP
 * add editor style
 */
function ikonwp_add_editor_style() {
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}

add_action( 'init', 'ikonwp_add_editor_style' );

/**
 * JavaScript
 * load in theme
 */
function ikonwp_scripts() {

	/** popper js */
	wp_register_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array(), '1.15.0' );
	wp_enqueue_script( 'popper' );

	/** bootstrap js */
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(
		'jquery',
		'popper'
	), '4.4.1' );
	wp_enqueue_script( 'bootstrap' );

	/** respond js */
	wp_register_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.4.2' );
	wp_enqueue_script( 'respond' );

	/** comment reply */
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ikonwp_scripts' );

/**
 * WordPress Widgets
 * load in theme
 */
function ikonwp_register_sidebar() {

	register_sidebar( array(
		'id'            => 'right',
		'name'          => __( 'Right Sidebar', 'ikonwp' ),
		'description'   => __( 'This is the right sidebar', 'ikonwp' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'id'            => 'footer-first',
		'name'          => __( 'First Footer', 'ikonwp' ),
		'description'   => __( 'in Footer', 'ikonwp' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'id'            => 'footer-second',
		'name'          => __( 'Second Footer', 'ikonwp' ),
		'description'   => __( 'in Footer', 'ikonwp' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'id'            => 'footer-third',
		'name'          => __( 'Third Footer', 'ikonwp' ),
		'description'   => __( 'in Footer', 'ikonwp' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'id'            => 'footer-fourth',
		'name'          => __( 'Fourth Footer', 'ikonwp' ),
		'description'   => __( 'in Footer', 'ikonwp' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );
}

add_action( 'widgets_init', 'ikonwp_register_sidebar' );

/**
 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}