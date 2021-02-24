<?php
defined( 'ABSPATH' ) or die();

/**
 * Load custom scripts
 */
function ikonwp_custom_scripts() {

	/** custom wordpress theme */
	wp_register_script( 'ikonwp-custom-theme', get_template_directory_uri() . '/js/custom-theme.js', array( 'jquery' ), IKONWP_VERSION, true );
	wp_enqueue_script( 'ikonwp-custom-theme' );
}

add_action( 'wp_enqueue_scripts', 'ikonwp_custom_scripts' );

/**
 * array value
 *
 * @param $array
 * @param $index
 * @param null $fallback
 *
 * @return mixed|null
 */
function ikonwp_array_value( $array, $index, $fallback = null ) {
	if ( ! is_array( $array ) ) {
		return null;
	}

	return isset( $array[ $index ] ) ? $array[ $index ] : $fallback;
}

/**
 * IkonWP
 * post content
 */
function ikonwp_post_content() {
	$post_content_type = apply_filters( 'ikonwp_post_content', 'excerpt' );

	if ( 'full_content' == $post_content_type ) {
		the_content( '' );
	}

	if ( 'excerpt' == $post_content_type ) {
		the_excerpt();
	}
}

/**
 * IkonWP
 * home grid template
 *
 * @param $home_template
 *
 * @return string
 */
function ikonwp_home_grid_template( $home_template ) {

	if ( get_theme_mod( 'ikonwp_blog_layout', '' ) == 'grid' ) {
		$home_grid_template = locate_template( array( 'home-grid.php' ) );

		if ( ! empty( $home_grid_template ) ) {
			return $home_grid_template;
		}
	}

	return $home_template;
}

add_filter( 'home_template', 'ikonwp_home_grid_template' );

/**
 * IkonWP
 * archive grid template
 *
 * @param $archive_template
 *
 * @return string
 */
function ikonwp_archive_grid_template( $archive_template ) {

	if ( is_archive() || is_tax() ) {
		/** archive template */

		if ( get_theme_mod( 'ikonwp_blog_layout', '' ) == 'grid' ) {
			$archive_grid_template = locate_template( array( 'archive-grid.php' ) );

			if ( ! empty( $archive_grid_template ) ) {
				return $archive_grid_template;
			}
		}
	}

	return $archive_template;
}

add_filter( 'archive_template', 'ikonwp_archive_grid_template' );

/**
 * IkonWP
 * wp link pages args
 *
 * @param $params
 *
 * @return mixed
 */
function ikonwp_wp_link_pages_args( $params ) {

	$params['before']      = '<nav class="navigation pagination post-pages-pagination"><span class="screen-reader-text">' . esc_html__( 'Post navigation', 'ikonwp' ) . '</span><span class="page-title">' . __( 'Pages:', 'ikonwp' ) . '</span>';
	$params['after']       = '</nav>';
	$params['link_before'] = '<span class="page-number">';
	$params['link_after']  = '</span>';

	return $params;
}

add_filter( 'wp_link_pages_args', 'ikonwp_wp_link_pages_args' );

/**
 * IkonWP
 * the title
 *
 * @param int|WP_Post $post
 * @param string $before
 * @param string $after
 */
function ikonwp_the_title( $post = 0, $before = '', $after = '' ) {
	$title = ikonwp_get_the_title( $post );

	if ( strlen( $title ) == 0 ) {
		return;
	}

	echo $before . $title . $after;
}

/**
 * IkonWP
 * get the title
 *
 * @param int $post
 *
 * @return mixed
 */
function ikonwp_get_the_title( $post = 0 ) {
	$post = get_post( $post );

	$title = get_the_title( $post );

	return apply_filters( 'ikonwp_get_the_title', $title, $post );
}

/**
 * IkonWP
 * the subtitle
 *
 * @param int|WP_Post $post
 * @param string $before
 * @param string $after
 */
function ikonwp_the_subtitle( $post = 0, $before = '', $after = '' ) {
	$subtitle = ikonwp_get_the_subtitle( $post );

	if ( strlen( $subtitle ) == 0 ) {
		return;
	}

	echo $before . $subtitle . $after;
}

