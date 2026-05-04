<?php
/**
 * Header template.
 *
 * @package Estatein
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-shell">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'estatein' ); ?></a>
	<div class="top-strip">
		<div class="container top-strip__inner">
			<span><?php esc_html_e( 'Discover Your Dream Property with Estatein.', 'estatein' ); ?></span>
			<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Learn more', 'estatein' ); ?></a>
		</div>
	</div>

	<header class="site-header" id="masthead">
		<div class="container site-header__inner">
			<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="site-brand__mark" aria-hidden="true">E</span>
					<span class="site-brand__name"><?php echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Estatein' ); ?></span>
				<?php endif; ?>
			</a>

			<nav class="primary-nav" id="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'estatein' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => 'estatein_primary_menu_fallback',
				) );
				?>
			</nav>

			<div class="header-actions">
				<a class="button button--small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'estatein' ); ?></a>
				<button class="menu-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Open menu', 'estatein' ); ?></span>
				</button>
			</div>
		</div>
	</header>

	<main id="primary" class="site-main">
