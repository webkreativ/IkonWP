<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content">
	<?php _e( 'Skip to content', 'ikonwp' ); ?>
</a>

<div <?php ikonwp_wrapper_class( 'wrapper' ); ?>>

    <header <?php ikonwp_header_class( 'header' ); ?> role="banner">
		<?php get_template_part( 'template-parts/header/top' ); ?>
		<?php get_template_part( 'template-parts/header/navbar' ); ?>
		<?php get_template_part( 'template-parts/header/title' ); ?>
    </header>