/**
 * IkonWP
 * get the subtitle
 *
 * @param int $post
 *
 * @return mixed
 */
function ikonwp_get_the_subtitle( $post = 0 ) {
	$subtitle = '';

	$post = get_post( $post );

	if ( function_exists( 'get_the_subtitle' ) ) {
		$subtitle = get_the_subtitle( $post );
	}

	return apply_filters( 'ikonwp_get_the_subtitle', $subtitle, $post );
}

/**
 * global - the title
 *
 * @param $title
 *
 * @return string
 */
function ikonwp_global_the_title( $title ) {
	global $ikonwp_the_title;

	if ( empty( $ikonwp_the_title ) ) {
		return $title;
	}

	$title = $ikonwp_the_title;

	return $title;
}

add_filter( 'ikonwp_get_the_title', 'ikonwp_global_the_title' );

/**
 * global - the subtitle
 *
 * @param $subtitle
 *
 * @return string
 */
function ikonwp_global_the_subtitle( $subtitle ) {
	global $ikonwp_the_subtitle;

	if ( empty( $ikonwp_the_subtitle ) ) {
		return $subtitle;
	}

	$subtitle = $ikonwp_the_subtitle;

	return $subtitle;
}

add_filter( 'ikonwp_get_the_subtitle', 'ikonwp_global_the_subtitle' );

/**
 * IkonWP
 * post type archive title
 *
 * @param $title
 *
 * @return string|void
 */
function ikonwp_archive_title( $title ) {
	if ( is_archive() ) {
		$title = get_the_archive_title();
	}

	return $title;
}

add_filter( 'ikonwp_get_the_title', 'ikonwp_archive_title' );

/**
 * IkonWP
 * archive subtitle
 *
 * @param $subtitle
 *
 * @return string|void
 */
function ikonwp_archive_subtitle( $subtitle ) {
	if ( is_archive() ) {
		if ( function_exists( 'get_the_archive_subtitle' ) ) {
			$subtitle = get_the_archive_subtitle();
		}

		if ( empty( $subtitle ) ) {
			$subtitle = get_the_archive_description();
		}
	}

	return $subtitle;
}

add_filter( 'ikonwp_get_the_subtitle', 'ikonwp_archive_subtitle' );

/**
 * IkonWP
 * home subtitle
 *
 * @param $title
 *
 * @return string|void
 */
function ikonwp_home_title( $title ) {
	if ( is_home() ) {
		/** set title */
		$title = single_post_title( '', false );

		/** default title */
		if ( is_front_page() ) {
			$title = esc_html__( 'Blog', 'ikonwp' );
		}
	}

	return $title;
}

add_filter( 'ikonwp_get_the_title', 'ikonwp_home_title' );

/**
 * IkonWP
 * home subtitle
 *
 * @param $subtitle
 *
 * @return string|void
 */
function ikonwp_home_subtitle( $subtitle ) {
	if ( is_home() ) {
		if ( function_exists( 'get_the_subtitle' ) ) {
			$subtitle = get_the_subtitle( get_queried_object_id() );
		}
	}

	return $subtitle;
}

add_filter( 'ikonwp_get_the_subtitle', 'ikonwp_home_subtitle' );

