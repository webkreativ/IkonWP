<?php
defined( 'ABSPATH' ) or die();

/**
 * Bootstrap menu
 * Scripts
 */
function ikonwp_menu_scripts() {

	/** jquery smartmenus */
	wp_register_script( 'smartmenus', get_template_directory_uri() . '/js/smartmenus.min.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_script( 'smartmenus' );

	/** jquery smartmenus bootstrap addons */
	wp_register_script( 'smartmenus-bootstrap', get_template_directory_uri() . '/js/smartmenus-bootstrap.min.js', array(
		'jquery',
		'smartmenus'
	), '1.0.0', true );
	wp_enqueue_script( 'smartmenus-bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'ikonwp_menu_scripts' );

/**
 * Bootstrap menu
 * Styles
 */
function ikonwp_menu_styles() {

	/** jquery smartmenus bootstrap addons */
	wp_register_style( 'smartmenus-bootstrap', get_template_directory_uri() . '/css/smartmenus-bootstrap.min.css', array( 'bootstrap' ), '1.0.0' );
	wp_enqueue_style( 'smartmenus-bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'ikonwp_menu_styles' );

/**
 * IkonWP Main Navigation Menu
 * with Bootstrap
 *
 * @param array $args
 */
function ikonwp_main_nav_menu( $args = array() ) {

	$args = wp_parse_args( $args, array(
		'theme_location' => 'ikonwp_main',
		'menu_class'     => 'main-menu navbar-nav mx-auto',
		'container'      => false,
		'walker'         => new IkonWP_Walker_Nav_Menu()
	) );

	wp_nav_menu( apply_filters( 'ikonwp_main_nav_menu_args', $args ) );
}

register_nav_menu( 'ikonwp_main', __( 'IkonWP Main Menu', 'ikonwp' ) );

/**
 * IkonWP
 * main fallback nav menu args
 *
 * @param $args
 *
 * @return array
 */
function ikonwp_main_fallback_nav_menu_args( $args ) {

	/** fallback nav */
	if ( ! has_nav_menu( 'ikonwp_main' ) ) {
		$args = wp_parse_args( $args, array(
			'menu_class'  => 'main-menu navbar-nav mx-auto fallback-nav',
			'fallback_cb' => 'IkonWP_Walker_Nav_Menu::fallback'
		) );
	}

	return $args;
}

add_filter( 'ikonwp_main_nav_menu_args', 'ikonwp_main_fallback_nav_menu_args' );

/**
 * IkonWP Footer Navigation Menu
 * with Bootstrap
 *
 * @param array $args
 */
function ikonwp_footer_nav_menu( $args = array() ) {

	$args = wp_parse_args( $args, array(
		'theme_location' => 'ikonwp_footer',
		'menu_class'     => 'text-md-right',
		'container'      => false,
		'depth'          => - 1,
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'walker'         => new Walker_Nav_Menu()
	) );

	wp_nav_menu( apply_filters( 'ikonwp_footer_nav_menu_args', $args ) );
}

register_nav_menu( 'ikonwp_footer', __( 'IkonWP Footer Menu', 'ikonwp' ) );


/**
 * IkonWP Nav Walker
 * with Bootstrap
 */
class IkonWP_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added
	 *
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$classes = array( 'dropdown-menu', 'depth_' . $depth );

		$class_names = join( ' ', apply_filters( 'nav_children_element_css_class', array_filter( $classes ), $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= $indent . '<ul' . $class_names . '>';
	}

	/**
	 * Starts the element output
	 *
	 * @param string $output
	 * @param object $item
	 * @param int $depth
	 * @param object|array $args
	 * @param int $id
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		/**
		 * Filter
		 * args
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Indent
		 */
		$indent = '';

		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		}

		/**
		 * <li> tag
		 * attributes
		 */
		$classes = array();

		if ( ! empty( $item->classes ) ) {
			$classes = (array) $item->classes;
		}

		/** top level element */
		if ( $depth == 0 ) {
			$classes[] = 'nav-item';
		}

		/** has childen elements */
		if ( $args->walker->has_children ) {
			$classes[] = 'dropdown';
		}

		$classes[] = 'menu-item-' . $item->ID;

		if ( $item->current || $item->current_item_ancestor ) {
			$classes[] = 'active';
		}

		/**
		 * <li> tag - classes
		 * filters the CSS class(es)
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * <li> tag - id
		 * filters the ID
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		/**
		 * <a> tag
		 * attributes
		 */
		$atts = array();

		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		$atts['class']  = array();

		/** top level element */
		if ( $depth == 0 ) {
			$atts['class'][] = 'nav-link';
		}

		/** child element */
		if ( $depth > 0 ) {
			$atts['class'][] = 'dropdown-item';

			if ( $item->current || $item->current_item_ancestor ) {
				$atts['class'][] = 'active';
			}
		}

		/** format classes */
		if ( is_array( $atts['class'] ) ) {
			$atts['class'] = implode( ' ', $atts['class'] );
		}

		/**
		 * <a> tag
		 * attributes filter
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/**
		 * Filter
		 * title
		 */
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Fallback function
	 * to: fallback_cb
	 *
	 * @param $args
	 */
	public static function fallback( $args ) {

		$output = '';

		$list_args = $args;

		/** home */
		$classes = array( 'nav-item' );

		if ( is_front_page() && ! is_paged() ) {
			$classes[] = 'active';
		}

		$output .= '<li class="' . join( ' ', $classes ) . '"><a href="' . esc_url( home_url( '/' ) ) . '" class="nav-link">' . $args['link_before'] . __( 'Home', 'ikonwp' ) . $args['link_after'] . '</a></li>';

		/** If the front page is a page, add it to the exclude list */
		if ( get_option( 'show_on_front' ) == 'page' ) {
			if ( ! empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option( 'page_on_front' );
		}

		/** pages */
		$output .= wp_list_pages( wp_parse_args( array(
			'echo'     => false,
			'title_li' => '',
			'walker'   => new IkonWP_Walker_Page()
		), $list_args ) );

		/** add a menu in admin */
		if ( current_user_can( 'manage_options' ) ) {
			$output .= '<li class="nav-item float-right"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link">' . $args['link_before'] . __( 'Add a menu', 'ikonwp' ) . $args['link_after'] . ' <span class="badge badge-primary ml-1">' . __( 'admin', 'ikonwp' ) . '</span></a></li>';
		}

		$container = 'ul';

		$attrs = '';
		if ( ! empty( $args['menu_id'] ) ) {
			$attrs .= ' id="' . esc_attr( $args['menu_id'] ) . '"';
		}

		if ( ! empty( $args['menu_class'] ) ) {
			$attrs .= ' class="' . esc_attr( $args['menu_class'] ) . '"';
		}

		$output = '<' . $container . $attrs . '>' . $output . '</' . $container . '>';

		echo $output;
	}
}

/**
 * IkonWP Page Walker
 * with Bootstrap
 */
class IkonWP_Walker_Page extends Walker_Page {

	/**
	 * Outputs the beginning of the current level in the tree before elements are output
	 *
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
			$t = "\t";
			$n = "\n";
		} else {
			$t = '';
			$n = '';
		}
		$indent = str_repeat( $t, $depth );

		$classes = array( 'children', 'dropdown-menu', 'depth_' . $depth );

		$class_names = join( ' ', $classes );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= $n . $indent . '<ul ' . $class_names . '>' . $n;
	}

	/**
	 * Outputs the beginning of the current element in the tree
	 *
	 * @param string $output
	 * @param WP_Post $page
	 * @param int $depth
	 * @param array $args
	 * @param int $current_page
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {

		/** add nav item class to li */
		add_filter( 'page_css_class', array( $this, 'add_nav_item_class' ), 10, 4 );

		/** add nav link class to a */
		add_filter( 'page_menu_link_attributes', array( $this, 'add_nav_link_class' ), 10, 5 );

		parent::start_el( $output, $page, $depth, $args, $current_page );
	}

	/**
	 * Add nav item class to current page item
	 *
	 * @param $css_class
	 * @param $page
	 * @param $depth
	 * @param $args
	 *
	 * @return array
	 */
	public static function add_nav_item_class( $css_class, $page, $depth, $args ) {

		/** top level element */
		if ( $depth == 0 ) {
			$css_class[] = 'nav-item';
		}

		/** has childen elements */
		if ( in_array( 'page_item_has_children', $css_class ) ) {
			$css_class[] = 'dropdown';
		}

		/** current element */
		$is_current = array_intersect( array(
			'current_page_item',
			'current_page_parent',
			'current_page_ancestor'
		), $css_class );

		if ( ! empty( $is_current ) ) {
			$css_class[] = 'active';
		}

		return $css_class;
	}

	/**
	 * Add link class
	 *
	 * @param $atts
	 * @param WP_Post $page
	 * @param $depth
	 * @param $args
	 * @param $current_page
	 *
	 * @return mixed
	 */
	public static function add_nav_link_class( $atts, $page, $depth, $args, $current_page ) {

		if ( ! isset( $atts['class'] ) ) {
			$atts['class'] = array();
		}

		if ( empty( $atts['class'] ) ) {
			$atts['class'] = array();
		}

		if ( is_string( $atts['class'] ) ) {
			$atts['class'] = explode( ' ', $atts['class'] );
		}

		/** top level element */
		if ( $depth == 0 ) {
			$atts['class'][] = 'nav-link';
		}

		/** child element */
		if ( $depth > 0 ) {
			$atts['class'][] = 'dropdown-item';

			/** current element */
			if ( ! empty( $current_page ) ) {
				$_current_page = get_post( $current_page );
				if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
					$atts['class'][] = 'active';
				}
				if ( $page->ID == $current_page ) {
					$atts['class'][] = 'active';
				} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
					$atts['class'][] = 'active';
				}
			} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {
				$atts['class'][] = 'active';
			}
		}

		$atts['class'] = implode( ' ', $atts['class'] );

		return $atts;
	}
}