/**
 * Post - add sticky class
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_add_sticky_post_class( $classes ) {
	if ( is_sticky() ) {
		$classes[] = 'sticky';
	}

	return $classes;
}

add_filter( 'post_class', 'ikonwp_add_sticky_post_class' );

/**
 * Post - add comment class
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_add_comment_post_class( $classes ) {
	if ( ! post_type_supports( get_post_type(), 'comments' ) ) {
		return $classes;
	}

	if ( comments_open() ) {
		$classes[] = 'comment-open';
	}

	if ( ! comments_open() ) {
		$classes[] = 'comment-closed';
	}

	return $classes;
}

add_filter( 'post_class', 'ikonwp_add_comment_post_class' );

/**
 * IkonWP wp_list_comments
 * callback function
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function ikonwp_comment( $comment, $args, $depth ) {
	?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<?php echo get_avatar( $comment, 65, '', '', array( 'class' => 'mr-2 mr-sm-3 mr-md-4' ) ); ?>
        <div class="media-body">
            <h5 class="comment-title">
				<?php printf( __( '%s says:', 'ikonwp' ), get_comment_author_link() ); ?>
            </h5>

            <div class="comment-text">
				<?php comment_text(); ?>
            </div>

            <div class="d-flex">
                <ul class="comment-meta">
                    <li>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"
                           class="comment-date">
							<?php printf( __( '%1$s at %2$s', 'ikonwp' ), get_comment_date(), get_comment_time() ); ?>
                        </a>
                    </li>
                </ul>
                <ul class="comment-meta ml-auto">
					<?php
					/** edit */
					edit_comment_link( __( 'Edit', 'ikonwp' ), '<li>', '</li>' );

					/** reply */
					comment_reply_link( array_merge( $args, array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<li>',
						'after'     => '</li>',
					) ) );
					?>
                </ul>
            </div>
        </div>
    </li>
	<?php
}

/**
 * Comment form fields
 *
 * @param $fields
 *
 * @return array
 */
function ikonwp_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();

	$req      = get_option( 'require_name_email' );
	$aria_req = $req ? " aria-required='true'" : '';

	$fields['author'] = '<div class="col-4">
							<label for="comment" class="screen-reader-text">' . esc_html__( 'Name', 'ikonwp' ) . '</label>
	                        <input type="text" class="form-control" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name', 'ikonwp' ) . ( $req ? ' *' : '' ) . '" ' . $aria_req . '>
	                    </div>';

	$fields['email'] = '<div class="col-4">
							<label for="comment" class="screen-reader-text">' . esc_html__( 'Email', 'ikonwp' ) . '</label>
	                        <input type="text" class="form-control" id="email" name="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email', 'ikonwp' ) . ( $req ? ' *' : '' ) . '" ' . $aria_req . '>
	                    </div>';

	$fields['url'] = '<div class="col-4">
							<label for="comment" class="screen-reader-text">' . esc_html__( 'Website', 'ikonwp' ) . '</label>
	                        <input type="text" class="form-control" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'ikonwp' ) . '">
	                    </div>';

	/** comment cookies */
	if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {

		$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$fields['cookies'] = '<div class="col-12">
                            <div class="comment-form-cookies-consent form-check mt-3">
                                <input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '
                                <label for="wp-comment-cookies-consent" class="form-check-label">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'ikonwp' ) . '</label>
                            </div>
                        </div>';
	}

	return $fields;
}

add_filter( 'comment_form_default_fields', 'ikonwp_comment_form_fields' );

/**
 * Comment form before fields
 * add form group div
 */
function ikonwp_comment_form_before_fields() {
	echo '<div class="form-group form-row">';
}

add_action( 'comment_form_before_fields', 'ikonwp_comment_form_before_fields' );

/**
 * Comment form before fields
 * add close div
 */
function ikonwp_comment_form_after_fields() {
	echo '</div>';
}

add_action( 'comment_form_after_fields', 'ikonwp_comment_form_after_fields' );

/**
 * Comment form
 *
 * @param $args
 *
 * @return mixed
 */
function ikonwp_comment_form( $args ) {

	$args['comment_field'] = '<div class="form-group form-row">
	                                <div class="col">
										<label for="comment" class="screen-reader-text">' . esc_html__( 'Comment', 'ikonwp' ) . '</label>
	                                    <textarea class="form-control" name="comment" id="comment" rows="8" maxlength="65525" title="' . __( 'Comment', 'ikonwp' ) . '" placeholder="' . __( 'Comment', 'ikonwp' ) . '" aria-required="true" required="required"></textarea>
	                                </div>
	                            </div>';

	if ( '' != $args['comment_notes_before'] ) {
		$args['comment_notes_before'] = '<div class="form-group form-row">
			                                <div class="col">
												' . $args['comment_notes_before'] . '
											</div>
		                                </div>';
	}

	if ( '' != $args['comment_notes_after'] ) {
		$args['comment_notes_after'] = '<div class="form-group form-row">
			                                <div class="col">
			                                ' . $args['comment_notes_after'] . '
			                                </div>
		                                </div>';
	}

	$args['class_form']   = 'comment-form form-horizontal';
	$args['class_submit'] = 'btn btn-primary';

	$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title">';
	$args['title_reply_after']  = '</h4>';

	$args['submit_field'] = '<div class="form-group form-row text-center">
								<div class="col">
								%1$s %2$s
									<p class="form-control-plaintext">
										' . cancel_comment_reply_link() . '
									</p>
								</div>
							</div>';

	$args['must_log_in']  = '<div class="must-log-in">
                                ' . $args['must_log_in'] . '
                            </div>';
	$args['logged_in_as'] = '<div class="form-group form-row">
                                <div class="col">
                                    <div class="form-control-plaintext">
                                    ' . $args['logged_in_as'] . '
                                    </div>
                                </div>
                            </div>';

	return $args;
}

add_filter( 'comment_form_defaults', 'ikonwp_comment_form' );

/**
 * IkonWP Password Protected Form
 * with Bootstrap
 */
function ikonwp_password_form() {
	global $post;

	$label = 'pwbox-' . rand();

	if ( is_a( $post, 'WP_Post' ) ) {
		$label = 'pwbox-' . $post->ID;
	}

	/** @var string $output */
	ob_start();
	?>
    <div class="row">
        <div class="col-12">
            <form class="post-password-form" method="post"
                  action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>">
                <div class="input-group">
                    <label class="sr-only" for="<?php echo esc_attr( $label ); ?>">
						<?php _e( 'Password:', 'ikonwp' ); ?>
                    </label>
                    <input type="password" name="post_password" id="<?php echo esc_attr( $label ); ?>"
                           class="form-control" size="20">
                    <div class="input-group-append">
                        <input type="submit" name="Submit" class="btn btn-primary"
                               value="<?php esc_attr_e( 'Submit', 'ikonwp' ); ?>"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <p><?php _e( 'This content is password protected. To view it please enter your password.', 'ikonwp' ); ?></p>
        </div>
    </div>
	<?php
	$output = ob_get_clean();

	return $output;
}

add_filter( 'the_password_form', 'ikonwp_password_form' );

/**
 * IkonWP Custom
 * Tag Cloud Widget
 *
 * @param $args
 *
 * @return mixed
 */
function ikonwp_widget_tag_cloud_args( $args ) {

	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'rem';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'ikonwp_widget_tag_cloud_args' );

/**
 * IkonWP
 * wrapper class
 *
 * @param string $class
 */
function ikonwp_wrapper_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_wrapper_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get wrapper class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_wrapper_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_wrapper_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header class
 *
 * @param string $class
 */
function ikonwp_header_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header top class
 *
 * @param string $class
 */
function ikonwp_header_top_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_top_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header top class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_top_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_top_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * add filters to header top from navbar settings
 */
add_action( 'init', function () {
	add_filter( 'ikonwp_header_top_class', 'ikonwp_header_navbar_background_type_class' );
	add_filter( 'ikonwp_header_top_class', 'ikonwp_header_navbar_text_color_class' );
} );

/**
 * IkonWP
 * header top container class
 *
 * @param string $class
 */
function ikonwp_header_top_container_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_top_container_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header top container class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_top_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_top_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header navbar class
 *
 * @param string $class
 */
function ikonwp_header_navbar_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_navbar_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header navbar class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_navbar_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_navbar_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header navbar container class
 *
 * @param string $class
 */
function ikonwp_header_navbar_container_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_navbar_container_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header navbar container class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_navbar_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_navbar_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header logo class
 *
 * @param string $class
 */
function ikonwp_header_logo_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_logo_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header logo class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_logo_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_logo_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header logo responsive class
 *
 * @param $classes
 *
 * @return mixed
 */
function ikonwp_header_logo_responsive_class( $classes ) {

	if ( has_custom_logo() ) {
		if ( ! get_theme_mod( 'mobile_custom_logo' ) ) {
			$classes[] = 'd-inline-flex';
		} else {
			$classes[] = 'd-none';
			$classes[] = 'd-md-inline-flex';
		}
	}

	return $classes;
}

add_filter( 'ikonwp_header_logo_class', 'ikonwp_header_logo_responsive_class' );

/**
 * IkonWP
 * header text class
 *
 * @param string $class
 */
function ikonwp_header_text_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_text_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header text class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_text_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_text_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header logo responsive class
 *
 * @param $classes
 *
 * @return mixed
 */
function ikonwp_header_text_responsive_class( $classes ) {

	if ( ! has_custom_logo() && display_header_text() ) {
		if ( ! get_theme_mod( 'mobile_custom_logo' ) ) {
			$classes[] = 'd-flex';
		} else {
			$classes[] = 'd-none';
			$classes[] = 'd-md-flex';
		}
	}

	return $classes;
}

add_filter( 'ikonwp_header_text_class', 'ikonwp_header_text_responsive_class' );

/**
 * IkonWP
 * main navbar class
 *
 * @param string $class
 */
function ikonwp_main_navbar_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_main_navbar_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get main navbar class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_main_navbar_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_main_navbar_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * main navbar mobile class
 *
 * @param string $class
 */
function ikonwp_main_navbar_mobile_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_main_navbar_mobile_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get main navbar mobile class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_main_navbar_mobile_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_main_navbar_mobile_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * header title class
 *
 * @param string $class
 */
function ikonwp_header_title_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_header_title_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get header title class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_header_title_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_header_title_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * breadcrumb class
 *
 * @param string $class
 */
function ikonwp_breadcrumb_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_breadcrumb_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get breadcrumb class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_breadcrumb_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_breadcrumb_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * main class
 *
 * @param string $class
 */
function ikonwp_main_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_main_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get main class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_main_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_main_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * content col class
 *
 * @param string $class
 */
function ikonwp_content_col_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_content_col_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get content col class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_content_col_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_content_col_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * content title class
 *
 * @param string $class
 */
function ikonwp_content_title_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_content_title_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get content title class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_content_title_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_content_title_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * post grid class
 *
 * @param string $class
 */
function ikonwp_post_grid_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_post_grid_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get post grid class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_post_grid_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_post_grid_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * left sidebar col class
 *
 * @param string $class
 */
function ikonwp_left_sidebar_col_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_left_sidebar_col_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get left sidebar col class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_left_sidebar_col_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_left_sidebar_col_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * right sidebar col class
 *
 * @param string $class
 */
function ikonwp_right_sidebar_col_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_right_sidebar_col_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get right sidebar col class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_right_sidebar_col_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_right_sidebar_col_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * footer top container class
 *
 * @param string $class
 */
function ikonwp_footer_top_container_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_footer_top_container_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get footer top container class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_footer_top_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_footer_top_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * footer top row class
 *
 * @param string $class
 */
function ikonwp_footer_top_row_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_footer_top_row_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get footer top row class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_footer_top_row_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_footer_top_row_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * footer bottom container class
 *
 * @param string $class
 */
function ikonwp_footer_bottom_container_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_footer_bottom_container_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get footer bottom container class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_footer_bottom_container_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_footer_bottom_container_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * footer text col class
 *
 * @param string $class
 */
function ikonwp_footer_text_col_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_footer_text_col_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get footer text col class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_footer_text_col_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_footer_text_col_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * footer nav col class
 *
 * @param string $class
 */
function ikonwp_footer_nav_col_class( $class = '' ) {
	echo 'class="' . join( ' ', ikonwp_get_footer_nav_col_class( $class ) ) . '"';
}

/**
 * IkonWP
 * get footer nav col class
 *
 * @param string $class
 *
 * @return array
 */
function ikonwp_get_footer_nav_col_class( $class = '' ) {

	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	$classes = apply_filters( 'ikonwp_footer_nav_col_class', $classes, $class );

	return array_unique( $classes );
}

/**
 * IkonWP
 * dynamic content col class
 *
 * @param $classes
 *
 * @return array|string
 */
function ikonwp_dynamic_content_col_class( $classes ) {

	$is_active_sidebars = count( array_keys( array(
		is_active_sidebar( 'left' ),
		is_active_sidebar( 'right' )
	), true ) );

	/** without sidebar - full width */
	if ( $is_active_sidebars == 0 ) {
		$classes[] = 'col-12';
	}

	/** with one sidebar */
	if ( $is_active_sidebars == 1 ) {
		$classes[] = 'col-12 col-md-9';
	}

	/** with two sidebars */
	if ( $is_active_sidebars == 2 ) {
		$classes[] = 'col-12 col-md-6';
	}

	return $classes;
}

add_filter( 'ikonwp_content_col_class', 'ikonwp_dynamic_content_col_class' );

/**
 * IkonWP
 * dynamic footer row cols class
 *
 * @param $classes
 *
 * @return array|string
 */
function ikonwp_dynamic_footer_row_cols_class( $classes ) {

	$is_active_sidebars = count( array_keys( array(
		is_active_sidebar( 'footer-first' ),
		is_active_sidebar( 'footer-second' ),
		is_active_sidebar( 'footer-third' ),
		is_active_sidebar( 'footer-fourth' )
	), true ) );

	/** with one sidebar */
	if ( $is_active_sidebars == 1 ) {
		$classes[] = 'row-cols-1';
	}

	/** with two sidebars */
	if ( $is_active_sidebars == 2 ) {
		$classes[] = 'row-cols-1 row-cols-md-2';
	}

	/** with three sidebars */
	if ( $is_active_sidebars == 3 ) {
		$classes[] = 'row-cols-1 row-cols-md-2 row-cols-lg-3';
	}

	/** with four sidebars */
	if ( $is_active_sidebars == 4 ) {
		$classes[] = 'row-cols-1 row-cols-md-2 row-cols-lg-4';
	}

	return $classes;
}

add_filter( 'ikonwp_footer_top_row_class', 'ikonwp_dynamic_footer_row_cols_class' );

/**
 * IkonWP
 * dynamic left sidebar col class
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_dynamic_left_sidebar_col_class( $classes ) {

	/** with sidebar */
	if ( is_active_sidebar( 'left' ) ) {
		$classes[] = 'col-12 col-md-3';
	}

	return $classes;
}

add_filter( 'ikonwp_left_sidebar_col_class', 'ikonwp_dynamic_left_sidebar_col_class' );

/**
 * IkonWP
 * dynamic right sidebar col class
 *
 * @param $classes
 *
 * @return array
 */
function ikonwp_dynamic_right_sidebar_col_class( $classes ) {

	/** with sidebar */
	if ( is_active_sidebar( 'right' ) ) {
		$classes[] = 'col-12 col-md-3';
	}

	return $classes;
}

add_filter( 'ikonwp_right_sidebar_col_class', 'ikonwp_dynamic_right_sidebar_col_class' );

/**
 * IkonWP
 * left sidebar display
 *
 * @param $is_active_sidebar
 * @param $index
 *
 * @return mixed
 */
function ikonwp_left_sidebar_display( $is_active_sidebar, $index ) {

	/** check is left sidebar */
	if ( 'left' != $index ) {
		return $is_active_sidebar;
	}

	/** check is active sidebar */
	if ( ! $is_active_sidebar ) {
		return false;
	}

	/** default - home */
	if ( is_home() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_left_sidebar_archive_display', true );
	}

	/** default - archive */
	if ( is_archive() || is_tax() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_left_sidebar_archive_display', true );
	}

	/** default - singular */
	if ( is_singular() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_left_sidebar_singular_display', true );
	}

	/** post - archive (home and front page) */
	if ( is_home() && is_front_page() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_left_sidebar_archive_display', true );
	}

	/** post - archive */
	if ( is_post_type_archive( 'post' ) || is_tax( get_object_taxonomies( 'post' ) ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_left_sidebar_archive_display', true );
	}

	/** post - singular */
	if ( is_singular( 'post' ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_left_sidebar_singular_display', true );
	}

	/** page - singular */
	if ( is_singular( 'page' ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_page_left_sidebar_singular_display', true );
	}

	return boolval( $is_active_sidebar );
}

add_filter( 'is_active_sidebar', 'ikonwp_left_sidebar_display', 10, 2 );

/**
 * IkonWP
 * right sidebar display
 *
 * @param $is_active_sidebar
 * @param $index
 *
 * @return mixed
 */
function ikonwp_right_sidebar_display( $is_active_sidebar, $index ) {

	/** check is right sidebar */
	if ( 'right' != $index ) {
		return $is_active_sidebar;
	}

	/** check is active sidebar */
	if ( ! $is_active_sidebar ) {
		return false;
	}

	/** default - home */
	if ( is_home() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display', true );
	}

	/** default - archive */
	if ( is_archive() || is_tax() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_right_sidebar_archive_display', true );
	}

	/** default - singular */
	if ( is_singular() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_default_right_sidebar_singular_display', true );
	}

	/** post - archive (home and front page) */
	if ( is_home() && is_front_page() ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display', true );
	}

	/** post - archive */
	if ( is_post_type_archive( 'post' ) || is_tax( get_object_taxonomies( 'post' ) ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_right_sidebar_archive_display', true );
	}

	/** post - singular */
	if ( is_singular( 'post' ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_post_right_sidebar_singular_display', true );
	}

	/** page - singular */
	if ( is_singular( 'page' ) ) {
		$is_active_sidebar = get_theme_mod( 'ikonwp_sidebars_post_type_page_right_sidebar_singular_display', true );
	}

	return boolval( $is_active_sidebar );
}

add_filter( 'is_active_sidebar', 'ikonwp_right_sidebar_display', 10, 2 );

/**
 * IkonWP
 * get builder element
 *
 * @param $element
 */
function ikonwp_get_builder_element( $element ) {
	do_action( 'ikonwp_get_builder_element', $element );

	get_template_part( 'template-parts/' . $element );
}

/**
 * IkonWP
 * header builder - get elements html
 *
 * @param $position
 */
function ikonwp_header_builder_get_elements_html( $position ) {
	$ikonwp_header_builder_defaults = array(
		'ikonwp_header_builder_elements_top_left'    => array(),
		'ikonwp_header_builder_elements_top_center'  => array(),
		'ikonwp_header_builder_elements_top_right'   => array(),
		'ikonwp_header_builder_elements_main_left'   => array( 'logo' ),
		'ikonwp_header_builder_elements_main_center' => array( 'menu-1' ),
		'ikonwp_header_builder_elements_main_right'  => array( 'search-dropdown' )
	);

	$elements = get_theme_mod( 'ikonwp_header_builder_elements_' . $position, $ikonwp_header_builder_defaults[ 'ikonwp_header_builder_elements_' . $position ] );

	if ( ! empty( $elements ) ) {
		foreach ( $elements as $element ) {
			ikonwp_get_builder_element( 'header/element-' . $element );
		}
	}
}

/**
 * IkonWP
 * header builder mobile - get elements html
 *
 * @param $position
 */
function ikonwp_header_builder_mobile_get_elements_html( $position ) {
	$ikonwp_header_builder_defaults = array(
		'ikonwp_header_builder_mobile_elements_top_left'    => array(),
		'ikonwp_header_builder_mobile_elements_top_center'  => array(),
		'ikonwp_header_builder_mobile_elements_top_right'   => array(),
		'ikonwp_header_builder_mobile_elements_main_left'   => array( 'logo' ),
		'ikonwp_header_builder_mobile_elements_main_center' => array( 'menu-1' ),
		'ikonwp_header_builder_mobile_elements_main_right'  => array( 'search-dropdown' )
	);

	$elements = get_theme_mod( 'ikonwp_header_builder_mobile_elements_' . $position, $ikonwp_header_builder_defaults[ 'ikonwp_header_builder_mobile_elements_' . $position ] );

	if ( ! empty( $elements ) ) {
		foreach ( $elements as $element ) {
			ikonwp_get_builder_element( 'header/element-' . $element );
		}
	}
}